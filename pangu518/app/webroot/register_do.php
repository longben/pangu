<?php
	require_once("db-settings.php");

	echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
	echo "<script type='text/javascript' src='/js/prototype.js'></script>";

	$login_name = trim($_POST["login_name"]);
	$password = md5($_POST["password"]);
	$user_name = trim($_POST["user_name"]);
	$cert_number = trim($_POST["cert_number"]);
	$member_no = $_POST["coupon"].$cert_number;
	$referees = trim($_POST["referees"]);
	$region_id = $_POST["coupon"];
	$mobile = trim($_POST["mobile"]);
	$office_phone = trim($_POST["office_phone"]);
	$home_phone = trim($_POST["home_phone"]);
	$accounts = trim($_POST["accounts"]);

	if(empty($referees)){
		$referees = "www7777";		//默认推荐人
	}


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
		$referees = 'www7777';
	}


	//总数
	$sql_ck = "select count(*) from users where cert_number = '".$cert_number."'";
	$stmt_ck = mysql_query($sql_ck);
	while($arr_ck = mysql_fetch_array($stmt_ck)){
		$user_count = $arr_ck[0];
	}

	//单个
	$sql_su = "select count(*) from users where cert_number = '".$cert_number."' and role_id = 1";
	$stmt_su = mysql_query($sql_su);
	while($arr_su = mysql_fetch_array($stmt_su)){
		$single_user_count = $arr_su[0];
	}

	if( ($user_count > 2) || ($single_user_count>0) ){
			echo("<script language='JavaScript'>alert('抱歉，该身份证已被限制注册，请用其他身份证进行注册！');history.go(-1);</script>");
	}else{

		$sql = "INSERT INTO members(username,password) VALUES ('".$login_name."', '".$password."')";
		mysql_query($sql);

		$sql = "select uid from members where username='".$login_name."'";
		$stmt = mysql_query($sql);
		$arr = mysql_fetch_array($stmt);
		$id = $arr[0];

		$sql_re = "select uid from members where username='".$referees."'";
		$stmt_re = mysql_query($sql_re);
		$arr_re = mysql_fetch_array($stmt_re);
		$refer_id = $arr_re[0];

		$sql = "insert into users(id,login_name,password,user_name,sex,member_no,cert_number,referees,region_id,office_phone,home_phone,mobile,bank_accounts,accounts) values(".$id.",'".$login_name."','".$password."','".$user_name."',".$_POST["sex"].",'".$member_no."','".$cert_number."','".$refer_id."','".$region_id."','".$office_phone."','".$home_phone."','".$mobile."','邮政储蓄','".$accounts."')";
		mysql_query($sql);

		echo("<script language='JavaScript'>");
		echo("var url = '/users/upgrade/$refer_id';");
		echo("var myAjax = new Ajax.Request(url,{method: 'get',onComplete: null,asynchronous:false});");
		echo("alert('恭喜您，注册成功，您可以登录进入盘古运营系统！');");
		echo("location.replace('/');");
		echo("</script>");
	}
?>