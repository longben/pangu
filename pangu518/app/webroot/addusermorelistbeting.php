<?php 
  require_once('db-settings.php');

   
// for($i=$start_betting;$i<=$end_betting;$i++){
	 //     $number[]= $i;
	//  }   
  // $j=0;
 //for($i=0;$i<=999;$i++){
	//    $sql = "insert into lottery_bettingslottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('1','$i','1','1','447','1')"; 
	//	mysql_query($sql);
	//	}
//
		/*$j = 0;
		$sql7 = "select * from user_coupons where user_id='447' and status='421' order by id";
		$stmt7 = mysql_query($sql7);
		$arr7 = mysql_fetch_array($stmt7);

		while($arr7 = mysql_fetch_array($stmt7)){
		             $arr8[$j]=$arr7[coupon_id];
					 $j++;
		};
	for($i=0;$i<1000;$i++){
		$sql1 = "update user_coupons set status='212' where user_id='447' and coupon_id='".$arr8[$i]."'";
		mysql_query($sql1);
	   }   
for($i=0;$i<1000;$i++){
		$sql2 = "update coupons set status='212' where coupon_id='".$arr8[$i]."'";
		mysql_query($sql2);
	   }   
*/

?>
<?php
/*$start_betting = trim($_POST["start_betting"]);
$end_betting = trim($_POST["end_betting"]);
$betting =  trim($_POST["betting"]);
$member_no = $_POST["coupon"].$cert_number;
for($i=$start_betting;$i<=$end_betting;$i++){
        if($i<10){
           $i="00$i";
	       $sql4 = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('".$member_no."','$i','".$betting."','1','447','1')"; 
            mysql_query($sql4);
        }elseif($i<100 and $i>=10){
  		     $i="0$i";
	         $sql4 = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('".$member_no."','$i','".$betting."','1','447','1')";
            mysql_query($sql4);
  }else{
            $sql4 = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('".$member_no."','$i','".$betting."','1','447','1')";
       mysql_query($sql4);
  }
}*/
/*for($i=000;$i<=999;$i++){
  if($i<10){
     $i="00$i";
	 $sql = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('1','$i','1','1','447','1')"; 
mysql_query($sql);
  }elseif($i<100 and $i>=10){
  		$i="0$i";
		$sql = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('1','$i','1','1','447','1')"; 
mysql_query($sql);
  }else{
  $sql = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag) values('1','$i','1','1','447','1')"; 
mysql_query($sql);
  };
};*/
/*
for($i=start_betting;$i<=end_betting;$i++){
        if($i<10){
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
  };
};
*/
		?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>盘古财富网</title>
<script language="JavaScript">
<!--
	function check() {
		doc = document.form_pg;
		if(doc.loginname.value==""){
			alert("请输入会员登录帐号！");
			doc.loginname.focus();
			return false;
		}
		
	  if(doc.password.value==""){
			alert("请输入会员登陆密码！");
			doc.password.focus();
			return false;
		}
	if(doc.password1.value==""){
			alert("请输入会员登陆密码！");
			doc.password1.focus();
			return false;
		}	
	  
		if(doc.password.value!=doc.password1.value){
			alert("两次输入的密码不符，请重新输入！");
			doc.password.focus();
			return false;
		}	
		if(doc.start_betting.value==""){
			alert("请输入投注起始号码！");
			doc.start_betting.focus();
			return false;
		}
		if(doc.start_betting.value.length<3){
			alert("投注起始号码至少3位，请重新输入！");
			doc.start_betting.focus();
			return false;
		}
		if(doc.end_betting.value.length<3){
			alert("投注结束号码至少3位，请重新输入！");
			doc.start_betting.focus();
			return false;
		}
		if(doc.end_betting.value==""){
			alert("请输入投注结束号码！");
			doc.end_betting.focus();
			return false;
		}
		if(doc.start_betting.value!=''){
			var patrn = /[0-9]$/;
			if(!patrn.test(doc.start_betting.value)){
				alert('起始号码格式不对,请输入0-9的整数！');
				doc.start_betting.focus();
				return false;
			}
		}
		if(doc.end_betting.value!=''){
			var patrn1 = /[0-9]$/;
			if(!patrn1.test(doc.end_betting.value)){
				alert('结束号码格式不对,请输入0-9的整数！');
				doc.end_betting.focus();
				return false;
			}
		}
		if(doc.betting.value==""){
			alert("请输入投注份数！");
			doc.betting.focus();
			return false;
		}
		if(doc.betting.value!=''){
			var patrn2 = /[0-9]$/;
			if(!patrn2.test(doc.betting.value)){
				alert('投注份数格式不对,请输入0-9的整数！');
				doc.betting.focus();
				return false;
			}
		}
     }
