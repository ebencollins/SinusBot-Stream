<!DOCTYPE html>
<?php
error_reporting('E_ERROR');
require_once("config.php");
require_once("sinusbot.class.php");

if(count($instanceIDS) !== count($instanceNames)){
	echo "Error: Length of instanceIDS is ".count($instanceIDS).", but length of instanceNames is ".count($instanceNames).".";
	return;
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
	if(is_numeric($id) == false){
		echo "Error: Invalid value for \"id\".";
		return;
	}
	if($id > count($instanceIDS) - 1){
		echo "Error: There are only " . count($instanceIDS) . " instances. Chose a number between 0 and " . (count($instanceIDS) -1) . ".";
		return;
	}
	$inst = $instanceIDS[$id];
	setcookie("inst", $id, time() + (86400*30), "/");
}else if(isset($_COOKIE['inst'])){
	$inst = $instanceIDS[$_COOKIE['inst']];
    $id = $_COOKIE['inst'];
}else{
	$inst = $instanceIDS[$defaultInstance];
    $id = $defaultInstance;
	setcookie("inst", $defaultInstance, time() + (86400*30), "/");
}

$sinusbot = new SinusBot($sinusbotURL);
$sinusbot->login($user, $passwd);
$sinusbot->selectInstance($inst);
$token = $sinusbot->getWebStreamToken($inst);

?>

<html>
<head>
	<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="faviconfavicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://bootswatch.com/darkly/bootstrap.min.css">
	<link href="https://vjs.zencdn.net/5.16.0/video-js.css" rel="stylesheet">
	<link href="css/videojs-custom.css" rel="stylesheet">
	<link rel="stylesheet" href="css/icon-font.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://vjs.zencdn.net/5.16.0/video.js"></script>

	<style type="text/css">
		.songlink{
			color: rgb(255, 255, 255);
		}
		.center{
			text-align: center;
		}
	</style>

	<script type="text/javascript">
        var enableRefreshData = true;
		var currentInst = "<?php echo $inst; ?>";
		var currentInstName = "<?php echo isset($id)? " - " . $instanceNames[$id] : ""; ?>";
        currentInstID = 0; //
		var siteTitle = "<?php echo $title; ?>";
		var errorCount = 0;

		function getData(inst){
			$.ajax({
				url: 'util.php',
				type: 'POST',
				data: {getData: inst},
				beforeSend: function() {},
				success: function(data) {
					parsed = JSON.parse(data);
        			$('.vjs-poster').css({
	    				'background-image': 'url('+parsed['img']+')',
	    				'display': 'block',
	    				'background-size': 'cover'

	    			});
	    			$("#player .vjs-poster").css('background-image', 'url('+parsed['img']+')').show();
					$("#songname").html(parsed['songname']);
           		}
        	});
		}
		function updateWebStream(){
            changeWebStream(currentInst);
		}

		function changeWebStream(inst){
			enableRefreshData = false;
			getData(inst);
			$.ajax({
				url: 'util.php',
				type: 'POST',
				data: {getWebStream: inst},
				beforeSend: function() {},
				success: function(data) {
					parsed = JSON.parse(data);
					player = videojs("player");
					playerSource = $("#playersource");
					player.pause();
					playerSource.attr("src", parsed['webstream']);
					player.load();
					player.play();
					currentInst = parsed['instance'];
					currentInstName = parsed['instanceName'];
                    currentInstID = parsed['instanceID'];
					$(".navbar-brand").html(siteTitle + " - " + currentInstName);
                    $('#instance-dropdown').children().removeClass("active");
                    $('#instance-dropdown').children().eq(currentInstID).addClass("active");
                    enableRefreshData = true;
                    date = new Date();
                    date.setTime(date.getTime()+(30*24*60*60*1000));
                    expires = "expires="+date.toUTCString();
					document.cookie = "inst="+currentInstID+"; expires="+expires+"; path=/;";
           		}
        	});
		}

		$(document).ready(function(){
		    $(".botlink").click(function(event){
		        event.preventDefault();
		    });
		});

		window.addEventListener('error', function(e) {
			if(errorCount < 5){
				errorCount++;
				console.log("there was a fucking error m8 (reloading player with new source):");
			    console.log(e);
			    updateWebStream();
			}
		}, true);

		setInterval(function() {
            if(errorCount > 0){
			    errorCount-=1;
            }
		}, 30000); 
		
		setInterval(function() {
            if(enableRefreshData){
			    getData(currentInst);
            }
		}, 4500); 

	</script>
	<title><?php echo $title; ?></title>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="."><?php echo $title; echo isset($id)? " - " . $instanceNames[$id] : ""; ?></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="https://github.com/Zahzi/SinusBot-Stream" target="_blank"><!-- <img src="resources/github.png" class="img-responsive" height="25px" width="22px" alt="Open source on GitHub!"></img> --><span class="icon-github"></span></a></li>
						<?php
						if($teamspeakJoinLink != ""){
							echo '<li><a href="'.$teamspeakJoinLink.'"><span class="icon-open"></span></a></li>';
						}
						echo '<li><a href="'.$sinusbotURL.'" target="_blank"><span class="icon-login"></span></a></li>';
						?>
					</ul>
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Select Bot <span class="caret"></span></a><ul id="instance-dropdown" class="dropdown-menu">
								<?php 
								for($i = 0; $i < count($instanceNames); $i++){
									if($i == array_search($inst, $instanceIDS)){
										echo '<li class="active"><a class="botlink" id="botlink'.$i.'" onclick="changeWebStream(\''.$instanceIDS[$i].'\');" href="#">'.$instanceNames[$i].'</a></li>';
									}else{
										echo '<li class=""><a class="botlink" id="botlink'.$i.'" onclick="changeWebStream(\''.$instanceIDS[$i].'\');" href="#">'.$instanceNames[$i].'</a></li>';
									}
								}
								?>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div class="embed-responsive embed-responsive-16by9">
			<video id="player" class="video-js vjs-poster vjs-default-skin vjs-big-play-centered embed-responsive-item"
				controls preload="none" autoplay 
				data-setup='{
				"height": "100%",
				"width": "100%",
				"loadingSpinner": true}'>
				<source id = "playersource" src="<?php echo $sinusbot->getWebStream(); ?>" type="audio/ogg">
			</video>
		</div> <!-- .embed-reponsive -->
		<div id="songnamediv" class="center"><h5 id="songname">Loading song name...</h5></div>
	</div> <!-- .container -->

