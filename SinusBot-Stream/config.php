<?php

$ip = "000.000.000.000"; //IP Address of the server SinusBot is running on (NOT localhost)
$port = "8087"; //Port that the web panel is running on (default 8087)
$user = "webstream"; //username to login to the web panel 
$passwd = "R3m3mb3rm3"; //corresponding password

$title = "SinusBot-Radio"; //title to display
$teamspeakJoinLink="ts3server://000.000.000.000?server_uid=SERVER_UID"; //generate link in teamspeak by doing the following: Click tools on the menu bar, select invite buddy, select in my current server (or channel if you want), invitation ts3server link, paste the link here.

$findThumbnailFromMetaData = true; //should a thumbnail image be extracted from metadata? Currently only works with youtube. (default: true)
$searchForThumbnail = false; //if no thumbnail can be found based on metadata, should youtube be searched? (CURRENTLY NOT IMPLEMENTED)
$useCachedThumbnail = true; //if a thumbnail cannot be found online based on the metadata, should it use the cached copy? (resolution may vary) (default: true)
//Note: The above three methods are exceuted in that order; ie. if enabled, metadata will be searched first, then if nothing is found search will be used, if nothing found cached thumbnail will be used, if nothing else the default music icon will be displayed.

$instanceIDS = array("UID1","UID1");
$instanceNames = array("MusicBot #1","MusicBot #2");
$defaultInstance = 0;


#------Do NOT modify the following:------#
$ipport = $ip.":".$port;

?>
