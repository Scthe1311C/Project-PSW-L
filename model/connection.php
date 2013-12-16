<?php
//database settings
$db_host = "localhost:3306";
$db_user = "app_user";
$db_pass = "pswl";
$db_name = "dropbox_app";

$sql_conn = @mysql_connect($db_host,$db_user,$db_pass) 
			or die("Error: Cannot connect to MySQL Serwer");

$db_select = @mysql_select_db($db_name)
			or die('Error: Cannot connect to MySQL Database'); 
?>
