<?php
error_reporting('E_ERROR');

include("sinusbot.class.php");
include("config.php");
session_start();

$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $passwd);

$status = $sinusbot->getStatus($instanceIDS[$_SESSION['inst']]);

$thumbnail = $status["currentTrack"]["thumbnail"];

$url = $sinusbot->getThumbnail($thumbnail);
$url = preg_replace("^http\:\/\/127.0.0.1:8087\/^", $ipport, $url);

if(strpos($status['currentTrack']['filename'], 'www.youtube.com/watch?v=') !== false){
	$startPos = strpos($status['currentTrack']['filename'], '?v=') + 3;
	$ytID = substr($status['currentTrack']['filename'], $startPos, 11);
	$imageURL = "https://i.ytimg.com/vi/". $ytID ."/sddefault.jpg";
	echo $imageURL;
}else if(strpos($status['currentTrack']['album'], 'youtube.com/watch?v=') !== false){
	$startPos = strpos($status['currentTrack']['album'], '?v=') + 3;
	$ytID = substr($status['currentTrack']['album'], $startPos, 11);
	$imageURL = "https://i.ytimg.com/vi/". $ytID ."/sddefault.jpg";
	echo $imageURL;
}else{
	echo "resources/unknownimg.png";
}



