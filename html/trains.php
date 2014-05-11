<?php 
//include_once('header_refresh.php'); 
include_once('header.php'); 
//include_once('header_jquery.php'); 

// returns a hash containing:
// 'platform code' => ( platform name, (trains)),
// 'platform code' => ( platform name, (trains))
// 
function get_trains($l,$s) {
	$xmlparser = xml_parser_create();
#	error_log( "inside get_trains");
#	error_log($l);
#	error_log($s);
	$url = "http://cloud.tfl.gov.uk/TrackerNet/PredictionDetailed/" . $l . "/" . $s;
#	error_log($url);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$my_var = curl_exec($ch);
	curl_close($ch);
	xml_parse_into_struct($xmlparser,$my_var,$xml_array);
	return $xml_array;
}

?>

<div class="container" style = "background: none repeat scroll 0% 0% white; width: 100%;">

	<div class="alert alert-info">
		<strong><?php  echo $lines[$_SESSION['selected_line']];?> Line</strong><p/>
		<strong><?php $station_code=$_SESSION['selected_station']; $station_name=$_SESSION[$station_code]; echo $station_name; ?> Station</strong>
	</div>


<?php
// access tfl and get the board
// line: $_SESSION['selected_line']
// station: $_SESSION['selected_station']
//  s="<div class" . '"' . "alert alert-info" . '">';

//	print "<p>Line: " . $lines[$_SESSION['selected_line']] . "</p>";
//	$station_code=$_SESSION['selected_station'];
//	$station_name=$_SESSION[$station_code];
//	print "<p>Station: " . $station_name . "</p>";
	#print "<p>Calling get_trains</p>";
	$trains = get_trains($_SESSION['selected_line'],$_SESSION['selected_station']);
	#print "<pre>" . print_r($trains) . "</pre>";
#	echo "<pre>";

print '<div id="section01">' . "\n";

	foreach ($trains as $ele) {
#		echo "<pre>";
		#print_r($ele);
		if ($ele['tag'] == 'WHENCREATED') { 	
			$last_update=$ele['value'];
			print '<div class="alert alert-info">' . "Last updated: " . $last_update . " (Page Refreshes Automatically)</div>";
		} elseif ( $ele['tag'] == 'S') {
#			print "<p>" . print_r($ele) . "</p>";
#			$name = $ele['N'];
			#print_r($ele);
			# expect one for the station, and at least another one for closing
			# and perhaps more
		} elseif ( $ele['tag'] == 'P') {
			#print "<p>";
			#print_r($ele);
			#print "</p>";
			foreach ($ele as $key => $value) {
				#print "<p>" . print_r($ele) . "</p>";
				if ($key == "attributes") {
					foreach ($value as $k => $v) {
#						$t = $t . $v . " ";
#						print "<pre>" . $v . "</pre>";							
						if ($k == "N") {
							$t = "Platform: " . $v . " ";
#							print "<pre>" . $v . "</pre>";							
						} elseif ($k == "NUM") {
#							$t = $t . "Nr.: " . $v . " ";
						} elseif ($k == "TRACKCODE") {
#							$t = $t . "TrackCode: " . $v . " ";
						}
					}
					// platform
#					print "<pre>" . $t . "</pre>";	
					print '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">Platform</h3></div><div class="panel-body">';
					print "$t";
					print "</div></div>";
					//print '<div class="alert alert-info">' . $t . '</div>';
				}
			}
			# repeated again and again
		} elseif ( $ele['tag'] == 'T') {
/*
						Array ( [tag] => T [type] => complete [level] => 4 [attributes] => Array ( [LCID] => 1108419 [SETNO] => 360 [TRIPNO] => 5 [SECONDSTO] => 130 [TIMETO] => 2:30 [LOCATION] => Between St. John Wood and Baker Street [DESTINATION] => North Greenwich [DESTCODE] => 333 [ORDER] => 0 [DEPARTTIME] => 7:07:40 [DEPARTINTERVAL] => 130 [DEPARTED] => 0 [DIRECTION] => 0 [ISSTALLED] => 0 [TRACKCODE] => TJ30658 [LN] => J ) )
*/				
				
#			print "<p>" . print_r($ele) . "</p>";
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
//	echo "</pre>";
	print "</div>\n";

?>


</div><!-- containter -->

<?php include_once('footer.php'); ?>
