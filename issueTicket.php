<?php
require "Medoo.php";

use Medoo\Medoo;

$type = "issueTicketResult";
$state = "";
$ticketRef = "";
$ticketTag = "";
$ticketEvent = "";
$ticketType = "";

if ($_POST['devicetoken'] == "" ||
	$_POST['eventID'] == "" ||
	$_POST['tagID'] == "" ||) {
		$state = 301; //Parameters not enough
	} else {
		$deviceToken = $_POST['userToken'];
		$eventID = $_POST['eventID'];
		$tagID = $_POST['tagID'];
		$deviceID = "";
		
		$ticketType = 1;
		$ticketNotes = 'Ticket issued by device';
				
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
		} else if ($tokenData[0]["tc_usertoken_timelimit"] <= $current ){
			$userStatus = 302; //token expired; 
			$state = 302;
		} else {
			$userStatus = 200; //token active
			$deviceID = $tokenData[0]["tc_device_id"];
		}
		if ( $userStatus == 200){
			$ref = md5($current.$tagID.$eventID);
			$database->insert("tc_ticket", [
	                          "tc_ticket_ticketref" => $ref,
							  "tc_ticket_tagid" => $tagID,
							  "tc_ticket_eventid" => $eventID,
							  "tc_ticket_issuetime" => $current,
							  "tc_ticket_issuer" => $deviceID,
							  "tc_ticket_issuertype" => 2,
	                          "tc_ticket_type" => $ticketType,
	                          "tc_ticket_state" => 1,
							  "tc_ticket_note" => $ticketNotes
							  ]);
			$ticketNewID = $database->id();
			if ( $ticketNewID != 0 ) {
				$state = 200;
				$ticketRef = $ref;
				$ticketTag = $tagID;
				$ticketEvent = $eventID;
			} else {
				$state = 303;
			}
			
		}
		
	}
	$output = array(
	             'type' => $type,
	             'state' => $state,
                 'ticketRef' => $ticketRef,
				 'ticketTag' => $ticketTag,
				 'ticketEvent' => $ticketEvent);
    echo json_encode($output);
?>