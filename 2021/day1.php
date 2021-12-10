<?php

$numbers = explode("\n", trim(file_get_contents('input.txt')));

/* Part 1 */

$count = 0;
foreach($numbers as $i => $number) {
	if($i > 0 and $numbers[$i]> $numbers[$i-1]) {
		$count++;
	}
}

echo 'Part 1 - Simple increase count : '.$count."\n";


/* Part 2 */

$count = 0;
foreach($numbers as $i => $number) {
	if($i > 0 and ($i+2) < count($numbers) and ($numbers[$i] + $numbers[$i+1] + $numbers[$i+2]) > ($numbers[$i-1] + $numbers[$i] + $numbers[$i+1])) {
		$count++;
	}
}

echo 'Part 2 - Sliding window increase count : '.$count."\n";
