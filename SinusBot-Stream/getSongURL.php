<?php
error_reporting('E_ERROR');
include("getSong.php");
$link = "";

if(strpos($status['currentTrack']['filename'], 'www.youtube.com/watch?v=') !== false){
	$startPos = strpos($status['currentTrack']['filename'], '?v=') + 3;
	$link = "http://youtube.com/watch?v=" . substr($status['currentTrack']['filename'], $startPos, 11);
}else if(strpos($status['currentTrack']['album'], 'youtube.com/watch?v=') !== false){
	$startPos = strpos($status['currentTrack']['album'], '?v=') + 3;
	$link = "http://youtube.com/watch?v=" . substr($status['currentTrack']['album'], $startPos, 11);
}else{
	$link = 'https://www.google.com/search?q=' . getTrack();
}
if(!empty(getArtist())) {
	echo '<a href="'.$link.'" target="_blank">Song: '.getName().' from ' .getArtist(). '</a>';
} else {
	echo '<a href="'.$link.'" target="_blank">Song: '.getName().'</a>';
}