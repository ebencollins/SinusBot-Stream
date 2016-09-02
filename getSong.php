<?php
error_reporting('E_ERROR');
include("sinusbot.class.php");
include("config.php");
$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $passwd);
$status = $sinusbot->getStatus($inst);
$track = (($status["currentTrack"]["type"] == "url") ? $status["currentTrack"]["tempTitle"] : $status["currentTrack"]["title"]);
$artist = $status["currentTrack"]["tempArtist"];
$name = $track;
$track = preg_replace('^ ^', '+', $track);

// if(!empty($artist)) {
// echo $name." from ".$artist;
// } else {
// echo $name;
// }
function getTrack(){
	global $track;
	return $track;
}

function getName(){
	global $name;
	return $name;
}

function getArtist(){
	global $artist;
	return $artist;
}