<?php

$ip = "000.000.000.000"; //IP Address of the server SinusBot is running on (NOT localhost)
$port = "8087"; //Port that the web panel is running on (default 8087)
$user = "webstream"; //username to login to the web panel 
$passwd = "R3m3mb3rm3"; //corresponding password

$title = "SinusBot-Radio"; //title to display
$teamspeakJoinLink="ts3server://000.000.000.000?server_uid=SERVER_UID"; //generate link in teamspeak by doing the following: Click tools on the menu bar, select invite buddy, select in my current server (or channel if you want), invitation ts3server link, paste the link here.

$useCachedThumbnail = true; //if stored, should the cached image be used? (quality will vary) (default:true)
$findThumbnailFromMetaData = true; //should a thumbnail image be extracted from metadata if the cached thumbnail isn't found or is disabled? Currently only works with youtube. (default: true)
$searchForThumbnail = false; //if no thumbnail can be found based on metadata, should youtube be searched? (CURRENTLY NOT IMPLEMENTED)

$instanceIDS = array("UID1","UID2");
$instanceNames = array("MusicBot #1","MusicBot #2");
$defaultInstance = 0;


#------Do NOT modify the following:------#
$ipport = $ip.":".$port;

?>
