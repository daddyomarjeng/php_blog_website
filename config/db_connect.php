<?php
session_start();

$hostname = "localhost";
$username = "malleh";
$password = "Password@1";
$dbName = "my_blog";

$con = mysqli_connect($hostname, $username, $password, $dbName);

if (!$con) {
	header("Location: errors/errors.php");
	$_SESSION['error'] = "Database connection error";
	die();
}

// echo "Success, connected to database";