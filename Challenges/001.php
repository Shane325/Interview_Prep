<?php

//Find the most frequent integer in an array?

//here is my array
$arr = array(2, 2, 2, 2, 5, 9, 8, 6, 6, 6, 7, 5, 0);

//lets define an array to hold the count of each integer
$countArr = array();

//iterate through the first array and store the count for each integer in the countArr
foreach($arr as $value){
	$countArr[$value] = $countArr[$value] + 1;
}

//variable to get our max count
$max = 0;
//variable to store our answer
$answer;

//iterate through our countArr and if value is greater than max then set the key to answer
foreach($countArr as $key => $value){
	if($value > $max){
		$max = $value;
		$answer = $key;
	}
}

//return answer
echo $answer . PHP_EOL;


?>