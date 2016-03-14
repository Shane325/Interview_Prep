<?php
// Complete the stair case function

$N = 6;

for($i = 1; $i <= $N; $i++){
    $space = $N - $i;
    $hash = $i;

    for($x = 1; $x <= $space; $x++){
        echo ' ';
    }
    for($y = 1; $y <= $hash; $y++){
        echo '#';
    }
    echo PHP_EOL;
}

?>
