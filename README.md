# SinusBot-Stream
Sinusbot Webstream, a web-based player to stream audio from SinusBot music bots.

## Features
- Stream music from your [SinusBot](https://www.sinusbot.com) bots in your browser
- Webpage using [Bootstrap](http://getbootstrap.com/) and [VideoJS](http://videojs.com/)
- Displays album art from either cached file or searches youtube based on metadata
- Displays song name with link to video (if found in meta data) or link to google search
- Support to swtich between multiple bot instances via a dropdown or URL
- Last used bot instance and volume stored in cookies
- Links to join Teamspeak server and login to SinusBot's webpanel on the navigation bar

## Demo
- Live demo found [here](http://sinusbot.zahzi.us/SinusBot-Stream/)

## Dependencies
- Apache 2 Webserver
- PHP 5
- Php5-Curl
- Sinusbot
- Video.js
- Bootstrap


## Install
- Go to the directory where you wish to install (typically your web directory)
- Run the command "git clone https://github.com/Zahzi/SinusBot-Stream.git" 
- Edit config.php with your server information and preferences
- Edit sinusbot's config.ini 
    - EnableWebStream = true
    - SampleInterval = 60


## Attributions
- Uses the SinusBot PHP API Class from [marburger93](https://github.com/marburger93/SinusBot-API-PHP-Class)
- Navigation bar icons from [icomoon.io](https://icomoon.io/)
- Originally based on [crank015's SinusBot-Stream](https://github.com/crank015/SinusBot-Stream/)