<script type="text/javascript">

	var ButtonComponent = videojs.getComponent('Button');
	var ReloadButtonComponent = videojs.extend(ButtonComponent, {
	    constructor: function () {
	        ButtonComponent.call(this, player);
	    },
	    handleClick: function () {
	        updateWebStream();
	    },
	    buildCSSClass: function () {
	        return 'vjs-button vjs-control vjs-reload-button';
	    },
	    createControlTextEl: function (button) {
	        return $(button).html($('<span class="icon-spinner11"></span>').attr('title', 'Reload'));
	    }
	});


	
	var player = videojs('player');
	<?php if($enableReloadBtn){
		echo 'player.controlBar.addChild(new ReloadButtonComponent(), {}, 1);';
		}
	?>
	
	
	var volume = 0.5;
	if(getCookie("volume") != "" && getCookie("volume") != null){
		volume = getCookie("volume");
	}
	player.volume(volume);

	function getCookie(name) {
	    var value = "; " + document.cookie;
	    var parts = value.split("; " + name + "=");
	    if (parts.length == 2) return parts.pop().split(";").shift();
	}

	var video = document.getElementById('player');	
	video.addEventListener("volumechange", function() {
	 	var d = new Date();
	 	d.setTime(d.getTime() + (30*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		var volume = player.volume();
		if(player.muted()){
			volume = 0.0;
		}
	 	document.cookie = "volume=" + volume + "; " + expires + "; path=/";

	}, true);

	function stoppedEventListener(){
		updateWebStream();
		console.log("Stream stopped? Reloading.");
	}
	video.addEventListener("ended", stoppedEventListener);
	video.addEventListener("error", stoppedEventListener);
	video.addEventListener("suspend", stoppedEventListener);



</script>

</body>
</html>