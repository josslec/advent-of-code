<?php

/* Part 1 */

$fishs = explode(",", trim(file_get_contents('input6.txt')));

$day = 1;
while($day <= 80) {
	foreach ($fishs as $key => $fish) {
		if($fish == 0) {
			$fishs[$key] = 6;
			$fishs[] = 8;
		}
		else {
			$fishs[$key]--;
		}
	}

	//echo 'Day '.$day.' : '.implode(',', $fishs)."\n";
	$day++;
}

// Part 1 : 374927
echo 'Part 1 : '.count($fishs)."\n"; 



/* Part 2 (optimization) */

$fishs = explode(",", trim(file_get_contents('input6.txt')));
$fishs_count = array_count_values($fishs) + array_fill(0, 9, 0);

$day = 1;
while($day <= 256) {
	$fishs_count[9] = $fishs_count[0];
	
	$fishday = 0;
	while($fishday <= 8) {
		$fishs_count[$fishday] =  $fishs_count[$fishday+1];
		$fishday++;
	}

	$fishs_count[6] = $fishs_count[6] + $fishs_count[8];

	unset($fishs_count[9]);
	
	$day++;
}

// Part 2 : 1687617803407
echo 'Part 2 : '.array_sum($fishs_count)."\n";

