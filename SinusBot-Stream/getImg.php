<?php
error_reporting('E_ERROR');
include("getSong.php");

$finalURL = "resources/unknownimg.png";

if($findThumbnailFromMetaData && (($urlFromMD = checkMetaDataForURL()) !== false)){ //there is a URL and this search method is enabled
    if(($urlFull = resolveURL($urlFromMD)) !== false){ //it can be resolved to something
        if(($ytID = getYoutubeID($urlFull)) !== false){ //it's a youtube link
          $finalURL = "https://i.ytimg.com/vi/". $ytID ."/sddefault.jpg";
        }
    }
}else if($searchForThumbnail && $finalURL == "resources/unknownimg.png"){
//implement at some point
}else if($useCachedThumbnail && ($finalURL == "resources/unknownimg.png")){
    if(array_key_exists('thumbnail', $status['currentTrack'])){
        $thumbnailURL = "http://" . $ipport . "/cache/" . $status['currentTrack']['thumbnail'];
        $finalURL = $thumbnailURL;
    }
}
echo $finalURL;

?>