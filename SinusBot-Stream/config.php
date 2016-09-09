<?php

$ip = "000.000.000.000"; //IP Address of the server SinusBot is running on (NOT localhost)
$port = "8087"; //Port that the web panel is running on (default 8087)
$user = "webstream"; //username to login to the web panel 
$passwd = "R3m3mb3rm3"; //corresponding password


$instanceIDS = array("UID1","UID2"); //array of all musicbot instance UIDs that will be active
$instanceNames = array("MusicBot #1","MusicBot #2"); //corresponding titles to UIDs
$defaultInstance = 0; //which instance from the array above should be default?


$title = "SinusBot-Radio"; //title to display
$teamspeakJoinLink="ts3server://000.000.000.000?server_uid=SERVERUID"; //(optional) join link for your teamspeak server (opened when teamspeak icon is clicked). If left blank, ts3 icon will not show.


//Do NOT modify the following:
$ipport = $ip.":".$port;

?>
