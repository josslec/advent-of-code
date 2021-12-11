<?php

/* Part 1 */

$map = explode("\n", trim(file_get_contents('input11.txt')));
$map = array_map('str_split', $map);

$flashs = 0;

$step = 0;
while($step < 100) {
	foreach ($map as $rowid => $row) {
		foreach($row as $columnid => $octoenergy) {
			$map[$rowid][$columnid]++;
		}
	}

	while(in_array(10, call_user_func_array('array_merge', $map)))
	{
		foreach ($map as $rowid => $row) {
			foreach($row as $columnid => $octoenergy) {
				if($octoenergy == 10) {
					$map[$rowid][$columnid] = 0; // flash
					$flashs++;

					if(isset($map[$rowid-1][$columnid])) { $map[$rowid-1][$columnid] = ($map[$rowid-1][$columnid] != 0 and $map[$rowid-1][$columnid] != 10) ? $map[$rowid-1][$columnid] + 1 : $map[$rowid-1][$columnid]; } // top
					if(isset($map[$rowid+1][$columnid])) { $map[$rowid+1][$columnid] = ($map[$rowid+1][$columnid] != 0 and $map[$rowid+1][$columnid] != 10) ? $map[$rowid+1][$columnid] + 1 : $map[$rowid+1][$columnid]; } // bottom
					if(isset($map[$rowid][$columnid-1])) { $map[$rowid][$columnid-1] = ($map[$rowid][$columnid-1] != 0 and $map[$rowid][$columnid-1] != 10) ? $map[$rowid][$columnid-1] + 1 : $map[$rowid][$columnid-1]; } // left
					if(isset($map[$rowid][$columnid+1])) { $map[$rowid][$columnid+1] = ($map[$rowid][$columnid+1] != 0 and $map[$rowid][$columnid+1] != 10) ? $map[$rowid][$columnid+1] + 1 : $map[$rowid][$columnid+1]; } // right
					if(isset($map[$rowid+1][$columnid+1])) { $map[$rowid+1][$columnid+1] = ($map[$rowid+1][$columnid+1] != 0 and $map[$rowid+1][$columnid+1] != 10) ? $map[$rowid+1][$columnid+1] + 1 : $map[$rowid+1][$columnid+1]; } // bottom right
					if(isset($map[$rowid+1][$columnid-1])) { $map[$rowid+1][$columnid-1] = ($map[$rowid+1][$columnid-1] != 0 and $map[$rowid+1][$columnid-1] != 10) ? $map[$rowid+1][$columnid-1] + 1 : $map[$rowid+1][$columnid-1]; } // bottom left
					if(isset($map[$rowid-1][$columnid+1])) { $map[$rowid-1][$columnid+1] = ($map[$rowid-1][$columnid+1] != 0 and $map[$rowid-1][$columnid+1] != 10) ? $map[$rowid-1][$columnid+1] + 1 : $map[$rowid-1][$columnid+1]; } // top right
					if(isset($map[$rowid-1][$columnid-1])) { $map[$rowid-1][$columnid-1] = ($map[$rowid-1][$columnid-1] != 0 and $map[$rowid-1][$columnid-1] != 10) ? $map[$rowid-1][$columnid-1] + 1 : $map[$rowid-1][$columnid-1]; } // top left
				}
			}
		}
	}
	$step++;
}

echo 'Part 1 - Total flashes after 100 steps : '.$flashs."\n";


/* Part 2 */


$map = explode("\n", trim(file_get_contents('input11.txt')));
$map = array_map('str_split', $map);

$flashs = 0;

$step = 0;
while(array_sum(array_map('array_sum', $map)) != 0) {
	foreach ($map as $rowid => $row) {
		foreach($row as $columnid => $octoenergy) {
			$map[$rowid][$columnid]++;
		}
	}

	while(in_array(10, call_user_func_array('array_merge', $map)))
	{
		foreach ($map as $rowid => $row) {
			foreach($row as $columnid => $octoenergy) {
				if($octoenergy == 10) {
					$map[$rowid][$columnid] = 0; // flash
					$flashs++;

					if(isset($map[$rowid-1][$columnid])) { $map[$rowid-1][$columnid] = ($map[$rowid-1][$columnid] != 0 and $map[$rowid-1][$columnid] != 10) ? $map[$rowid-1][$columnid] + 1 : $map[$rowid-1][$columnid]; } // top
					if(isset($map[$rowid+1][$columnid])) { $map[$rowid+1][$columnid] = ($map[$rowid+1][$columnid] != 0 and $map[$rowid+1][$columnid] != 10) ? $map[$rowid+1][$columnid] + 1 : $map[$rowid+1][$columnid]; } // bottom
					if(isset($map[$rowid][$columnid-1])) { $map[$rowid][$columnid-1] = ($map[$rowid][$columnid-1] != 0 and $map[$rowid][$columnid-1] != 10) ? $map[$rowid][$columnid-1] + 1 : $map[$rowid][$columnid-1]; } // left
					if(isset($map[$rowid][$columnid+1])) { $map[$rowid][$columnid+1] = ($map[$rowid][$columnid+1] != 0 and $map[$rowid][$columnid+1] != 10) ? $map[$rowid][$columnid+1] + 1 : $map[$rowid][$columnid+1]; } // right
					if(isset($map[$rowid+1][$columnid+1])) { $map[$rowid+1][$columnid+1] = ($map[$rowid+1][$columnid+1] != 0 and $map[$rowid+1][$columnid+1] != 10) ? $map[$rowid+1][$columnid+1] + 1 : $map[$rowid+1][$columnid+1]; } // bottom right
					if(isset($map[$rowid+1][$columnid-1])) { $map[$rowid+1][$columnid-1] = ($map[$rowid+1][$columnid-1] != 0 and $map[$rowid+1][$columnid-1] != 10) ? $map[$rowid+1][$columnid-1] + 1 : $map[$rowid+1][$columnid-1]; } // bottom left
					if(isset($map[$rowid-1][$columnid+1])) { $map[$rowid-1][$columnid+1] = ($map[$rowid-1][$columnid+1] != 0 and $map[$rowid-1][$columnid+1] != 10) ? $map[$rowid-1][$columnid+1] + 1 : $map[$rowid-1][$columnid+1]; } // top right
					if(isset($map[$rowid-1][$columnid-1])) { $map[$rowid-1][$columnid-1] = ($map[$rowid-1][$columnid-1] != 0 and $map[$rowid-1][$columnid-1] != 10) ? $map[$rowid-1][$columnid-1] + 1 : $map[$rowid-1][$columnid-1]; } // top left
				}
			}
		}
	}
	$step++;
}

echo 'Part 2 - First step during which all octopuses flash : '.$step."\n";

