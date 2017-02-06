<?php
error_reporting('E_ERROR');
require_once("sinusbot.class.php");
require_once("config.php");
$sinusbot = new SinusBot($sinusbotURL);
$sinusbot->login($user, $passwd);
$status = $sinusbot->getStatus($instanceIDS[$defaultInstance]);

// MARK: POST
if (isset($_POST['getData'])) {
    $status = $sinusbot->getStatus($_POST['getData']);
    $returnData = array(
      "img" => "",
      "songname" => ""
      );
    if(getTrack() == null || getTrack() == ""){
      $finalURL = '<p>No song name given.</p>';
    }else{
      $link = 'https://www.google.com/search?q=' . getTrack();
		
        if(($urlFromMD = checkMetaDataForURL()) !== false){ //there is a URL
		    if(($urlFull = resolveURL($urlFromMD)) !== false){ //it can be resolved to something
		    	$link = $urlFull;
		    }
		}

		if(getArtist() != "" && getArtist() != null) {
			$finalURL = '<a class="songlink" href="'.$link.'" target="_blank">Song: '.getTrack().' from ' .getArtist(). '</a>';
		} else {
			$finalURL = '<a class="songlink" href="'.$link.'" target="_blank">Song: '.getTrack().'</a>';
		}
	}
    if(strlen($finalURL) > 1000){
        $finalURL = '<a class="songlink" href="#" target="_blank">Error getting songname.</a>';
    }
	$returnData['songname'] = $finalURL;



    $unknownimg = $defaultThumbnail;;
    $finalURL = $unknownimg;

    if($useCachedThumbnail && $finalURL == $unknownimg){
    	if(array_key_exists('thumbnail', $status['currentTrack'])){
    		$thumbnailURL = $sinusbotURL . "/cache/" . $status['currentTrack']['thumbnail'];
    		$finalURL = $thumbnailURL;
    	}
    }
    if(isset($urlFull) && $urlFull != ""){
        if(($ytID = getYoutubeID($urlFull)) !== false){ //it's a youtube link
            $finalURL = "https://i.ytimg.com/vi/". $ytID ."/sddefault.jpg";
            if(returns404($finalURL)) {
                $finalURL = "https://i.ytimg.com/vi/". $ytID ."/hqdefault.jpg";
            }
        }
    }
    if($searchForThumbnail && $finalURL == $unknownimg){
    	// implement at some point
    }

    if(strlen($finalURL) > 1000){
      $finalURL = $unknownimg;
    }

    $returnData['img'] = $finalURL;

    echo (json_encode($returnData));

}
elseif(isset($_POST['getWebStream'])){
    $returnArr = array(
        "webstream" => "",
        "instance" => "",
        "instanceID" => 0,
        "instanceName" => ""
        );

    $returnArr['webstream'] = $sinusbot->getWebStream($_POST['getWebStream']);
    $returnArr['instance'] = $_POST['getWebStream'];
    $returnArr['instanceID'] = array_search($_POST['getWebStream'], $instanceIDS);
    $returnArr['instanceName'] = $instanceNames[$returnArr['instanceID']];
    echo(json_encode($returnArr));
}elseif(isset($_POST['status'])){
    print_r($status);
}


// MARK: FUNCTIONS
function getTrack(){
    global $status;
    $defaultTrack = "Error: Could not get songname.";
    $track = $defaultTrackname;
    try {
        if($track != $defaultTrack){
            if(array_key_exists("title", $status['currentTrack']) && isset($status['currentTrack']['title'])){
                $track = $status['currentTrack']['title'];
            }else if(array_key_exists("filename", $status['currentTrack']) && isset($status['currentTrack']['filename'])){
                $track = $status['currentTrack']['filename'];
            }
        }
        if($track != $defaultTrack){
            if(array_key_exists("type", $status['currentTrack']) && isset($status['currentTrack']['type']) && $status['currentTrack']['type'] == "url"){
                if(array_key_exists("tempTitle", $status['currentTrack']) && isset($status['tempTitle']['title'])){
                    $track = $status['currentTrack']['tempTitle'];
                }
            }
        }
    }catch(Exception $e){
        return $track;
    }
    return $track;
}

function getName(){
    return getTrack();
}

function getArtist(){
    global $status;
    $artist = "";
    try {
        if($artist = ""){
            if(array_key_exists("artist", $status['currentTrack']) && isset($status['currentTrack']['artist'])){
                $artist = $status['currentTrack']['artist'];
            }
        }
        if($artist == ""){
            if(array_key_exists("type", $status['currentTrack']) && isset($status['currentTrack']['type']) && $status['currentTrack']['type'] == "url"){
                if(array_key_exists("tempArtist", $status['currentTrack']) && isset($status['currentTrack']['tempArtist'])){
                    $artist = $status['currentTrack']['tempArtist'];
                }
            }
        }
    }catch(Exception $e){
        $artist = "";
    }
    return $artist;
}

function checkMetaDataForURL(){
    global $status;
    $checkStrings = array($status['currentTrack']['filename'],
        $status['currentTrack']['album'],
        $status['currentTrack']['artist']
        );

    foreach ($checkStrings as $str) {
        if(validateURL($str) !== false){
            return $str;
        }
    }
    return false;
}

function validateURL($url){
    $url = preg_replace('/\s+/S', "", $url);
    try{
        if($urlParts = parse_url($url)){
            if(!isset($urlParts['scheme'])){
                $url = "http://$url";
                $urlParts = parse_url($url);
            }
            if(!isset($urlParts['host'])){
                return false;
            }
            if(($url = filter_var($url, FILTER_VALIDATE_URL)) === false){
                return false;
            }
        }else{
            return false;
        }
        if(returns404($url)) {
            return false;
        }
    }catch(Exception $e){
        return false;
    }

    return $url;
}

function returns404($url){
    try{
        $file_headers = @get_headers($url);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.0 404 Not Found' || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            return true;
        }else{
            return false;
        }
    }
    catch(Exception $e){
        return false;
    }
    return false;
}

function resolveURL($url){
    try{
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch,CURLOPT_HEADER,true); // Get header information
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,false);
        $header = curl_exec($ch);
        $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header)); // Parse information

        for($i=0;$i<count($fields);$i++){
            if(strpos($fields[$i],'Location') !== false){
             $url = str_replace("Location: ","",$fields[$i]);
         }
     }
     return $url;
 }catch(Exception $e){
  return false;   
}
}


function getYoutubeID($url){
    if($query = parse_url($url, PHP_URL_QUERY)){
        if(($startPos = strpos($query, 'v=')) !== false){
            $startPos += 2;
            return substr($query, $startPos, 11);
        }
    }
    return false;
}

?>
