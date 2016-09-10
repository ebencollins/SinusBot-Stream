<?php
error_reporting('E_ERROR');
include("sinusbot.class.php");
include("config.php");
session_start();
$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $passwd);
$status = $sinusbot->getStatus($instanceIDS[$_SESSION['inst']]);
$track = (($status["currentTrack"]["type"] == "url") ? $status["currentTrack"]["tempTitle"] : $status["currentTrack"]["title"]);
$artist = $status["currentTrack"]["artist"];
$name = $track;
$track = preg_replace('^ ^', '+', $track);

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

function checkMetaDataForURL(){
    global $status;
    $checkStrings = array($status['currentTrack']['filename'],
        $status['currentTrack']['album'],
        $status['currentTrack']['artist']
    );

    foreach ($checkStrings as $str) {
        if(filter_var($str, FILTER_VALIDATE_URL) !== false){
            return $str;
        }
    }
    return false;
}

function resolveURL($url){
    try{
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_HEADER,true); // Get header information
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,false);
    $header = curl_exec($ch);
    
    $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header)); // Parse information

    for($i=0;$i<count($fields);$i++)
    {
        if(strpos($fields[$i],'Location') !== false)
        {
            $url = str_replace("Location: ","",$fields[$i]);
        }
    }
    return $url;
    }catch(Exception $e){
        return false;
    }
}

function getYoutubeID($url){
    if(strpos($url,"youtube.com/watch?v=") !== false){
        $startPos = strpos($url, '?v=') + 3;
        return substr($url, $startPos, 11);
    }
    return false;
}

?>