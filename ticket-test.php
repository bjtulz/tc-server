<?php
$ticketid=$_POST['ticketid'];
$eventid=$_POST['eventid'];
$ticketType="";
$ticketID="";
$ticketState="";
$ticketEvent="";
$ticketAddinfo="";
$type="ticketInfo";
$response="";
if ($ticketid == "042776d2024680" && $eventid == "testevent1") {
	$ticketType="SINGLE ENTRY TICKET";
	$ticketID="10000001";
	$ticketState="Available";
	$ticketEvent="TEST EVENT 1";
	$ticketAddinfo = "Standard ticket, succeed to use.";
	$response="200";
} else if ($ticketid == "042776d2024680" && $eventid == "testevent2") {
	$ticketType="NO SUCH TICKET";
	$ticketID="NA";
	$ticketState="Unavailable";
	$ticketEvent="NA";
	$ticketAddinfo = "Can not find any available ticket for this tag.";
	$response="301";
} else if ($ticketid == "04f76e824e4d80" && $eventid == "testevent2") {
	$ticketType="SINGLE ENTRY TICKET";
	$ticketID="20000001";
	$ticketState="Available";
	$ticketEvent="TEST EVENT 2";
	$ticketAddinfo = "Standard ticket, succeed to use.";
	$response="200";
} else if ($ticketid == "04f76e824e4d80" && $eventid == "testevent1") {
	$ticketType="NO SUCH TICKET";
	$ticketID="NA";
	$ticketState="Unavailable";
	$ticketEvent="NA";
	$ticketAddinfo = "Can not find any available ticket for this tag.";
	$response="301";
} else if ($ticketid == "04fba7eaa82b80" && $eventid == "testevent1") {
	$ticketType="SINGLE ENTRY TICKET";
	$ticketID="10000002";
	$ticketState="Used";
	$ticketEvent="TEST EVENT 1";
	$ticketAddinfo = "This ticket is used on 2018.03.07 22:29, can not be used this time.";
	$response="302";
} else if ($ticketid == "04fba7eaa82b80" && $eventid == "testevent2") {
	$ticketType="NO SUCH TICKET";
	$ticketID="NA";
	$ticketState="Unavailable";
	$ticketEvent="NA";
	$ticketAddinfo = "Can not find any available ticket for this tag.";
	$response="301";
} else if ($ticketid == "04a37da2c94c80" && $eventid == "testevent2") {
	$ticketType="SUPER TICKET";
	$ticketID="2S000001";
	$ticketState="Available";
	$ticketEvent="TEST EVENT 2";
	$ticketAddinfo = "Super ticket for multiple uses.";
	$response="201";
} else if ($ticketid == "04a37da2c94c80" && $eventid == "testevent1") {
	$ticketType="SUPER TICKET";
	$ticketID="1S000001";
	$ticketState="Available";
	$ticketEvent="TEST EVENT 1";
	$ticketAddinfo = "Super ticket for multiple uses.";
	$response="201";
} else {
	$ticketType="NA";
	$ticketID="NA";
	$ticketState="NA";
	$ticketEvent="NA";
	$ticketAddinfo = "What on earth do you want?";
	$response="404";
}
$output = $type.",".$response.",".$ticketType.",".$ticketID.",".$ticketState.",".$ticketEvent.",".$ticketAddinfo;
echo $output;
	
?>