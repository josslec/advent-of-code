<?php

$instructions = explode("\n", file_get_contents('input2.txt'));

/* Part 1 */

$horiz = 0;
$depth = 0;

foreach($instructions as $instruct)
{
	$split = explode(' ', $instruct);
	if($split[0] == 'forward') {
		$horiz+= $split[1];
	}
	if($split[0] == 'down') {
		$depth+= $split[1];
	}
	if($split[0] == 'up') {
		$depth-= $split[1];
	}

}

echo 'Part 1 : '.$depth*$horiz."\n";


/* Part 2 */

$aim = 0;
$horiz = 0;
$depth = 0;

foreach($instructions as $instruct)
{
	$split = explode(' ', $instruct);
	if($split[0] == 'forward') {
		$horiz+= $split[1];
		$depth+= $aim*$split[1];
	}
	if($split[0] == 'down') {
		$aim+= $split[1];
	}
	if($split[0] == 'up') {
		$aim-= $split[1];
	}

}

echo 'Part 2 : '.$depth*$horiz."\n";
