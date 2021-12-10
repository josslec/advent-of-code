<?php

/* Part 1 */

$lines = explode("\n", trim(file_get_contents('input10.txt')));
$lines = array_map('str_split', $lines);

$marks = ['<' => '>', '(' => ')', '[' => ']', '{' => '}'];
$corruptedscore = 0;

foreach($lines as $key => $line) {
	$symetricclosingmarks[$key] = [];
	foreach ($line as $char) {
		if(isset($marks[$char])) {
			$symetricclosingmarks[$key][] = $marks[$char];
		}
		elseif(in_array($char, $marks)) {
			$expectedchar = array_pop($symetricclosingmarks[$key]);
			if($expectedchar != $char) {
				//echo 'Expected '.$expectedchar.', but found '.$char.' instead.'."\n";
				$corruptedscore+= ($char == ')') ? 3 : (($char == ']') ? 57 : (($char == '}') ? 1197 : (($char == '>') ? 25137 : 0)));
				unset($lines[$key], $symetricclosingmarks[$key]);
				break;
			}
		}
	}
}

// Part 1 : 339477
echo 'Part 1 - Corrupted score : '.$corruptedscore."\n";



/* Part 2 */

$incompletescore = [];

foreach($symetricclosingmarks as $key => $closingmarks) {
	krsort($closingmarks);
	$incompletescore[$key] = 0;
	foreach ($closingmarks as $char) {
		$incompletescore[$key] = $incompletescore[$key] * 5 + (($char == ')') ? 1 : (($char == ']') ? 2 : (($char == '}') ? 3 : (($char == '>') ? 4 : 0))));
	}
}

sort($incompletescore);
$incompletescore = $incompletescore[count($incompletescore)/2];

// Part 2 : 3049320156
echo 'Part 2 - Incomplete score : '.$incompletescore."\n";

