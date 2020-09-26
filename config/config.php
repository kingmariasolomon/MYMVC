<?php

define('DEBUG', true); //turning error reporting on or off

define('DB_NAME', 'elitemvc'); //database name
define('DB_USER', 'root'); //database user
define('DB_PASSWORD', ''); //database password
define('DB_HOST', '127.0.0.1'); //database host *** use IP adrress to avoid DNS lookup

define('DEFAULT_CONTROLLER', 'Home'); // default controller if ther isn't one defined in the url
define('DEFAULT_LAYOUT', 'default'); //if no layout is set in the controller use this default layout

define('PROOT', '/elitemvc/'); //set this ti '/' for a live server

define('SITE_TITLE', 'Elite MVC Framework'); //this will be used if no site title is set
define('MENU_BRAND', 'ELITEMVC'); //  This is the brand text in the menu

define('CURRENT_USER_SESSION_NAME', 'SESSMVCqwertyuiop'); // session name for logged in user
define('REMEMBER_ME_COOKIE_NAME', 'COOKMVCasdfghjkl');// cookie name for logged in user
define('REMEMBER_ME_COOKIE_EXPIRY', '2592000'); // time in seconds for remeber me cookie to live for (30 days)

define('ACCESS_RESTRICTED', 'Restricted'); //controller name for the restricted redirect