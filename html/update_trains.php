<?php
/* When we do is  :At each interval we request server (create new file : update_train.php).
In this file, you need write code, what you have written for train.php. The output should 
be trains only (container1,container2). NOT all dropdowns of stations,line,etc,etc
$_SESSION['selected_line']  line
$_SESSION['selected_station'];  stations

*/

function get_trains($l,$s) {
	$xmlparser = xml_parser_create();
	$url = "http://cloud.tfl.gov.uk/TrackerNet/PredictionDetailed/" . $l . "/" . $s;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$my_var = curl_exec($ch);
	curl_close($ch);
	xml_parse_into_struct($xmlparser,$my_var,$xml_array);
	return $xml_array;
}	


/* starts here ================================================================== */
session_start();
require_once("lines.php");
//print "<p>inside update_trains.php</p>";
//print "<p>line: " . $_SESSION['selected_line'] . "</p>";
//print "<p>station: " . $_SESSION['selected_station'] . "</p>";

$trains = get_trains($_SESSION['selected_line'],$_SESSION['selected_station']);

// just for testing
//	$trains = get_trains("H","STG");
//	print "<html>\n<head>\n</head>\n<body>\n";
	
	foreach ($trains as $ele) {
		if ($ele['tag'] == 'WHENCREATED') { 
			$last_update=$ele['value'];
			print '<div id="last_updated">Last updated: ' . $last_update . '</div>' . "\n";
		} elseif ( $ele['tag'] == 'S') {
			# do nothing
		} elseif ( $ele['tag'] == 'P') {
			foreach ($ele as $key => $value) {
				if ($key == "attributes") {
					foreach ($value as $k => $v) {
						if ($k == "N") {
							$t = "Platform: " . $v . " ";
						} elseif ($k == "NUM") {
							# do nothing
						} elseif ($k == "TRACKCODE") {
							# do nothing
						}
					}
					print '<div id="platform">' . $t . "</div>\n";	
				}
			}
			# repeated again and again
		} elseif ( $ele['tag'] == 'T') {
			foreach($ele as $key=>$value) {
				if ($key == "attributes") {
					foreach ($value as $k => $v) {
						// if line is the same as the selected line, ignore
						if ( $k == 'LN') {
							// if ( $lines[$_SESSION['selected_line']] != $lines[$v]) {
								$nowline="H";
						 	if ( "H" != $lines[$v]) {
								$screen_line[0] = "<li>" . 'Line: ' . $lines[$v] . "</li>";								
							} else {
								$screen_line[0] = '';	
							}
						} elseif ($k == 'DESTINATION') {
							$screen_line[1] = "<li>" . 'Dest: ' . $v . "</li>";
						} elseif ($k == 'TIMETO') {
							$screen_line[2] = "<li>" . 'Time: ' . $v . "</li>";
						} elseif ($k == 'LOCATION' ) {
							$screen_line[3] = "<li>" . 'Loc.: ' . $v . "</li>";
						} elseif ($k == 'ISSTALLED' && $v != 0) {
							$screen_line[3] = "<li>" . 'Stalled' . "</li>";
						}
					}
				} else {
					# do nothing
				}
			}
			print '<div id="train">' . "\n";
			print "<ul>";
			for ($i=0; $i<=3; $i++) {
				print $screen_line[$i];	
			}
			print "</ul>";
			print "</div>\n";
			$screen_line=array();
		}
		$screen_line=array();
	}
//	echo "</body>\n</html>\n";
?>