<?php

/* Part 1 */

function mediane($numbers) {
	sort($numbers);
	if(count($numbers)%2 == 1) { // impair
		return $numbers[((count($numbers)-1)/2 + 1)];
	}
	else { // pair
		return floor($numbers[count($numbers)/2]/2 + $numbers[count($numbers)/2+1]/2);
	}
}

$numbers = explode(",", trim(file_get_contents('input07.txt')));
$mediane = mediane($numbers);

$fuel = 0;
foreach ($numbers as $number) {
	$fuel+= abs($number - $mediane);
}

echo 'Part 1 - Fuel : '.$fuel."\n";


/* Part 2 */

$numbers = explode(",", trim(file_get_contents('input07.txt')));

$moyenne = floor(array_sum($numbers)/count($numbers));

$fuel = 0;
foreach ($numbers as $number) {
	$n = abs($number - $moyenne);
	$fuel+= $n*($n+1)/2;
}

echo 'Part 2 - Fuel : '.$fuel."\n";


