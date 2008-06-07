<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
 require_once('db-settings.php');
 $username=trim($_POST["username"]);
 $password1=trim($_POST["password1"]);
 $password1=md5($password1);
 $timoney=trim($_POST["timoney"]);
 $timoney=(int)$timoney;

	//公司收取20%提现手续费
	$person_timoney = (int)($timoney*0.8);

 if(!empty($username) || !empty($password1) || !empty($timoney)){
   $sql = "select id from users where login_name ='".$username."'";
   $stmt = mysql_query($sql);
   $arr = mysql_fetch_array($stmt);
   $idcode = $arr[0];
   
   $sql1 = "select id from merchants where user_id='".$idcode."'";
	$stmt1 = mysql_query($sql1);
	$arr1 = mysql_fetch_array($stmt1);
		
		$sql2 = "select id from workstations where user_id='".$idcode."'";
		$stmt2 = mysql_query($sql2);
		$arr2 = mysql_fetch_array($stmt2);
	
  $sql3="select count(*) from user_coupons where user_id='".$idcode."' and status='421'";
   $stmt3=mysql_query($sql3);
   $arr3=mysql_fetch_array($stmt3);
 
 $sql4 = "select uid from members where username='".$username."' and password='".$password1."'";
		$stmt4 = mysql_query($sql4);
		$arr4 = mysql_fetch_array($stmt4);
 
   
   if(empty($idcode) or !empty($arr1[0]) or !empty($arr2[0])){
   echo("<script language='JavaScript'>alert('抱歉，您输入的会员登录名不存在或者已经是消费单位或式工作站，请重新输入！');location.replace('../test.php');</script>");
	exit();
   }elseif(empty($arr4)){
   echo("<script language='JavaScript'>alert('抱歉，密码或登陆名不正确！');location.replace('../test.php');</script>");
		exit();
   }elseif($timoney>$arr3[0]){
   echo("<script language='JavaScript'>alert('抱歉，您的库存不足！');location.replace('../test.php');</script>");
	exit();
   }else{
	   $sql5="insert into cotmoney(ctname,ctnid,count1,timo) values('".$username."','".$idcode."','".$arr3[0]."','".$person_timoney."')";
	   mysql_query($sql5);
	   $sql6="update user_coupons set status='212' where user_id='".$idcode."' and status='421' limit $timoney";
	   mysql_query($sql6);
	   echo("<script language='JavaScript'>alert('恭喜你，已成功提交！');location.replace('../test.php');</script>");
   }		

   
 }else{
  echo("<script language='JavaScript'>alert('信息不完整！');location.replace('../test.php');</script>");
 }
?>
