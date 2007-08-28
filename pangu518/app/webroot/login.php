<?php
	session_start();
	require_once("db-settings.php");

	echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";

	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	$SafeCode = $_POST["SafeCode"];

	if(empty($username) || empty($password)){
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('用户名或密码为空！');location.replace('main.php');</SCRIPT>";
	}

	//if($SafeCode == $_SESSION['osSafeCode']){
		$sql = "select b.grade_name from users a,member_grades b where a.login_name='".$username."' and a.password='".$password."' and a.member_grades_id = b.id";
		$stmt = mysql_query($sql);
		$arr = mysql_fetch_array($stmt);

		if($arr[0]){
			session_register("osLGflag");
			session_register("osUsername");
			session_register("osLevel");
			$_SESSION["osLGflag"] = "bitbee";
			$_SESSION["osUsername"] = $username;
			$_SESSION["osLevel"] = $arr[0];
			echo "<SCRIPT LANGUAGE='JavaScript'>location.replace('main.php');</SCRIPT>";
			
		}else{
			echo "<SCRIPT LANGUAGE='JavaScript'>alert('用户名或密码错误！');location.replace('main.php');</SCRIPT>";
		}
	//}else{
	//		echo "<SCRIPT LANGUAGE='JavaScript'>alert('验证码错误！');location.replace('main.php');</SCRIPT>";
	//}

?>