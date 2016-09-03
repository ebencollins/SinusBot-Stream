<?php

error_reporting('E_ERROR');

include("sinusbot.class.php");
include("config.php");
session_start();

$inst = $instanceIDS[$defaultInstance];
if(isset($_GET['id'])){
	$id = $_GET['id'];
	if(!is_numeric((int)$id)){
		echo "Error: Invalid value for \"id\".";
		return;
	}
	if($id > count($instanceIDS) - 1){
		echo "Error: There are only " . count($instanceIDS) . " instances. Chose a number between 0 and " . (count($instanceIDS) -1) . ".";
		return;
	}
	$inst = $instanceIDS[$id];
	$_SESSION['inst'] = $id;
	setcookie("inst", $id, time() + (86400*30), "/");
}else if(isset($_SESSION['inst'])){
	$inst = $instanceIDS[$_SESSION['inst']];
	setcookie("inst", $id, time() + (86400*30), "/");
}else{
	if(isset($_COOKIE['inst'])){
		$_SESSION['inst'] = $id;
		$inst = $instanceIDS[$_COOKIE['inst']];
	}
}


$sinusbot = new SinusBot($ipport);
$sinusbot->login($user, $passwd);
$sinusbot->selectInstance($inst);
$token = $sinusbot->getWebStreamToken($inst);

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/design.css">
<title>SinusBot-Radio@<?php echo $title; ?></title>

<script src="//vjs.zencdn.net/ie8/1.1.1/videojs-ie8.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript">
function loadSong() {
		var xhttp = new XMLHttpRequest();
		xhttp.open("GET", "getSong.php", true);
		xhttp.send();
	}	

 function loadImg() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("getImg").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET", "getImg.php", true);
		xhttp.send();
	}
	
 function loadSearch() {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("search").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("GET", "search.php", true);
		xhttp.send();
	}
	
setInterval(function() {
	loadImg();
	loadSong();
	loadSearch();
}, 3500); 
</script>
</head>
<?php

?>


<div id = "main">
  <video id="player" class="video-js vjs-default-skin" controls autoplay preload="auto" poster="resources/unknownimg.png">
  	<source src="http://<?php echo $ipport; ?>/api/v1/bot/i/<?php echo $inst; ?>/stream/<?php echo $sinusbot->getWebStreamToken($inst); ?>" type='audio/mp3'>
  </video>
<div id="search">Loading song name.... </div>
</div>

<script>
  'use strict';
  var player = videojs('player');
  player.AudioTracks({
  default: 0,
  descriptive: 1
  });
</script>


</body>
</html>
