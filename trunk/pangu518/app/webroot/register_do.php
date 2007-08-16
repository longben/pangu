<?php
	require_once("db-settings.php");

	echo("<script language=JavaScript>history.go(-1);</script>");
	exit();

	$username = trim($_POST["login_name"]);

	$sql = "select uid from members where username='".$username."'";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);

	if($arr[0]){
		echo("<script language='JavaScript'>alert('±§Ç¸£¬ÄúÊäÈëµÄ');</script>");
	}

	$sql = "INSERT INTO members(username,password) VALUES ('".$username."', '".md5($_POST["password"])."')";
	mysql_query($sql);

	$sql = "select uid from members where username='".$username."'";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);
	$id = $arr[0];



?>
