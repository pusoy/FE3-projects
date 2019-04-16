<?php 
define('DBHost', '127.0.0.1');
define('DBPort', 3306);
define('DBName', 'test');
define('DBUser', 'root');
define('DBPassword', '');
require( __DIR__ . "/../src/PDO.class.php");
$DB = new Db(DBHost, DBPort, DBName, DBUser, DBPassword);
?>