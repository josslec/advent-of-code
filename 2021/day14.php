<?php

/* Part 1 */

$input = file_get_contents('input14.txt');
$input = explode("\n\n", trim($input));
$template = str_split($input[0]);
foreach(explode("\n", $input[1]) as $rule) $insertion_rules[explode(' -> ', $rule)[0]] = explode(' -> ', $rule)[1];


$step = 0;
while($step < 10) {
	$templatenext = [];

	foreach ($template as $key => $char) {
		if($key > 0) {
			$templatenext[] = $template[$key-1];
			$templatenext[] = $insertion_rules[$template[$key-1].$char];
		}
	}

	$templatenext[] = array_pop($template);
	$template = $templatenext;
	$step++;
}


$counts = array_count_values($template);
asort($counts);

$part1 = array_pop($counts) - array_shift($counts);

echo 'Part 1 : '.$part1."\n";



/* Part 2 (optimization) */

$input = file_get_contents('input14.txt');
$input = explode("\n\n", trim($input));
$template = str_split($input[0]);
foreach(explode("\n", $input[1]) as $rule) $insertion_rules[explode(' -> ', $rule)[0]] = explode(' -> ', $rule)[1];
$pairs_count = array_map(function($a) { return 0; } ,$insertion_rules);

foreach ($template as $key => $char) {
	if($key > 0) {
		$pairs_count[$template[$key-1].$char] = isset($pairs_count[$template[$key-1].$char]) ? $pairs_count[$template[$key-1].$char] + 1 : 1;
	}
}


$elements_counts = array_count_values($template);
$step = 0;
while($step < 40) {
	$new_pairs_count = [];
	foreach($pairs_count as $pair => $count) {
		$newpairA = str_split($pair)[0].$insertion_rules[$pair];
		$newpairB = $insertion_rules[$pair].str_split($pair)[1];
		$new_pairs_count[$newpairA] = isset($new_pairs_count[$newpairA]) ? $new_pairs_count[$newpairA] + $count : $count;
		$new_pairs_count[$newpairB] = isset($new_pairs_count[$newpairB]) ? $new_pairs_count[$newpairB] + $count : $count;
		$elements_counts[$insertion_rules[$pair]] = isset($elements_counts[$insertion_rules[$pair]]) ? $elements_counts[$insertion_rules[$pair]] + $count : $count;
	}
	$pairs_count = $new_pairs_count;
	$step++;
}

asort($elements_counts);
$part2 = array_pop($elements_counts) - array_shift($elements_counts);
echo 'Part 2 : '.$part2."\n";


