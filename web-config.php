<?php

## constants
define("DEFAULT_DATE_FORMAT", "m/d/Y");
define("SECURITY_LEVEL_OPERATOR", 1);

## database connection - core
$server = 'mysqldev.poligresa.com';
$user = 'polidb_dev';
$pass = 'rBmpUuqs';
$db = 'poligresa_dev';

// Check Connections
$con=mysql_connect($server,$user,$pass) or die('Could not connect to server');
mysql_select_db($db,$con) or die('Could not connect to database');
ini_set('display_errors', 'Off');

## Initialize database lib class usage 
include_once "./lib/db.class.php";
$objDb = new database();

?>