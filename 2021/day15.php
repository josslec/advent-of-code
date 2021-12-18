<?php

/* Part 1 */

function dijkstra($_distArr, $a, $b)
{
	//initialize the array for storing
	$S = array();//the nearest path with its parent and weight
	$Q = array();//the left nodes without the nearest path
	foreach(array_keys($_distArr) as $val) $Q[$val] = 99999;
	$Q[$a] = 0;

	//start calculating
	while(!empty($Q)){
	    $min = array_search(min($Q), $Q);//the most min weight
	    if($min == $b) break;
	    foreach($_distArr[$min] as $key=>$val) if(!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
	        $Q[$key] = $Q[$min] + $val;
	        $S[$key] = array($min, $Q[$key]);
	    }
	    unset($Q[$min]);
	}

	//list the path
	$path = array();
	$pos = $b;
	while($pos != $a){
	    $path[] = $pos;
	    $pos = $S[$pos][0];
	}
	$path[] = $a;
	$path = array_reverse($path);

	return [$path, $S[$b][1]]; // [path, length]
}




$input = file_get_contents('input15.txt');
$input = array_map('str_split', explode("\n", trim($input)));

$graph = [];

foreach($input as $rowid => $row) {
	foreach($row as $columnid => $case) {
		if(isset($input[$rowid+1][$columnid])) $graph[$columnid.','.($rowid+1)][$columnid.','.$rowid] = $input[$rowid][$columnid];
		if(isset($input[$rowid][$columnid+1])) $graph[($columnid+1).','.$rowid][$columnid.','.$rowid] = $input[$rowid][$columnid];
		if(isset($input[$rowid+1][$columnid])) $graph[$columnid.','.$rowid][$columnid.','.($rowid+1)] = $input[$rowid+1][$columnid];
		if(isset($input[$rowid][$columnid+1])) $graph[$columnid.','.$rowid][($columnid+1).','.$rowid] = $input[$rowid][$columnid+1];
	}
}



$bestpath = dijkstra($graph, '0,0', (count($input[0])-1).','.(count($input)-1));

echo 'Part 1 - Lowest total risk : '.$bestpath[1]."\n"; // 429




/* Part 2 */

$i = 1;
$initialcount = count($input);
$oldinput = $input;

while($i < 5) {
	$next = $initialcount*$i;
	$last = $initialcount*($i-1);
	
	foreach($oldinput as $rowid => $row) {	
		foreach($row as $columnid => $case) {
			$input[$next+$rowid][$columnid] = ($input[$last+$rowid][$columnid] == 9) ? 1 : $input[$last+$rowid][$columnid] + 1;
		}
	}
	$i++;
}

$i = 1;
$oldinput = $input;

while($i < 5) {
	$next = $initialcount*$i;
	$last = $initialcount*($i-1);
	
	foreach($oldinput as $rowid => $row) {	
		foreach($row as $columnid => $case) {
			$input[$rowid][$columnid+$next] = ($input[$rowid][$last+$columnid] == 9) ? 1 : $input[$rowid][$last+$columnid] + 1;
		}
	}
	$i++;
}



$graph = [];

foreach($input as $rowid => $row) {
	foreach($row as $columnid => $case) {
		if(isset($input[$rowid+1][$columnid])) $graph[$columnid.','.($rowid+1)][$columnid.','.$rowid] = $input[$rowid][$columnid];
		if(isset($input[$rowid][$columnid+1])) $graph[($columnid+1).','.$rowid][$columnid.','.$rowid] = $input[$rowid][$columnid];
		if(isset($input[$rowid+1][$columnid])) $graph[$columnid.','.$rowid][$columnid.','.($rowid+1)] = $input[$rowid+1][$columnid];
		if(isset($input[$rowid][$columnid+1])) $graph[$columnid.','.$rowid][($columnid+1).','.$rowid] = $input[$rowid][$columnid+1];
	}
}



$bestpath = dijkstra($graph, '0,0', (count($input[0])-1).','.(count($input)-1));

echo 'Part 2 - Lowest total risk : '.$bestpath[1]."\n"; // 2844
