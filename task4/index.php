<?php

$array = [1,1,3,4,5,2,3,5,3,5];
$new_arr = [];
$i = 0 ;

foreach ($array as $key => $value){

    if (!in_array($value, $new_arr)){

        $new_arr[$i] = $value;

        //sort($new_arr);

        //var_dump($new_arr);

        echo $new_arr[$i] . ' ';

        $i++;

    }


}




