<?php

$arr = [[2,2,3], [4,6]];


$result = 0;
$result1 = 0;

foreach ($arr as $value){

    $result = countNumber($value);

    $result1 += $result;



}

echo 'Result - ' . "$result1";

function countNumber($arr){
    $item1 = 0;
    foreach ($arr as $item){

        $item1 += $item;

    }
    return $item1;

}