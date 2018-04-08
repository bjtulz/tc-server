<?php
require "Medoo.php";

use Medoo\Medoo;

$type = "deviceLoginResult";

//input
$deviceToken = "";
$eventID = "";

//output
$state = "";
$deviceName = "";
$eventName = "";

$userStatus = "";

if ($_POST['devicetoken'] == "" || $_POST['eventID'] == "") {
		$state = 401; //Parameters not enough
	} else {
		$deviceToken = $_POST['devicetoken'];
		$eventID = $_POST['eventID'];
						
		$current = time();
		$database = new Medoo([
	    // required
	    'database_type' => 'mysql',
	    'database_name' => 'tc',
	    'server' => 'localhost',
	    'username' => 'tc',
	    'password' => 'lizhe20080722'
	    ]);
		$tokenData = $database->select("tc_device",
	                               "*",
								   ["tc_device_token" => $deviceToken]);
		if (count($tokenData) == 0 ) {
			$userStatus = 301; //token does not exist
			$state = 301;
		} else if ($tokenData[0]["tc_device_tokenexpire"] <= $current ){
			$userStatus = 302; //token expired; 
			$state = 302;
		} else {
			$userStatus = 200; //token active
			$deviceName = $tokenData[0]["tc_device_name"];
		}
		if ( $userStatus == 200){
			$eventData = $database->select("tc_event",
									"*",
									["tc_event_id" => $eventID]);
			if (count($eventData) == 0){
				$state = 303; // event not exist
			} else {
			if ($eventData[0]["tc_event_endtime"] <= $current) {
				$state = 304; // event expired
			} else {
				$state = 200;
				$eventName=$eventData[0]["tc_event_name"];
			}
			}
				
			}
			
			
		}
		
	
	$output = $state.",".$deviceName.",".$eventName;
    echo $output;
?>