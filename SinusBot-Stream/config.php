<?php

$ip = "000.000.000.000"; //IP Adrress or domain that points at the server. Note that this must be an external IP. localhost/127.0.0.1/etc won't work.
$port = "8087"; //Port that the web panel is running on. (default: 8087)
$enableSSL = false; //this should match the settting in your sinusbot config or some stuff might not load properly. (default: false)

$user = "webstream"; //username to login to the web panel 
$passwd = "r3m3mb3rm3"; //corresponding password
$title = "SinusBot-Radio v1.1"; //title to display

$teamspeakJoinLink="ts3server://000.000.000.000?server_uid=yourserveruid"; //generate link in teamspeak by doing the following: Click tools on the menu bar, select invite buddy, select in my current server (or channel if you want), invitation ts3server link, paste the link here.

$useCachedThumbnail = true; //if a thumbnail cannot be found online based on the metadata, should it use the cached copy? Note that the resolution may vary. (default: true)
$findThumbnailFromMetaData = true; //should a thumbnail image be extracted from metadata? Currently only works with youtube. (default: true)
$searchForThumbnail = false; //if no thumbnail can be found based on metadata, should youtube be searched? (CURRENTLY NOT IMPLEMENTED)
//Note: The above three methods are exceuted in that order; ie. assuming all are enabled, first the cached thumbnail will be used, if one doesn't exist the metadata will be searched, if that doesn't work, one will be searched for.
$defaultThumbnail = "resources/unknownimg.png"; //default image of none of the above methods return one.


$instanceIDS = array("UUID1", "UUID2");
$instanceNames = array("MusicBot #1", "MusicBot #2");
$defaultInstance = 0;


#------Do NOT modify the following (without good reason):------#
$sinusbotURL = ($enableSSL ? "https://" : "http://") . $ip .":".$port;

?>
