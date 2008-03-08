<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>盘古财富网</title>
<?php
	require_once('db-settings.php');
	$mobile = trim($_POST["mobile"]);
	$strart_coupon = trim($_POST["office_phone"]);
	$end_coupon = trim($_POST["home_phone"]);
	$loginname = trim($_POST["loginname"]);
	$password =  trim($_POST["password"]);
	$password1= md5($password);
	if(!empty($mobile) and !empty($strart_coupon) and !empty($end_coupon) and !empty($loginname) and !empty($password)) {
	//取得会员消费单位的ID号
		$sql10 = "select id from users where login_name ='".$loginname."'";
		$stmt10 = mysql_query($sql10);
		$arr10 = mysql_fetch_array($stmt10);
		$idcode1 = $arr10[0];
	//取得消费单位ID号
		$sql11 = "select id from merchants where user_id ='".$idcode1."'";
		$stmt11 = mysql_query($sql11);
		$arr11 = mysql_fetch_array($stmt11);
		$idcode2 = $arr11[0];	
	
	//取得会员ID号
		$sql = "select id from users where login_name ='".$mobile."'";
		$stmt = mysql_query($sql);
		$arr = mysql_fetch_array($stmt);
		$idcode = $arr[0];
	//取得单位ID号	
		$sql1 = "select id from merchants where user_id='".$idcode."'";
		$stmt1 = mysql_query($sql1);
		$arr1 = mysql_fetch_array($stmt1);
	//取得工作站ID号	
		$sql2 = "select id from workstations where user_id='".$idcode."'";
		$stmt2 = mysql_query($sql2);
		$arr2 = mysql_fetch_array($stmt2);
	//取得分红凭证开始号段号码	
		$sql3 = "select id from coupons where coupon_no='".$strart_coupon."' and status='341'";
		$stmt3 = mysql_query($sql3);
		$arr3 = mysql_fetch_array($stmt3);
	
	//取得分红凭证结束号段号码
	    $sql4 = "select id from coupons where coupon_no='".$end_coupon."' and status='341'";
		$stmt4 = mysql_query($sql4);
		$arr4 = mysql_fetch_array($stmt4);
	
	//判断消费单位库存量
		$sql12 = "select count(*) from merchant_coupons where merchant_id ='".$idcode2."' and status='341' and coupon_id>='$arr3[0]' and coupon_id<='$arr4[0]'";
		$stmt12 = mysql_query($sql12);
		$arr12 = mysql_fetch_array($stmt12);
		
	//判断代金卷总数
		$sql13 = "select count(*) from coupons where status='341' and id>='$arr3[0]' and id<='$arr4[0]'";
		$stmt13 = mysql_query($sql13);
		$arr13 = mysql_fetch_array($stmt13);
	
	//判断用户名密码
	    $sql7 = "select uid from members where username='".$loginname."' and password='".$password1."'";
		$stmt7 = mysql_query($sql7);
		$arr7 = mysql_fetch_array($stmt7);
	
	    
	
	//判断会员是否在用户表，会员是否是消费单位或工作站
		if(empty($idcode) or !empty($arr1[0]) or !empty($arr2[0])){
			echo("<script language='JavaScript'>alert('抱歉，您输入的会员登录名不存在或者已经是消费单位或式工作站，请重新输入！');location.replace('../merchatsaddcoupons.php');</script>");
			exit();
		}elseif(empty($arr3[0]) or empty($arr4[0])){
		     echo("<script language='JavaScript'>alert('抱歉，您输入的分红凭证起始号码或者结束号码已经失效，不是有效凭证，请仔细检查！');location.replace('../merchatsaddcoupons.php');</script>");
			exit();
		}elseif($arr4[0]<=$arr3[0]){
		echo("<script language='JavaScript'>alert('抱歉，您输入的分红凭证起始号码大于结束号码，格式错误，请仔细检查！');location.replace('../merchatsaddcoupons.php');</script>");
			exit();
		}elseif(empty($idcode1)){
		echo("<script language='JavaScript'>alert('抱歉，消费单位帐号不存在！');location.replace('../merchatsaddcoupons.php');</script>");
			exit();
		}elseif(empty($idcode2)){
		echo("<script language='JavaScript'>alert('抱歉，消费单位帐号不正确或未申请成消费单位！');location.replace('../merchatsaddcoupons.php');</script>");
			exit();
		}elseif(empty($arr7[0])){
		echo("<script language='JavaScript'>alert('抱歉，口令不正确！');location.replace('../merchatsaddcoupons.php');</script>");
		exit();
		}elseif(empty($arr12[0])){
		echo("<script language='JavaScript'>alert('抱歉，你输入的分红凭证号段不在您的库存中！');location.replace('../merchatsaddcoupons.php');</script>");
		exit();
		}elseif($arr12[0] != $arr13[0]){
		echo("<script language='JavaScript'>alert('抱歉，你的分红凭证不足或状态不正常！');location.replace('../merchatsaddcoupons.php');</script>");
		exit();
		}else{
	//批量插入
	    for($i=$arr3[0];$i<=$arr4[0];$i++){
$sql5="insert into user_coupons(user_id,coupon_id,merchant_id,status) values('$idcode','$i','$idcode2','421')";
	mysql_query($sql5);
	      }
	//批量更新
	  $sql6="update coupons set status='421' where id>='$arr3[0]' and id<='$arr4[0]'";  
      mysql_query($sql6);
	//批量更新
	  $sql7 ="update merchant_coupons set status='421' where coupon_id>='$arr3[0]' and coupon_id<='$arr4[0]'";
	  mysql_query($sql7);
	  echo("<script language='JavaScript'>alert('恭喜你，已成功批量录入，并且此号段分红凭证已作废，请妥善保管！');location.replace('../addcoupons.php');</script>");
	}
	}else{
		 echo("<script language='JavaScript'>alert('信息不完整！');location.replace('../addcoupons.php');</script>");
	}
?>
</head>
</html>