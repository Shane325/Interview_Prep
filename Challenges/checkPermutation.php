<?php
//Given two strings, write a method to decide if one is a permutation of the other

$str1 = 'abcde';
$str2 = 'abcde';
$flag = true;

$str1Len = strlen($str1);
$str2Len = strlen($str2);

if($str1Len !== $str2Len){
    $flag = false;
    echo "diff length" . $flag . PHP_EOL;
}

for($i = 0; $i < $str1Len; $i ++){
    $pos = strpos($str2, $str1[$i]);
    if($pos === false ){
        echo $str1[$i] . " is NOT in " . $str2 . PHP_EOL;
        $flag = false;
    }else{
        echo $str1[$i] . " is in " . $str2 . PHP_EOL;
    }
}

var_dump($flag);
?>
