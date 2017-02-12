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
- Sinusbot
- apache2, libapache2-mod-php, php, php-curl

#### The following are used, but aren't required locally
- Video.js
- Bootstrap


## Install
- Install all dependencies. 
- Restart apache2
- Edit sinusbot's config.ini 
    - ```EnableWebStream = true```
    - ```SampleInterval = 60```
- Clone this repository ```git clone https://github.com/Zahzi/SinusBot-Stream.git``` and move the stream files into your web directory. You can also upload the files manually)
- Edit config.php with your server information and preferences


## Install (detailed)
### Linux
**Note that this was written for Ubuntu 16.04, however, you should be able to adapt it without too much difficulty.**

1. Install dependencies: ```apt-get update -y && apt-get install apache2 php php-curl libapache2-mod-php git -y```

2. Restart apache2: ```service apache2 restart```

3. 
	A) Method a: Clone this repository to your home directory and move the necesary files
    
	1. ```cd ~ && git clone https://github.com/Zahzi/SinusBot-Stream.git```
Move the SinusBot-Stream files to your webdirectory (default for apache2 is usually ```/var/www/html```)

	2. ```mv ~/SinusBot-Stream/SinusBot-Stream/ /var/www/html```

	B) Method b: Clone this repository to a direcotry and create a symlink. This will make it easier to pull updates. (Note that [FollowSymLinks](http://superuser.com/questions/244245/how-do-i-get-apache-to-follow-symlinks) must be set in your apache site settings).
    
	1. ```cd /var/www/ && git clone https://github.com/Zahzi/SinusBot-Stream.git```

	2. ```cd /var/www/html && ln -s /var/www/SinusBot-Stream/SinusBot-Stream/```

4. Edit the SinusBot config. Default path is ```/opt/sinusbot/config.ini```
    
   1.  ```nano /opt/sinusbot/config.ini```
   
   2. Set ```EnableWebStream = true``` and ```SampleInterval = 60```
    
    3. Save the file.

5. Edit SinusBot-Stream's config.php:
	1. ```nano /var/www/html/SinusBot-Stream/config.php```
     
    2. Make sure the follow settings are set:
		* Set ```$ip``` to the ip of the server that SinusBot is running on. This is the same ip you use to access the admin panel. (can be a DNS name).

		* Set ```$port``` to be the port the SinusBot is set to run on.

		* Set ```$enableSSL = true``` if SinusBot is set to run on https

		* Set ```$user``` to be the username for the stream to login to in
SinusBot. This user needs login permission. It's recommended not to give it anything else.

		* Set ```$password``` to be the corresponding password to the user.

		* Set ```$instanceIDS``` to be an array containing all instances that you wish to use in quotes separated by commas. Eg: ```$instanceIDS = array("10d82776-f87c-41ee-be62-bb17738538c3", "09a54439-g77a-41dd-fd25-bc14422548d3");``` Get the instance IDs from "Instance Settings": !["Where to get instance ID"](https://www.zahzi.us/screenshots/1486179273.png)
	
		* Set ```$instanceNames``` to be an array of names you wish to display corresponding to the instances. You must have the same number of names as instances in quotes separated by commas. Example: ```$instanceNames = array("MusicBot #1", "MusicBot #2");```

	3. Save the file.

6. Access the stream at http(s)://yourip/SinusBot-Stream/. If you wish to configure the stream to run on a different port, update the apache settings.


## Attributions
- Uses the SinusBot PHP API Class from [marburger93](https://github.com/marburger93/SinusBot-API-PHP-Class)
- Navigation bar icons from [icomoon.io](https://icomoon.io/)
- Originally based on [crank015's SinusBot-Stream](https://github.com/crank015/SinusBot-Stream/)
