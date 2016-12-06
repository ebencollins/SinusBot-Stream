<?php
error_reporting('E_ERROR');
require("getSong.php");

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
echo $finalURL;

?>
