<?php
	require_once("db-settings.php");

	$login_name = trim($_POST["login_name"]);
	$password = md5($_POST["password"]);
	$user_name = trim($_POST["user_name"]);
	$cert_number = trim($_POST["cert_number"]);
	$member_no = $_POST["coupon"].$cert_number;
	$referees = $_POST["referees"];
	$region_id = $_POST["coupon"];
	$telephone = trim($_POST["telephone"]);
	$mobile = trim($_POST["mobile"]);
	$accounts = trim($_POST["accounts"]);


	$sql = "select uid from members where username='".$login_name."'";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);

	if($arr[0]){
		echo("<script language='JavaScript'>alert('抱歉，您输入的登录名已存在，请重新输入！');history.go(-1);</script>");
		exit();
	}

	if(!empty($referees)) {
		$sql = "select uid from members where username='".$referees."'";
		$stmt = mysql_query($sql);
		$arr = mysql_fetch_array($stmt);

		if(empty($arr[0])){
			echo("<script language='JavaScript'>alert('抱歉，您输入的推荐人登录名不存在，请重新输入，或保留为空！');history.go(-1);</script>");
			exit();
		}
	}else{
		$referees = 1;
	}


	$sql = "INSERT INTO members(username,password) VALUES ('".$login_name."', '".$password."')";
	mysql_query($sql);

	$sql = "select uid from members where username='".$login_name."'";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);
	$id = $arr[0];

	$sql = "insert into users(id,login_name,password,user_name,sex,member_no,cert_number,referees,region_id,telephone,mobile,accounts) values(".$id.",'".$login_name."','".$password."','".$user_name."',".$_POST["sex"].",'".$member_no."','".$cert_number."','".$referees."','".$region_id."','".$telephone."','".$mobile."','".$accounts."')";
	mysql_query($sql);

	echo("<script language='JavaScript'>alert('恭喜您，注册成功，您可以登录进入盘古运营系统！');location.replace('main.php');</script>");
?>
