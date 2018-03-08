<?php
$eventid=$_POST['eventid'];
$eventname="";
$response="";
if ($eventid == "testevent1") {
	$eventname = "TEST EVENT 1";
	$response="200";
} else if ($eventid == "testevent2") {
	$eventname = "TEST EVENT 2";
	$response="200";
} else {
	$response="404";
}
$output = array ('event' => $eventname, 'state' => $response);
echo json_encode($output);
	
?>