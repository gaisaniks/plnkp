<?php
session_start();

include_once 'koneksi.php';
if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
else if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_GET['logout']))
{

	$sql = mysqli_query($koneksi, "UPDATE users SET status='0'  WHERE user_id=".$_SESSION['user']);
	
	session_destroy();
	unset($_SESSION['user']);
	header("Location: index.php");
}
?>
