<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>盘古财富网</title>
<?php
	require_once('db-settings.php');
	$loginname = trim($_POST["loginname"]);
	$password = trim($_POST["password"]);
	$start_betting = trim($_POST["start_betting"]);
	$end_betting = trim($_POST["end_betting"]);
	$betting =  trim($_POST["betting"]);
	$member_no = $_POST["coupon"].$cert_number;
	$password1= md5($password);
	if(!empty($loginname) and !empty($password) and !empty($start_betting) and !empty($end_betting) and !empty($betting)) {
	//取得会员ID号
		$sql = "select uid from members where username ='".$loginname."'";
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
	//取得会员分红凭证总数	
		$sql3 = "select count(id) from user_coupons where user_id='".$idcode."' and status='421'";
		$stmt3 = mysql_query($sql3);
		$arr3 = mysql_fetch_array($stmt3);
	
	//判断用户名密码
	    $sql10 = "select uid from members where username='".$loginname."' and password='".$password1."'";
		$stmt10 = mysql_query($sql10);
		$arr10 = mysql_fetch_array($stmt10);
	    
	//产生随机函数
	   for($i=$start_betting;$i<=$end_betting;$i++){
	      $number[]= $i;
	   }   
	   $betting1 = $betting * sizeof($number);

	//判断会员是否在用户表，会员是否是消费单位或工作站
if(empty($idcode) or !empty($arr1[0]) or !empty($arr2[0])){
			echo("<script language='JavaScript'>alert('抱歉，您输入的会员登陆名不存在或者已经是消费单位或式工作站，请重新输入！');location.replace('../addusermorelistbeting.php');</script>");
			exit();
}elseif(empty($arr10[0])){
		     echo("<script language='JavaScript'>alert('抱歉，您输入的会员登陆名或密码不正确，请仔细检查！');location.replace('../addusermorelistbeting.php');</script>");
			exit();
}elseif($arr3[0]<$betting1){
		echo("<script language='JavaScript'>alert('抱歉，您拥有的分红凭证张数不够，请仔细检查！');location.replace('../user_coupons/input');</script>");
			exit();
}else{
//批量插入
if($start_betting > 0){
$start_betting=ltrim($start_betting,"0");
}else{
$start_betting="000";
}
for($i=$start_betting;$i<=$end_betting;$i++){
       
		if($i<10 and $i!=0){
           $i="00$i";
	       $sql4 = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('".$member_no."','$i','".$betting."','1','".$idcode."','1')"; 
            mysql_query($sql4);
        }elseif($i<100 and $i>=10){
  		     $i="0$i";
			 $sql4 = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('".$member_no."','$i','".$betting."','1','".$idcode."','1')";
            mysql_query($sql4);
  }else{
            $sql4 = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('".$member_no."','$i','".$betting."','1','".$idcode."','1')";
       mysql_query($sql4);
  }
}
//批量更新
$j = 0;
$sql7 = "select * from user_coupons where user_id='".$idcode."' and status='421' order by id";
$stmt7 = mysql_query($sql7);

while($arr7 = mysql_fetch_array($stmt7)){
		             $arr8[$j]=$arr7[coupon_id];
					 $j++;
		};
for($i=0;$i<$betting1;$i++){
		    $sql8="update user_coupons set status='212' where coupon_id='".$arr8[$i]."' and user_id='".$idcode."'";
			mysql_query($sql8);
		}
		for($i=0;$i<$betting1;$i++){
		    $sql11="update coupons set status='212' where id='".$arr8[$i]."'";
			mysql_query($sql11);
		}		
echo("<script language='JavaScript'>alert('恭喜你，已成功批量生成组团分红号段！');location.replace('../lottery_bettings/user');</script>");
  
  }
}else{
		 echo("<script language='JavaScript'>alert('信息不完整！');location.replace('../addusermorelistbeting.php');</script>");
	}
?>
</head>
</html>