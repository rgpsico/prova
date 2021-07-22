<?php 
session_start();
$connect = mysqli_connect('localhost','root','','cart_php'); 

if(isset($_POST['add_to_cart']))
{
    if(isset($_SESSION['shopping_cart']))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"],$item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = [
                'item_id' => $_GET["id"],
                'item_name' => $_POST['hidden_name'],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST['quantity']
            ];
            $_SESSION['shopping_cart'][$count] = $item_array;
        }
        else
        {
            echo "<script>alert('Item already added')</script>";
            echo "<script>window.location='index.php'</script>";

        }


    }
    else
    {
        $item_array = [
            'item_id' => $_GET["id"],
            'item_name' => $_POST['hidden_name'],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST['quantity']
        ];
        $_SESSION['shopping_cart'][0] = $item_array;

    }
}

if(isset($_GET['action']))
{
    if($_GET['action']=="delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET['id'])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo "<script>Item removido com sucesso</script>";

            }

        }
    }
}
if(isset($_POST['pedidos']))
{
    $valor_total = $_POST['total'];
    $sqlCompra = "INSERT INTO venda (total)   VALUES ('{$valor_total}')";
    $connect->query($sqlCompra);
   $compra_id = $connect->insert_id;


    foreach($_SESSION["shopping_cart"] as $keys => $values){
     $item_name = $values['item_name'];
     $qtd = $values['item_quantity'];
     $price = $values['item_price'];
     
    $sql = "INSERT INTO pedido (item, qtd, valor,numero_pedido) 
    VALUES ('{$item_name}', '{$qtd}', '{$price}', '{$compra_id}')";
    $connect->query($sql);
     

    

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de compra</title>
</head>
<body>
<h3 style="text-align: center;">Carrinho de compras</h3>
<div class="container">

<?php 
$query = "SELECT * FROM tbl_product order by id asc";
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0 ){
    while($row = mysqli_fetch_array($result))
    {
        ?>


<div class="col-md-4">
    <form action="index.php?action=add&id=<?php echo $row['id']; ?>" method="post">
    <div style="border:1px solid #333; background-color:#f1f1f1;border-radius:5px; padding:10px;">
    <img src="img/<?=$row['image'] ?>" alt="" width="200px">
    </div>
    <h4 class="text-info"></h4>
    <h4 class="text-danger"><?=$row['name'] ?></h4>
    <h4 class="text-danger"><?=$row['price'] ?></h4>
    <input type="text"   name="quantity" class="form-control" value="1">
    <input type="hidden" name="hidden_name"  value="<?=$row['name'] ?>">
    <input type="hidden" name="hidden_price"  value="<?=$row['price'] ?>">
    <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="add cart">
</form>
</div>

<?php 
}

}
?>
<div style="clear:both"></div>
<br>
<h3>Order Details</h3>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Item name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
      if(!empty($_SESSION["shopping_cart"]))
      {
          $total = 0;
        
     
          foreach($_SESSION["shopping_cart"] as $keys => $values)
          {
      ?>
        <tr>
            <td><?php echo $values['item_name'] ?></td>
            <td><?php echo $values['item_quantity'] ?></td>
            <td><?php echo $values['item_price'] ?></td>
            <td><?php echo number_format($values['item_quantity'] * $values["item_price"],2); ?></td>
            <td><a href="index.php?action=delete&id=<?php echo $values['item_id'] ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
        $total = $total + ($values["item_quantity"] * $values["item_price"]);
          } 
   ?>
        <tr>
        <td colspan="3">Total</td>
        <td colspan="3"><?php echo number_format($total,2)?></td>
        </tr>
        <tr>
        <td colspan="3">Pagar</td>
        <form action="" method="post">
          <input type="text" name="pedidos">
          <input type="text" id="total" name="total" value="<?php echo  $total ;?>">
        <td colspan="3"><button type="submit" class="btn-info">Pagar</button></td>
        </tr>
        </form>
              
 <?php

          }
    
?>
    </table>
</div>






</div>

    
</body>
</html>