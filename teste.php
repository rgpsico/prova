<?php 


function PegarSeculo(int $ano){
    echo $seculo = ceil($ano/100);
}



$numero =61;
$divisores = 0;


 
/**2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47,53, 59, 61, 67, 71, 73, 79, 83, 89 e 97
 * impressão de números primos de 1 a 100
 *
 * Números primos são aqueles que só são divisíveis por 1 e por ele mesmo. Logo
 * ele possui apenas 2 divisores.
 */

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


    















?>