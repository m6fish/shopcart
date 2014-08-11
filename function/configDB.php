<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'test');
define('DB_DATABASE', 'shopcar');

$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die("Error " . mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
mysql_set_charset("utf8",$connection);