//-->
</script>
<style type="text/css">
<!--
.style2 {font-size: 12px}
.style3 {color: #FF0000}
.style5 {color: #666666}
.style6 {
	color: #333333;
	font-size: 12px;
}
.style7 {font-size: 16px}
.style8 {font-size: 12px; color: #FF0000; }
.style9 {color: #FF0000; font-size: 16px; }
.STYLE10 {color: #666666; font-size: 12px; }
-->
</style>
</head>
<body topmargin="0" leftmargin="0">
<br><br><br>
<table cellpadding="0" cellspacing="0" width="715" align="center">
	<tr>
		<td width="683" height="224" align="center" valign="top"><table cellpadding="0" cellspacing="0" width="697">
			<!-- MSTableType="layout" -->
			<tr>
				<td width="685" valign="top">
				<table cellpadding="0" cellspacing="0" width="665" id="table3">
					<!-- MSTableType="layout" -->
					<tr>
						<td align="center" valign="top" width="663">　
						  <table width="691" cellpadding="0" cellspacing="0" id="table4">
							<!-- MSTableType="layout" -->
							<tr>
							<form name="form_pg" method=post action="addusermorelistbetingregister.php" onSubmit="return check()">

							  <td align="center" valign="top" width="685">
								<table cellpadding="3" cellspacing="1" bgcolor="#C0C0C0" id="table5" width="675">
									<!-- MSTableType="layout" -->
									<tr>
									  <td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><div align="center"><span class="style7 STYLE2"><strong><span class="STYLE2 style7">批 量 组 号 参 与 分 红 </span></strong></span><br>
									      <span class="style3">一、注意：请使用会员帐号进行分红，请勿使用消费单位或工作站帐号进行批量组号！<br>
									  二、注意：参与分红前请仔细检查你的分红凭证张数是否足够！<br>
									  提示：此功能是通过开始号码和结束号码之间的组合成投注号，例如000-999,投注张数为1的话，则为1千注！</span></div></td>
								    </tr>
									
								
								
									
									
									<tr>
                                      <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">会员登陆帐号：</span></td>
									  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><input name="loginname" type="text" id="loginname" size="15">
                                      <span class="STYLE3"><span class="style6"><span class="style9">*</span></span></span></td>
								  </tr>
								  <tr>
                                      <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">会员登陆密码：</span></td>
									  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><input name="password" type="password" id="password" size="15">
                                      <span class="STYLE3"><span class="style6"><span class="style9">*</span></span></span></td>
								  </tr>
								  <tr>
                                      <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">会员登陆密码确认：</span></td>
									  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><input name="password1" type="password" id="password1" size="15">
								      <span class="STYLE3"><span class="style6"><span class="style9">*</span></span></span></td>
								  </tr>
								  <?php 
	$sql=mysql_query("select * from lotteries where flag='1' order by id desc limit 1");
    $result = mysql_fetch_array($sql);
?>
								  <tr>
                                      <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">分红期数：</span></td>
									  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF">
                                    <span class="STYLE3"><span class="style6"><span class="style9"><?php echo $result[lottery_year]?></span>年第
                                    <select size="1" name="coupon">
                                      <option value="<?php echo $result[id]?>"><?php echo $result[id]?></option>
                                    </select>
                                    期</span></span></td>
		  						  </tr>
										
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">投注起始号码：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="start_betting" type="text" id="start_betting" size="15" maxlength="3"><span class="STYLE3"><span class="style6"><span class="style9">*</span></span></span><span class="style5 style3 style3">请输入3位数的开始号码，例：000</span></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">投注结束号码：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="end_betting" type="text" id="end_betting" size="15" maxlength="3">
									    <span class="STYLE3"><span class="style6"><span class="style9">*<span class="STYLE10">请输入3位数的结束号码，例：999</span></span></span></span></td>
								  </tr>
								  <tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">投注注数：</span></td>
								    <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="betting" type="text" id="betting" size="15">
								      <span class="STYLE3"><span class="style6"><span class="style9">*<span class="STYLE10">请输入</span></span></span></span><span class="STYLE10">投注份数</span></td>
								  </tr>
								
									<tr>
									  <td height="40" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF">
										<input type="image" border="0" src="img_www/login3.gif" width="84" height="25"></td>
								  </tr>
								</table>								
							  </td>
							</form>
							</tr>
						</table>
						  <!--
						<img border="0" src="img_www/vipP05.JPG" width="7" height="7"><font size="2" color="#808080">会员注意事项 
						<br>
						&nbsp;&nbsp;&nbsp;&nbsp; 会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项 <br></font>
						-->
					  </td>
					</tr>
			  </table>			  </td>
			</tr>
	  </table>	  </td>
	</tr>
	<tr>
		<td width="683" height="20" valign="top" background="img_www/background3.jpg">　</td>
	</tr>
</table>
</body>

</html>