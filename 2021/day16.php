<?php

/* Parts 1 and 2 */

function hex2binstr($hex) {
	$bin = '';
	foreach (str_split($hex) as $char) {
		$bin.= str_pad(base_convert($char, 16, 2), 4, 0, STR_PAD_LEFT);
	}
	return $bin;
}

function packetDecoder($packet) {
	$version = bindec(substr($packet, 0, 3));
	$typeid = bindec(substr($packet, 3, 3));

	if($typeid == 4) { // literal value
		$number = '';
		$cursor = 6;
		do {
			$number.= substr($packet, $cursor+1, 4);
			$cursor+= 5;
		} while(substr($packet, ($cursor-5), 1) == 1);
		$number = bindec($number);

		return ['version' => $version, 'typeid' => $typeid, 'literalvalue' => $number, 'length' => $cursor, 'versionsum' => $version, 'expvalue' => $number];
	}
	else { // operator
		$versionsum = $version;
		$length_type_id = substr($packet, 6, 1);

		if($length_type_id) {
			$number_of_subpackets = bindec(substr($packet, 7, 11));
			$subpackets = [];
			$cursor = 18;
			$i = 0;
			while($i < $number_of_subpackets) {
				$subpackets[] = packetDecoder(substr($packet, $cursor));
				$cursor+= $subpackets[count($subpackets)-1]['length'];
				$versionsum+= $subpackets[count($subpackets)-1]['versionsum'];
				$i++;
			}
		}
		else {
			$total_length_of_subpackets = bindec(substr($packet, 7, 15));
			$cursor = 22;
			while(($cursor-22) < $total_length_of_subpackets) {
				$subpackets[] = packetDecoder(substr($packet, $cursor));
				$cursor+= $subpackets[count($subpackets)-1]['length'];
				$versionsum+= $subpackets[count($subpackets)-1]['versionsum'];
			}
		}

		// Begin part 2 specific (expression eval.)
		if($typeid == 0) { $expvalue = 0; foreach($subpackets as $value) $expvalue+= $value['expvalue']; }
		if($typeid == 1) { $expvalue = 1; foreach($subpackets as $value) $expvalue*= $value['expvalue']; }
		if($typeid == 2) $expvalue = min(array_column($subpackets, 'expvalue'));
		if($typeid == 3) $expvalue = max(array_column($subpackets, 'expvalue'));
		if($typeid == 5) $expvalue = ($subpackets[0]['expvalue'] > $subpackets[1]['expvalue']) ? 1 : 0;
		if($typeid == 6) $expvalue = ($subpackets[0]['expvalue'] < $subpackets[1]['expvalue']) ? 1 : 0;
		if($typeid == 7) $expvalue = ($subpackets[0]['expvalue'] == $subpackets[1]['expvalue']) ? 1 : 0;
		// End part 2 specific

		return ['version' => $version, 'typeid' => $typeid, 'subpackets' => $subpackets, 'length' => $cursor, 'versionsum' => $versionsum, 'expvalue' => $expvalue];
	}
}



$input = trim(file_get_contents('input16.txt'));
$input = hex2binstr($input);


$decodedpacket = packetDecoder($input);

echo 'Part 1 - Version sum : '.$decodedpacket['versionsum']."\n"; // 1007
echo 'Part 2 - Exp. value : '.$decodedpacket['expvalue']."\n"; // 834151779165
