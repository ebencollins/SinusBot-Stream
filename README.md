# SinusBot-Stream
Sinusbot-Stream, a web-based player to stream audio from SinusBot bot instances.

## Features
- Stream music from your [SinusBot](https://www.sinusbot.com) bots in your browser
- Webpage using [Bootstrap](http://getbootstrap.com/) and [VideoJS](http://videojs.com/)
- Displays album art from cached file or from youtube based on metadata
- Displays song name with link to video (if found in metadata) or link to google search
- Support to switch between multiple bot instances via a dropdown or URL
- Last used bot instance and volume stored in cookies
- Links to join Teamspeak server and login to SinusBot's webpanel on the navigation bar

## Screenshot
![Screenshot](http://zahzi.us/screenshots/1478119632.png)


## Demo
- Live demo found [here](http://sinusbot.zahzi.us/SinusBot-Stream/)


## Known Issues
- Some browsers do not support the livestream provided by the SinusBot API. It is recomended that you use Chrome/Firefox for full functionality.
    - The following browsers have been confirmed as being incompatible: Edge and IE on Windows, Safari/Chrome on iOS


## Dependencies
- Apache 2 Webserver
- php, php-dev, php-curl, libapache2-mod-php
- Sinusbot

####The following are used, but aren't required locally
- Video.js
- Bootstrap


## Install
- Install all dependencies
- Go to the directory where you wish to install (typically your web directory)
- Run the command ```git clone https://github.com/Zahzi/SinusBot-Stream.git```
- Edit config.php with your server information and preferences
- Edit sinusbot's config.ini 
    - ```EnableWebStream = true```
    - ```SampleInterval = 60```


## Attributions
- Uses the SinusBot PHP API Class from [marburger93](https://github.com/marburger93/SinusBot-API-PHP-Class)
- Navigation bar icons from [icomoon.io](https://icomoon.io/)
- Originally based on [crank015's SinusBot-Stream](https://github.com/crank015/SinusBot-Stream/)
