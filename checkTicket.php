<?php
require "Medoo.php";

use Medoo\Medoo;

$type = "checkTicketResult";
$state = "";
$ticketRef = "";
$ticketTag = "";
$ticketEvent = "";
$ticketType = "";
$current = time();

if ($_POST['devicetoken'] == "" ||
	$_POST['eventID'] == "" ||
	$_POST['tagID'] == "") {
		$state = 301; //Parameters not enough
	} else {
		$deviceToken = $_POST['devicetoken'];
		$eventID = $_POST['eventID'];
		$tagID = $_POST['tagID'];
						
		//Connect DB
		$database = new Medoo([
	    'database_type' => 'mysql',
	    'database_name' => 'tc',
	    'server' => 'localhost',
	    'username' => 'tc',
	    'password' => 'lizhe20080722'
	    ]);
		
		//Check token
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
			$deviceID = $tokenData[0]["tc_device_id"];
		}
		if ( $userStatus == 200){
			
			$check1result = $database->update("tc_ticket", 
								["tc_ticket_state" => 0],
								[
								"AND" => 
								[
								"tc_ticket_tagid" => $tagID,
								"tc_ticket_eventid" => $eventID
							    ]]);
			
			if ( $check1result->rowCount() == 1 ) {
				$state = 200;
				$database->update("tc_ticket", [
							  "tc_ticket_checktime" => $current,
	                          "tc_ticket_checker" => $deviceToken,
	                          ],
							  [
							   "AND" =>[
								"tc_ticket_tagid" => $tagID,
								"tc_ticket_eventid" => $eventID
							    ]]);
			} else {
				$state = 400;
			}
	}
		
	}
	$output = $type.",".$state;
    echo $output;
?>