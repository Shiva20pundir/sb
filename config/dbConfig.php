<?php
$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$databaseName = "db_cinema";

$dbConn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $databaseName);

if (!$dbConn) {
	die('Database connection failed.'.mysqli_connect_error());
}