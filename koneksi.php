<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "pln";

try {
	$koneksi = new mysqli($servername, $username, $password, $dbname);
} catch (\Throwable $th) {
	die("Connection failed: " . $con->connect_error);
}