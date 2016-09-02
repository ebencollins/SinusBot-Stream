<?php
error_reporting('E_ERROR');

include("sinusbot.class.php");
include("config.php");

$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $passwd);

$status = $sinusbot->getStatus($inst);

$thumbnail = $status["currentTrack"]["thumbnail"];

$url = $sinusbot->getThumbnail($thumbnail);
$url = preg_replace("^http\:\/\/127.0.0.1:8087\/^", $ipport, $url);

if($url != $ipport."/cache/") {
	echo "<img src='".$url."' width='300' height='300' alt='Song-Image'>";
} else {
	echo "<img id = 'img' src='resources/unknownimg.png' alt='No Thumbnail'>";
}
