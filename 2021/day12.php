<?php

/* Part 1 */


$map = explode("\n", trim(file_get_contents('input12.txt')));

$graph = [];

foreach($map as $bridge) {
	$bridge = explode('-', $bridge);
	$graph[$bridge[0]][$bridge[1]] = 1;
	$graph[$bridge[1]][$bridge[0]] = 1;
}

$pathscount = 0;

function getChildrenCaves($positionA, $graph, $already_visited_small_cave=[]) {
	global $pathscount;
	$paths = [];

	if(ctype_lower($positionA)) {
			$already_visited_small_cave[] = $positionA;
	}

	foreach($graph[$positionA] as $positionB => $weight) {
		if(in_array($positionB, $already_visited_small_cave)) {
			continue;
		}
		
		if($positionB == 'end') {
			$paths[$positionB] = '';
			$pathscount++;
			continue;
		}
		else {
			$childrenCaves = getChildrenCaves($positionB, $graph, $already_visited_small_cave);
			if($childrenCaves) {
				$paths[$positionB] = $childrenCaves;
			}
		}
	}
	return $paths;
}

$paths = ['start' => getChildrenCaves('start', $graph)];


echo 'Part 1 - Number of paths : '.$pathscount."\n";






/* Part 2 */


$map = explode("\n", trim(file_get_contents('input12.txt')));

$graph = [];

foreach($map as $bridge) {
	$bridge = explode('-', $bridge);
	$graph[$bridge[0]][$bridge[1]] = 1;
	$graph[$bridge[1]][$bridge[0]] = 1;
}

$pathscount = 0;

function getChildrenCavesPart2($positionA, $graph, $already_visited_small_cave=[]) {
	global $pathscount;
	$paths = [];

	if(in_array($positionA, $already_visited_small_cave)) {
		if(count(array_count_values(array_count_values($already_visited_small_cave))) < 2 and $positionA != 'start') {
			$already_visited_small_cave[] = $positionA;
		}
		else {
			return;
		}
	}

	if(ctype_lower($positionA)) {
		$already_visited_small_cave[] = $positionA;
	}

	foreach($graph[$positionA] as $positionB => $weight) {
		if($positionB == 'end') {
			$paths[$positionB] = '';
			$pathscount++;
			continue;
		}
		else {
			$childrenCaves = getChildrenCavesPart2($positionB, $graph, $already_visited_small_cave);
			if($childrenCaves) {
				$paths[$positionB] = $childrenCaves;
			}
		}
	}
	return $paths;
}


$paths = ['start' => getChildrenCavesPart2('start', $graph)];


echo 'Part 2 - Number of paths : '.$pathscount."\n";



/* Diagnostic function (display found paths) */

function printpaths($paths, $orig='') {
	$originalorig = $orig;
	foreach($paths as $key => $path) {
		if($key == 'end') {
			echo $orig."end\n";
		}
		else {
			$orig.= $key.',';
			printpaths($path, $orig);
		}
		$orig = $originalorig;
	}
}

