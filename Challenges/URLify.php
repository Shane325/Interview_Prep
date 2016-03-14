<?php
//Write a method to replace all spaces in a string with '%20'. You may assume that the string has space at the end
//to hold additional characters. And you are given the true length of the string

$str = 'Mr John Smith';
$len = 13;


$replace = '%20';
$find = ' ';

while(strpos($str, $find) !== false){
    $pos = strpos($str, $find);
    $str = substr_replace($str, $replace, $pos, 1);
}

echo $str . PHP_EOL;





?>
