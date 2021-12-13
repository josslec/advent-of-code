<?php

/* Part 1 */


$input = file_get_contents('input13.txt');
$input = explode("\n\n", trim(str_replace('fold along ', '', $input)));
$dots = array_map( function($a) { return explode(',', $a); }, explode("\n", $input[0]));
$folds = array_map( function($a) { return explode('=', $a); }, explode("\n", $input[1]));


foreach ($folds as $foldid => $fold) {

	if($fold[0] == 'x') { // fold along x
		$xmax = max(array_column($dots, 0));
		foreach($dots as $dotid => $dot) {
			if($fold[1] >= $xmax/2) {
				$dots[$dotid][0] = ($dot[0] > $fold[1]) ? $fold[1]-($dot[0]-$fold[1]) : $dot[0];
			}
			else {
				$dots[$dotid][0] = ($dot[0] < $fold[1]) ? $fold[1]-($dot[0]-$fold[1]) : $dot[0];
			}
		}
	}
	else { // fold along y
		$ymax = max(array_column($dots, 1));
		foreach($dots as $dotid => $dot) {
			if($fold[1] >= $ymax/2) {
				$dots[$dotid][1] = ($dot[1] > $fold[1]) ? $fold[1]-($dot[1]-$fold[1]) : $dot[1];
			}
			else {
				$dots[$dotid][1] = ($dot[1] < $fold[1]) ? $fold[1]-($dot[1]-$fold[1]) : $dot[1];
			}
		}
	}

	$dots = array_unique($dots, SORT_REGULAR);

	if($foldid == 0) echo 'Part 1 - First fold only : '.count($dots)."\n";
	//break; // We stop at the first fold
}



/* Part 2 */

$xmax = max(array_column($dots, 0));
$ymax = max(array_column($dots, 1));

$grid = array_fill(0, $ymax, ' ');
foreach($grid as $rowid => $column) $grid[$rowid] = array_fill(0, $xmax, ' ');

foreach($dots as $dot) {
	$grid[$dot[1]][$dot[0]] = '#';
}

echo "Part 2 - Code : \n";
echo implode("\n", array_map('implode', $grid))."\n";

/*

###   ##  ###  #     ##  #  # #  # #  
#  # #  # #  # #    #  # # #  #  # #  
#  # #    #  # #    #  # ##   #### #  
###  #    ###  #    #### # #  #  # #  
# #  #  # #    #    #  # # #  #  # #  
# #   ##  #    #### #  # #  # #  # ####

*/
