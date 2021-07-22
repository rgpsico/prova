<?php 


function PegarSeculo(int $ano){
    echo $seculo = ceil($ano/100);
}


 function PrimoInferior($numero) {
  $array = [];
  for($i = 1; $i <= $numero; $i++)
  {   
    $divisores = 0;
  
    for($j = $i; $j >= 1; $j--)
    {
        if (($i % $j) == 0) {
            $divisores++;
        }
    }
 
   
    if ($divisores == 2)
    {
       $i . ', ';
       $array[] = $i;
       
    }
    
}

 $penultimo = $array[ count($array) - 2  ];

    if($penultimo < 0 ){
        echo 0;
    }else {
        echo $penultimo;
    }

}

 
 function NumerosRepetidos(array $sorteado){
     $duplicados = array_unique( array_diff_assoc( $sorteado, array_unique( $sorteado ) ) );
     $cont=1;
     $num=0;
     for($i=0; $i<count($sorteado); $i++)
     {
      $cont=0;
      for($j=0; $j<count($sorteado); $j++)
          {
          if ($sorteado[$i] == $sorteado[$j])
          $cont++;
          $num = $sorteado[$i];
          }
      //echo "<br/> repeticoes numero ". $num . ": ".$cont ." vezes";	
      }
      echo "<br>";
      echo"o numero que mais se repetiu foi o numero " . $num . "<br/> repetiu ". $cont."x";
  
    }
    

   



    
  function SequenciaCrescente($frutas){
    $frutas2 = [];
      foreach($frutas as $i => $value){
            unset($frutas2[$i]);
          if ( @$frutas[$i] > @$frutas[$i+1] ){
                   return false;
              }else {
                 return true;
            }
        }
    }
      
          
    


    teste($frutas);
 
    








?>