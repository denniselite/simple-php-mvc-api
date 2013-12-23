<?php

//set_time_limit(10);

//SQL Connection Parameters
define('DBHOST', 'localhost');
define('DBNAME', 'apns');
define('DBUSERNAME', 'root');
define('DBPASSWORD', 'Rodster2013');

//Certificate folder
$certificateFolder = 'certificates';

//Date settings. Apple uses UTC dates for Feedback info
date_default_timezone_set('UTC');