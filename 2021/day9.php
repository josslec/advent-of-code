<?php

/* Part 1 */

$map = explode("\n", trim(file_get_contents('input9.txt')));
$map = array_map('str_split', $map);

$risklevel = 0;

foreach ($map as $rowid => $row) {
	foreach($row as $columnid => $case) {
		$top = isset($map[$rowid-1][$columnid]) ? $map[$rowid-1][$columnid] : 10;
		$bottom = isset($map[$rowid+1][$columnid]) ? $map[$rowid+1][$columnid] : 10;
		$left = isset($map[$rowid][$columnid-1]) ? $map[$rowid][$columnid-1] : 10;
		$right = isset($map[$rowid][$columnid+1]) ? $map[$rowid][$columnid+1] : 10;

		if(($top > $case) and ($bottom > $case) and ($left > $case) and ($right > $case)) {
			$risklevel+= $case+1;
		}
	}
}

// Part 1 : 588
echo 'Part 1 - Risk level : '.$risklevel."\n";


/* Part 2 */

$map = explode("\n", trim(file_get_contents('input9.txt')));
$map = array_map('str_split', $map);

$basins = [];

foreach ($map as $rowid => $row) {
	foreach($row as $columnid => $case) {
		$top = isset($map[$rowid-1][$columnid]) ? $map[$rowid-1][$columnid] : -1;
		$left = isset($map[$rowid][$columnid-1]) ? $map[$rowid][$columnid-1] : -1;

		if($case != 9) {

			if(!is_numeric($top) and !is_numeric($left) and $top != $left) {
				$basins[$top] = $basins[$top] + $basins[$left];
				unset($basins[$left]);
				$map[$rowid] = json_decode(str_replace($left, $top, json_encode($map[$rowid])), true);
			}

			$case = !is_numeric($top) ? $top : (!is_numeric($left) ? $left : uniqid());
			$map[$rowid][$columnid] = $case;
			$basins[$case] = isset($basins[$case]) ? $basins[$case]+1 : 1;
		}
	}
}

rsort($basins);

// Part 2 : 964712
echo 'Part 2 - Basins : '.$basins[0]*$basins[1]*$basins[2]."\n";

