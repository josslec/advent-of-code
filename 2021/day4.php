<?php

/* Parts 1 and 2 */

$grids = explode("\n\n", trim(file_get_contents('input4.txt')));
$random_numbers = explode(',', array_shift($grids));

$gridscomputed = [];

foreach ($grids as $grid) {
	$grid = array_map('trim', str_split(str_replace("\n", ' ', $grid), 3));

	$iterationsToWin = 0;
	foreach($random_numbers as $value) {
		if(in_array($value, $grid)) {
			$grid[array_search($value, $grid)] = 0;
		}

		$i = 0;
		while($i < 5) {
			// Check the grid has won
			if(!($grid[0+$i*5] or $grid[1+$i*5] or $grid[2+$i*5] or $grid[3+$i*5] or $grid[4+$i*5]) or !($grid[0+$i] or $grid[5+$i] or $grid[10+$i] or $grid[15+$i] or $grid[20+$i])) {
				$score = array_sum($grid)*$value;
				$gridscomputed[$iterationsToWin] = $score;

				break 2;
			}
			$i++;
		}

		$iterationsToWin++;
	}
}

ksort($gridscomputed);

// Part 1

$winner_score = array_shift($gridscomputed);
echo 'Part 1 - Winner score : '.$winner_score."\n";

// Part 2

$loser_score = array_pop($gridscomputed);
echo 'Part 2 - Loser score : '.$loser_score."\n";


