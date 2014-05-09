<?php
function get_stations ($line) {
	$station = array ();
	$stations = array ();
	$line_hash = array();
	$xmlparser = xml_parser_create();
	error_log( "inside get_trains" . "\n", 3, "stations-debugging.log");
	error_log($line . "\n", 3, "stations-debugging.log");
	$url = "http://cloud.tfl.gov.uk/TrackerNet/PredictionSummary/" . $line;
	error_log($url . "\n", 3, "stations-debugging.log");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$my_var = curl_exec($ch);
	curl_close($ch);
	// too much to log
	#error_log($my_var, 3, "php-debugging.log");
	xml_parse_into_struct($xmlparser,$my_var,$xml_array);
	foreach ($xml_array as $ele) {
		if ( $ele['tag'] == 'S') {
#			print "<p>" . var_dump($ele) . "</p>";
			if ( isset ($ele['attributes'] )) {
				foreach ($ele['attributes'] as $key => $value) {
#					print "<p>"  . $key . " " . $value . "</p>";
					if ( $key == "CODE" ) {
						$code = $value;
					} elseif ( $key == "N" ) {
						$name = $value ;
					} else {
						print "<p>This can't be happening!</p>";
						// exception here
					}
				}
				// now we have a station - push into stations
				$station = array ( $code, $name);
				array_push($stations, $station);
			}
		}
	}
	// how we have all the stations
	//print "<p>".var_dump($stations)."</p>";
	return $stations;
}//end function

?>