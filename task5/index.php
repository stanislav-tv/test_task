<?php


$str = 'я отилцау шщтикшу oipjnioeqbnioeqnrbpeqrb !!!!!!!!!!!!!!!!!!!!!';


$checkArr = explode(' ', $str);

foreach ($checkArr as $key => $value){

    $checkArr[$key] = (mb_strlen($value) > 6) ?
        mb_substr($value, 0, 6) . '*' :
        $value;

}

$new_str = implode(' ', $checkArr);

echo $new_str;