<?php
$eventid=$_POST['eventid'];
$type="eventInfo";
$state="";
$eventName="";

if ($eventid == "testevent1") {
	$eventName = "TEST EVENT 1";
	$state="200";
} else if ($eventid == "testevent2") {
	$eventName = "TEST EVENT 2";
	$state="200";
} else {
	$state="301";
}
$output = $type."|".$state."|".$eventName;
echo $output;
	
?>