<?php
	session_start();
	require_once("db-settings.php");

	$username = $_POST["data[Member][username]"];
	$password = md5($_POST["data[Member][password]"]);
	$SafeCode = $_POST["SafeCode"];

	if($SafeCode == $_SESSION['SafeCode']){
		echo "ok";
	}else{
		echo "no";
	}

	echo "<hr>SafeCode:".$SafeCode."----_SESSION:".$_SESSION['SafeCode'];


?>