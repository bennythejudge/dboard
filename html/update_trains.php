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
			print '<div class="alert alert-info">' . "Last updated: " . $last_update . " (Page Refreshes Automatically)</div>";
//			print '<div class="alert alert-info">Last updated: ' . $last_update . '</div>' . "\n";
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
					print '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">Platform</h3></div><div class="panel-body">';
					print "$t";
					print "</div></div>";
					//print '<div id="platform">' . $t . "</div>\n";	
				}
			}
			# repeated again and again
		} elseif ( $ele['tag'] == 'T') {
						foreach($ele as $key=>$value) {
							if ($key == "attributes") {
								foreach ($value as $k => $v) {
									// if line is the same as the selected line, ignore
									if ( $k == 'LN') {
										#print "<p>" . $lines[$_SESSION['selected_line']] . "</p>";	
										#print "<p>" . $lines[$v] . "</p>";
										if ( $lines[$_SESSION['selected_line']] != $lines[$v]) {
			//								$screen_line[0] = "<li>" . 'Line: ' . $lines[$v] . "</li>";								
											$screen_line[0] = "<p>" . 'Line: ' . $lines[$v] . "</p>";								

										} else {
											$screen_line[0] = '';	
										}
									} elseif ($k == 'DESTINATION') {
			//							$screen_line[1] = "<li>" . 'Dest: ' . $v . "</li>";
										$screen_line[1] = "<p>" . 'Dest: ' . $v . "</p>";
									} elseif ($k == 'TIMETO') {
			//							$screen_line[2] = "<li>" . 'Time: ' . $v . "</li>";
										if ( $v == '-') {
											// nothing - train at platform, don't print anything
										}
										else {
											$screen_line[2] = "<p>" . 'Next train in  ' . $v . "m</p>";								
										}
									} elseif ($k == 'LOCATION' ) {
			//							$screen_line[3] = "<li>" . 'Loc.: ' . $v . "</li>";
										$screen_line[3] = "<p>" . 'Loc.: ' . $v . "</p>";
									} elseif ($k == 'ISSTALLED' && $v != 0) {
			//							$screen_line[3] = "<li>" . 'Stalled' . "</li>";
										$screen_line[3] = "<p>" . 'Stalled' . "</p>";
									}
								}
							} else {
			#					if ( $key != 'tag' && $key != 'type' && $key != 'level') {
			#						$screen_line[] = "<li>" . $key . " : " . $value . "</li>";											
			#					}
							}
							print "<p/><p/>";
						}
			//			print ""
			//			print '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">Platform</h3></div><div class="panel-body">';
						print '<div id="train">' . "\n"; 
						for ($i=0; $i<=3; $i++) {
							print $screen_line[$i];	
						}
			//			print "</div></div>";
						print "<hr/>";
						print "</div>\n";
						$screen_line=array();
					}
					$screen_line=array();
	}
//	echo "</body>\n</html>\n";
?>