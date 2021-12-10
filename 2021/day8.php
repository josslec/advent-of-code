<?php

/* Parts 1 and 2 */

$displays = explode("\n", trim(file_get_contents('input8.txt')));

$count_simple_digits = 0;
$count_all_outputs = 0;

foreach ($displays as $display) {
	$display = explode(' | ', $display);

	$patterns = explode(' ', $display[0]);

	usort($patterns, function($a, $b) {
    	return strlen($a) - strlen($b);
	}); // sort by length of values


	$digits = array_fill(0, 10, false);
	$segments_assoc = [];

	foreach($patterns as $pattern) {
		$pattern = str_split($pattern);
		sort($pattern);

		$digits[1] = (count($pattern) == 2) ? $pattern : $digits[1];
		$digits[7] = (count($pattern) == 3) ? $pattern : $digits[7];
		$digits[4] = (count($pattern) == 4) ? $pattern : $digits[4];
		$digits[8] = (count($pattern) == 7) ? $pattern : $digits[8];

		$digits[6] = (count($pattern) == 6 and (!in_array($digits[1][0], $pattern) or !in_array($digits[1][1], $pattern))) ? $pattern : $digits[6];
		$digits[9] = (count($pattern) == 6 and count(array_diff($pattern, $digits[4])) == 2 and in_array($digits[1][0], $pattern) and in_array($digits[1][1], $pattern)) ? $pattern : $digits[9];
		$digits[0] = (count($pattern) == 6 and count(array_diff($pattern, $digits[4])) == 3 and in_array($digits[1][0], $pattern) and in_array($digits[1][1], $pattern)) ? $pattern : $digits[0];

		$digits[3] = (count($pattern) == 5 and in_array($digits[1][0], $pattern) and in_array($digits[1][1], $pattern)) ? $pattern : $digits[3];

		$digits[5] = (count($pattern) == 5 and (!in_array($digits[1][0], $pattern) or !in_array($digits[1][1], $pattern)) and count(array_diff($pattern, $digits[4])) == 2) ? $pattern : $digits[5];
		$digits[2] = (count($pattern) == 5 and (!in_array($digits[1][0], $pattern) or !in_array($digits[1][1], $pattern)) and count(array_diff($pattern, $digits[4])) == 3) ? $pattern : $digits[2];

	}

	$digits = array_flip(array_map('implode', $digits));

	$output_digits = explode(' ', $display[1]);

	foreach($output_digits as $key => $output_digit) {
		$output_digit = str_split($output_digit);
		$output_digit = sort($output_digit) ? implode($output_digit) : false;
		$output_digit = $digits[$output_digit];
		$output_digits[$key] = $output_digit;

		if($output_digit == 1 or $output_digit == 4 or $output_digit == 7 or $output_digit == 8) {
			$count_simple_digits++;
		}
	}

	$count_all_outputs+= implode($output_digits);


}

// Part 1 : 369
echo 'Part 1 : '.$count_simple_digits."\n";

//  Part 2
echo 'Part 2 : '.$count_all_outputs."\n";
