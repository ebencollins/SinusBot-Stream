<?php
error_reporting('E_ERROR');
include("getSong.php");
if(!empty($artist)) {
echo "<font color='black' style='size: 16px !important;'>Song: <a href='https://www.google.com/search?client=opera&q=".getTrack()."+-+".getArtist()."&sourceid=opera&ie=UTF-8&oe=UTF-8' target='_new' style='text-decoration: none;''>".getName() . " from " . artist() . "</a> </font>";
} else {
echo "<font color='black' style='size: 16px !important;'>Song: <a href='https://www.google.com/search?client=opera&q=".getTrack()."&sourceid=opera&ie=UTF-8&oe=UTF-8' target='_new' style='text-decoration: none;''>".getName()."</a></font>";
}