<?php
error_reporting('E_ERROR');
require("getSong.php");
$link = 'https://www.google.com/search?q=' . getTrack();
if(($urlFromMD = checkMetaDataForURL()) !== false){ //there is a URL
    if(($urlFull = resolveURL($urlFromMD)) !== false){ //it can be resolved to something
        $link = $urlFull;
    }
}

if(!empty(getArtist())) {
    echo '<a class="songlink" href="'.$link.'" target="_blank">Song: '.getName().' from ' .getArtist(). '</a>';
} else {
    echo '<a class="songlink" href="'.$link.'" target="_blank">Song: '.getName().'</a>';
}

?>