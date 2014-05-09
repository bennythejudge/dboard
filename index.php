<?php
session_start();
error_reporting(0);
ini_set('max_execution_time', 0);
$site_url = 'https://'.$_SERVER['SERVER_NAME'].'/dboard';

require_once("utility.php");
require_once("html/lines.php");

if($_REQUEST['action'] == 'stations'){
	$selected_line = $_GET['line']; //get line 
	$selected_line = (empty($selected_line)) ? 'H' : $selected_line; //if line empty set default line ie H
	$_SESSION['selected_line'] = $selected_line; //set selected line in session. We need to use this line to fetch train details  
	$stations = get_stations($selected_line); //all logic in controller,template should use only for rendering
	require_once('html/stations.php');
}else if($_REQUEST['action'] == 'trains'){
	$selected_station = $_GET['station']; //get line 
	$selected_station = (empty($selected_station)) ? 'STG' : $selected_station; //if station empty // set default station 	// to STG
	$_SESSION['selected_station'] = $selected_station; 							//set selected station in session. 
	require_once('html/trains.php');
}else{
	# first time!
	require_once('html/home.php');
}
?>