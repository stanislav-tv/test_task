<?php

    $str = 'tenet';
    $num = 0;

    $str = str_replace(' ', '', mb_strtolower($str));

    for ($i = 1; $i <= floor(strlen($str)/2); $i++){

        if($str[$i - 1] == $str[strlen($str) - $i]){

            $num ++;

        }else{

            break;

        }

    }

    if($num == floor(strlen($str)/2)){
        echo 'Palindrom';
    }else{

        echo 'Ne palindrom';
    }







