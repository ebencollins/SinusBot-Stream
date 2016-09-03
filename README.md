# SinusBot-Stream
Sinusbot Webstream, forked from https://github.com/crank015/SinusBot-Stream/

## Changes
- Very different layout
- Uses video.js
- Support for multiple streams from multiple instances (example.com/SinusBot-Stream/?id=1)
- Tries to find thumbnail for youtube videos based on metadata
- Fixed url not including "http://"

## Dependencies
- Apache 2 Webserver
- PHP 5
- Php5-Curl
- Sinusbot
- Video.js


## Install
- Go to the directory where you wish to install (typically your web directory)
- Run the command "git clone https://github.com/Zahzi/SinusBot-Stream.git" 
- Edit config.php with your server information and preferences
- Edit sinusbot's config.ini 
    - EnableWebStream = true
    - SampleInterval = 60
