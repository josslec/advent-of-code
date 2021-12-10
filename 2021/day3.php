<?php

/* Part 1 */

$lines = explode("\n", file_get_contents('input3.txt'));

$counts = [];
$counts[0] = [];
$counts[1] = [];

foreach($lines as $line) {
	$bitpos = 0;
	$bits = str_split($line);
	foreach ($bits as $bit) {
		if($bit == '0') {
			$counts[$bitpos][0] = isset($counts[$bitpos][0]) ? ($counts[$bitpos][0] + 1) : 1;
		}
		else {
			$counts[$bitpos][1] = isset($counts[$bitpos][1]) ? ($counts[$bitpos][1] + 1) : 1;
		}
		
		$bitpos++;
	}
}

$gamma = '';
$epsilon = '';

foreach($counts as $count) {
	$gamma.= ($count[0] > $count[1]) ? '0' : '1';
	$epsilon.= ($count[0] < $count[1]) ? '0' : '1';
}

$power_conso = bindec($gamma) * bindec($epsilon);

echo 'Part 1 - Power consumption : '.$power_conso."\n";


/* Part 2 */

$lines = explode("\n", file_get_contents('input3.txt'));
array_pop($lines);

$lines = array_map('str_split', $lines);

$oxygen = $lines;
$i = 0;
while(count($oxygen) != 1) {
	$column = array_column($oxygen, $i);
	$countsInColumn = array_count_values($column);
	$valuetokeep = ($countsInColumn[1] >= $countsInColumn[0]) ? '1' : '0';

	foreach ($oxygen as $key => $value) {
		if($value[$i] != $valuetokeep) {
			unset($oxygen[$key]);
		}
	}
	$i++;
}

$co2 = $lines;
$i = 0;
while(count($co2) != 1)
{
	$column = array_column($co2, $i);
	$countsInColumn = array_count_values($column);
	$valuetokeep = ($countsInColumn[0] <= $countsInColumn[1]) ? '0' : '1';

	foreach ($co2 as $key => $value) {
		if($value[$i] != $valuetokeep) {
			unset($co2[$key]);
		}
	}
	$i++;
}

$life_support_rating = bindec(implode('', array_values($oxygen)[0])) * bindec(implode('', array_values($co2)[0]));

echo 'Part 2 - Life support rating : '.$life_support_rating."\n";


