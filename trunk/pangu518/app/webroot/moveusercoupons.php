<?php
	require_once('db-settings.php');
	$login_name = trim($_POST["login_name"]);
	$password = trim($_POST["password"]);
	$password2 = md5($password);
	$user_name = trim($_POST["user_name"]);
	$mobile = trim($_POST["mobile"]);
			
	if(!empty($mobile) and !empty($login_name) and !empty($password) and !empty($password2) and !empty($user_name)) {
	$sql = "select id from users where login_name='".$login_name."'";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);
	
	
	$sql1 = "select id from users where login_name='".$user_name."'";
	$stmt1 = mysql_query($sql1);
	$arr1 = mysql_fetch_array($stmt1);
	
	$sql2 = "select uid from members where username='".$login_name."' and password='".$password2."'";
	$stmt2 = mysql_query($sql2);
	$arr2 = mysql_fetch_array($stmt2);
	$idcode2 = $arr2[0];
	
		
	$sql9 = "select count(id) from user_coupons where user_id='".$arr[0]."' and status='421' order by id";
	$stmt9 = mysql_query($sql9);
	$arr9 = mysql_fetch_array($stmt9);
	$idcode3 = $arr9[0];
	
		
	$sql10 = "select id from users where login_name='www7777'";
	$stmt10 = mysql_query($sql10);
	$arr10 = mysql_fetch_array($stmt10);
	$idcode4 = $arr10[0];
	//取得单位ID号	
		$sql3 = "select id from merchants where user_id='".$arr[0]."'";
		$stmt3 = mysql_query($sql3);
		$arr3 = mysql_fetch_array($stmt3);
	//取得工作站ID号	
		$sql4 = "select id from workstations where user_id='".$arr[0]."'";
		$stmt4 = mysql_query($sql4);
		$arr4 = mysql_fetch_array($stmt4);
		
	//取得单位ID号	
		$sql5 = "select id from merchants where user_id='".$arr1[0]."'";
		$stmt5 = mysql_query($sql5);
		$arr5 = mysql_fetch_array($stmt5);
	//取得工作站ID号	
		$sql6 = "select id from workstations where user_id='".$arr1[0]."'";
		$stmt6 = mysql_query($sql6);
		$arr6 = mysql_fetch_array($stmt6);
	
	if(empty($arr[0]) or empty($arr1[0]) or !empty($arr3[0]) or !empty($arr4[0]) or !empty($arr5[0]) or !empty($arr6[0])){
	echo("<script language='JavaScript'>alert('抱歉，您输入的会员登录名或转让会员登陆名不存在,或者已经是消费单位或式工作站，请重新输入！');history.go(-1);</script>");
			exit();
	}elseif(empty($idcode2)){
	     echo("<script language='JavaScript'>alert('抱歉，您输入的会员密码不正确，请重新输入！');history.go(-1);</script>");
			exit();
	}elseif($idcode3<$mobile){
	echo("<script language='JavaScript'>alert('抱歉，您的转让张数不够，请重新查询可用分红凭证张数！');history.go(-1);</script>");
			exit();
	}else{
	    $j = 0;
		$sql7 = "select * from user_coupons where user_id='".$arr[0]."' and status='421' order by id";
		$stmt7 = mysql_query($sql7);

		while($arr7 = mysql_fetch_array($stmt7)){
		             $arr8[$j]=$arr7[coupon_id];
					 $j++;
		};
		//8%先屏蔽，也就是不扣
		//$toal=($mobile/108)*8;
		$toal= 0;
		$toal1=$mobile-$toal;		
		for($i=0;$i<$mobile;$i++){
		    $sql8="update user_coupons set user_id='".$arr1[0]."' where coupon_id='".$arr8[$i]."' and status='421'";
			mysql_query($sql8);
		}
		for($i=0;$i<$toal;$i++){
		    $sql11="update user_coupons set user_id='".$idcode4."' where coupon_id='".$arr8[$i]."' and status='421'";
			mysql_query($sql11);
		}
		echo("<script language='JavaScript'>alert('恭喜你，已成功转让！');history.go(-1);</script>");
	}
	   
	}else{
		
	}
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
		if(doc.mobile.value==""){
			alert("请输入转让张数！");
			doc.mobile.focus();
			return false;
		}
		if(doc.login_name.value==""){
			alert("请输入会员登陆帐号！");
			doc.login_name.focus();
			return false;
		}
       if(doc.password2.value==""){
			alert("请输入会员密码！");
			doc.password2.focus();
			return false;
		}
		if(doc.password.value==""){
			alert("请输入会员密码！");
			doc.password.focus();
			return false;
		}
		if(doc.user_name.value==""){
			alert("请输入对方会员帐号！");
			doc.user_name.focus();
			return false;
		}
		if(doc.password.value!=doc.password2.value){
			alert("两次输入的密码不符，请重新输入！");
			doc.password.focus();
			return false;
		}	
		
		if(doc.mobile.value!=''){

			var patrn = /[0-9]$/;
			if(!patrn.test(doc.mobile.value)){
				alert('格式不对,请不要输入小数点！');
				doc.mobile.focus();
				return false;
			}
		}
		if(isNaN(doc.mobile.value)){
			alert("转入对方会员帐号张数有误，只能为数字，请重新录入");
			doc.mobile.focus();
			return false;
		}  
		/*
		if(doc.mobile.value<108){
			alert("转让张数请勿小于108，请重新录入");
			doc.mobile.focus();
			return false;
		}
		if((doc.mobile.value%108)!=0){
			alert("转让张数必须是108的倍数，请重新录入");
			doc.mobile.focus();
			return false;
		}
		*/
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
							<form name="form_pg" method=post action="moveusercoupons.php" onSubmit="return check()">

							  <td align="center" valign="top" width="685"><table cellpadding="3" cellspacing="1" bgcolor="#C0C0C0" id="table5" width="675">
                                <!-- MSTableType="layout" -->
                                <tr>
                                  <td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="style7 STYLE2"><strong><span class="STYLE2 style7">转  让</span></strong></span><br>
                                      <span class="STYLE3"><span class="style6"><span class="style3">注意：请注意仔细核对你要转让的对方会员让号，一但已经确定转入，本公司不对其负任何责任</span></span></span><span class="style3">*</span><br>
                                    <span class="STYLE3"><span class="style6"><span class="style3">注意：由于此功能针对所有会员开放，在转让前请输入要转让的会员登陆帐号和密码</span></span></span><span class="style3">*</span><br> <span class="STYLE3">
									<!--
									<span class="style6"><span class="style3">注意：转让成功后，将扣除百分之八的手续费，最小转让张数108张！</span></span></span><span class="style3">*</span><br>
									-->
									</td>
                                </tr>
                                <tr>
                                  <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">会员登陆帐号：</span></td>
                                  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><input name="login_name" type="text" id="login_name" size="15" maxlength="15">
                                      <span class="STYLE3"><span class="style6">注意：此处是要转让的会员登陆帐号！<span class="style9">*</span></span></span></td>
                                </tr>
                                <tr>
                                  <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">会员密码：</span></td>
                                  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="password" type="password" id="password" size="15"">
                                      <span class="STYLE3"><span class="style6"><span class="style9">*</span></span></span></td>
                                </tr>
                                <tr>
                                  <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">确认密码：</span></td>
                                  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="password2" type="password" id="password2" size="15">
                                      <span class="STYLE3"><span class="style6"><span class="style9">*</span></span></span></td>
                                </tr>
								<tr>
                                  <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">转入对方会员帐号：</span></td>
                                  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="user_name" type="text" id="user_name" size="15">
                                      <span class="STYLE3"><span class="style6">请输入你想转入的对方会员的登陆帐号<span class="style9">*</span></span></span></td>
                                </tr>
								<tr>
                                  <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">转入对方会员帐号张数：</span></td>
                                  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="mobile" type="text" id="mobile" size="15">
                                      <span class="STYLE3"><span class="style6">请输入你想转入的对方会员帐号张数,一张为二个财富积点<span class="style9">*</span></span></span></td>
                                </tr>
                                <tr>
                                  <td height="40" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><input name="image" type="image" src="img_www/login2.gif" width="84" height="25" border="0">                                  </td>
                                </tr>
                              </table></td>
							</form>
							</tr>
						</table>
						 
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