<?php

/* Parts 1 and 2 */

$lines = explode("\n", trim(file_get_contents('input05.txt')));

$points_overlap_counts = [];

foreach ($lines as $segment) {
	$segment = explode(',', str_replace(' -> ', ',', $segment));

	if($segment[0] == $segment[2]) {	// if x1 = x2 (vertical segment)
		foreach (range($segment[1], $segment[3]) as $y) {
			$points_overlap_counts[$segment[0].','.$y] = isset($points_overlap_counts[$segment[0].','.$y]) ? $points_overlap_counts[$segment[0].','.$y] + 1 : 1;
		}
	}
	elseif($segment[1] == $segment[3]) {	// if y1 = y2 (horizontal segment)
		foreach (range($segment[0], $segment[2]) as $x) {
			$points_overlap_counts[$x.','.$segment[1]] = isset($points_overlap_counts[$x.','.$segment[1]]) ? $points_overlap_counts[$x.','.$segment[1]] + 1 : 1;
		}
	}
	else {	// Part 2 (comment this else if you want only the part 1 result)
		foreach (range($segment[0], $segment[2]) as $i => $x) {
			$y = range($segment[1], $segment[3])[$i];
			$points_overlap_counts[$x.','.$y] = isset($points_overlap_counts[$x.','.$y]) ? $points_overlap_counts[$x.','.$y] + 1 : 1;
		}
	}

}

$dangerous_points_count = array_count_values($points_overlap_counts);
unset($dangerous_points_count[1]);

$dangerous_points_count = array_sum($dangerous_points_count);

echo 'Part 1 or 2 - Dangerous points count : '.$dangerous_points_count."\n";

// Part 1 : 7269
// Part 2 : 21140
