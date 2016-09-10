<?php
error_reporting('E_ERROR');
include("getSong.php");
$link = "";

if(($urlFromMD = checkMetaDataForURL()) !== false){ //there is a URL
    if(($urlFull = resolveURL($urlFromMD)) !== false){ //it can be resolved to something
        $link = $urlFull;
    }
}else{ //else, google search
    $link = 'https://www.google.com/search?q=' . getTrack();
}

if(!empty(getArtist())) {
    echo '<a href="'.$link.'" target="_blank">Song: '.getName().' from ' .getArtist(). '</a>';
} else {
    echo '<a href="'.$link.'" target="_blank">Song: '.getName().'</a>';
}

?>