<?php
require_once('db-settings.php');
$mobile=trim($_POST["mobile"]);
$member_no = $_POST["coupon"].$cert_number;
$member_no1 = $_POST["coupon1"].$cert_number;
$loginname = trim($_POST["loginname"]);
$loginname1 = "pangu000";
$password1 = md5(trim($_POST["password1"]));
if(!empty($mobile) and !empty($member_no) and !empty($loginname) and !empty($password1)){
	//取得会员ID	
		$sql = "select uid from members where username ='".$mobile."'";
		$stmt = mysql_query($sql);
		$arr = mysql_fetch_array($stmt);
		$idcode = $arr[0];
	//判断用户名密码
	    $sql7 = "select uid from members where username='".$loginname1."' and password='".$password1."'";
		$stmt7 = mysql_query($sql7);
		$arr7 = mysql_fetch_array($stmt7);
	//判断期数是否正确
		$sql8 = "select * from lottery_bettings where lottery_id='".$member_no."' and user_id='".$idcode."'";
		$stmt8 = mysql_query($sql8);
		$arr8 = mysql_fetch_array($stmt8);	
	
	if(empty($idcode)){
	    echo("<script language='JavaScript'>alert('抱歉，您输入的会员登陆名不存在，请重新输入！');location.replace('../delbetting.php');</script>");
			exit();
	}elseif($loginname != $loginname1){
	echo("<script language='JavaScript'>alert('抱歉，您输入的管理员编号不正确，请重新输入！');location.replace('../delbetting.php');</script>");
			exit();
	}elseif(empty($arr7[0])){
	echo("<script language='JavaScript'>alert('抱歉，您输入的管理员编号口令不正确，请重新输入！');location.replace('../delbetting.php');</script>");
			exit();
	}elseif(empty($arr8[0])){
	echo("<script language='JavaScript'>alert('该会员在该期并未参与分红，删除未成功，请注意！');location.replace('../delbetting.php');</script>");
			exit();
	}else{
	$arr9[0]=0;
	   if($member_no1="全部"){
	  
	  	//计算出删除的总数
		$sql9 = "select count(*) from lottery_bettings where lottery_id='".$member_no."' and user_id='".$idcode."'";
		$stmt9 = mysql_query($sql9);
		$arr9 = mysql_fetch_array($stmt9);	
		//删除会员代金卷表
		$sql10 = "delete from user_coupons where user_id='".$idcode."' and status=212 order by coupon_id limit ".$arr9[0]."";
		mysql_query($sql10);
		//删除投注信息
		$sql1 = "delete from lottery_bettings where lottery_id='".$member_no."' and user_id='".$idcode."'";
	  mysql_query($sql1);
		
	  }elseif($member_no1="商家"){
	 
	  //计算出删除的总数
		$sql11 = "select count(*) from lottery_bettings where lottery_id='".$member_no."' and user_id='".$idcode."' and betting_type=2";
		$stmt11 = mysql_query($sql11);
		$arr11 = mysql_fetch_array($stmt11);	
		//删除会员代金卷表
		$sql12 = "delete from user_coupons where user_id='".$idcode."' and status=212 order by coupon_id limit ".$arr11[0]."";
		mysql_query($sql12);
		//删除投注信息
		 $sql2 = "delete from lottery_bettings where lottery_id='".$member_no."' and user_id='".$idcode."' and betting_type=2";
	  mysql_query($sql2);
		
	  }else{
	  
	   //计算出删除的总数
		$sql13 = "select count(*) from lottery_bettings where lottery_id='".$member_no."' and user_id='".$idcode."' and betting_type=1";
		$stmt13 = mysql_query($sql13);
		$arr13 = mysql_fetch_array($stmt13);	
		//删除会员代金卷表
		$sql14 = "delete from user_coupons where user_id='".$idcode."' and status=212 order by coupon_id limit ".$arr13[0]."";
		mysql_query($sql14);
		//删除投注表
		$sql3 = "delete from lottery_bettings where lottery_id='".$member_no."' and user_id='".$idcode."' and betting_type=1";
	  mysql_query($sql3);
	  }
	  echo("<script language='JavaScript'>alert('恭喜！已成功删除了投注信息');location.replace('../delbetting.php');</script>");
	}	
}else{
echo("<script language='JavaScript'>alert('信息不完整！');location.replace('../delbetting.php');</script>");
}
?>