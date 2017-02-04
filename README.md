# SinusBot-Stream
Sinusbot-Stream, a web-based player to stream audio from SinusBot bot instances.

## Features
- Stream music from your [SinusBot](https://www.sinusbot.com) bots in your browser
- Webpage using [Bootstrap](https://getbootstrap.com/) and [VideoJS](http://videojs.com/)
- Displays album art from cached file or from youtube based on metadata or a custom default image
- Displays song name with link to video (if found in metadata) or link to google search
- Button to reload player and menu to change instance without reloading page
- Player automatically reloads when source fails or player throws an error
- Support to switch between multiple bot instances via a dropdown or URL
- Last used bot instance and volume stored in cookies
- Links to join Teamspeak server and login to SinusBot's webpanel on the navigation bar

## Screenshot
![Screenshot](https://www.zahzi.us/screenshots/1486175139.png)


## Demo
- Live demo found [here](https://sinusbot.zahzi.us/SinusBot-Stream/)


## Known Issues
- Some browsers do not support the livestream provided by the SinusBot API. 
    - The following browsers *should* work:
        - Chrome
        - Firefox
        - Opera
    - The following browsers have been confirmed as being incompatible:
        - Edge and IE on Windows
        - Safari on OSX
        - Safari/Chrome on iOS

## TODO
- Logging
- Caching of API data to reduce logins
- Support for more browsers

## Dependencies
- apache2 with libapache2-mod-php
- php, php-curl
- Sinusbot

####The following are used, but aren't required locally
- Video.js
- Bootstrap


## Install
- Install all dependencies
- Go to the directory where you wish to install (typically your web directory) and run the command ```git clone https://github.com/Zahzi/SinusBot-Stream.git``` (alternatively you can upload the files manually)
- Edit config.php with your server information and preferences
- Edit sinusbot's config.ini 
    - ```EnableWebStream = true```
    - ```SampleInterval = 60```


## Attributions
- Uses the SinusBot PHP API Class from [marburger93](https://github.com/marburger93/SinusBot-API-PHP-Class)
- Navigation bar icons from [icomoon.io](https://icomoon.io/)
- Originally based on [crank015's SinusBot-Stream](https://github.com/crank015/SinusBot-Stream/)
