<?php
   	$conn = mysqli_connect("localhost", "root", "", "st_tu_system");
	$connMain = mysqli_connect("localhost", "root", "", "st_tu");
	$ssl_check = "";
	if (isset($_SERVER['HTTPS']))
	{
		$ssl_check = "https";
	}
	else
	{
		$ssl_check = "http";
	}
?>