<?php
	require_once('db-settings.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>盘古经济</title>
<style type="text/css">
<!--
a:link {
	color: #333333;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #333333;
}
a:hover {
	text-decoration: none;
	color: #333333;
}
a:active {
	text-decoration: none;
}
.style1 {font-size: 16px}
.STYLE2 {
	color: #000066;
	font-weight: bold;
}
.left_title {font-family: "宋体";
	font-size: 13px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: capitalize;
	color: #5B5B5B;
}
.STYLE3 {color: #FF0000}
-->
</style>

<script language="JavaScript">
<!--
	function check() {
		doc = document.form_pg;

		if(doc.login_name.value==""){
			alert("请输入登录名！");
			doc.login_name.focus();
			return false;
		}

		if(doc.login_name.value.length<3){
			alert("登录名至少3位，请重新输入！");
			doc.login_name.focus();
			return false;
		}

		if(doc.password.value==""){
			alert("请输入密码！");
			doc.password.focus();
			return false;
		}

		if(doc.password.value.length<6){
			alert("密码至少6位，请重新输入！");
			doc.password.focus();
			return false;
		}

		if(doc.password2.value==""){
			alert("请输入确认密码！");
			doc.password2.focus();
			return false;
		}

		if(doc.password.value!=doc.password2.value){
			alert("两次输入的密码不符，请重新输入！");
			doc.password.focus();
			return false;
		}

		if(doc.user_name.value==""){
			alert("请输入真实姓名！");
			doc.user_name.focus();
			return false;
		}

		if(doc.cert_number.value==""){
			alert("请输入身份证号码！");
			doc.cert_number.focus();
			return false;
		}

		if((doc.cert_number.value.length != 15) && (doc.cert_number.value.length != 18)){
			alert("身份证位数不对，请核对重新输入！");
			doc.cert_number.focus();
			return false;
		}

		if(doc.cert_number.value!=''){

			var patrn = /[0-9Xx]$/;
			if(!patrn.test(doc.cert_number.value)){
				alert('身份证号码格式不对！');
				doc.cert_number.focus();
				return false;
			}
		}

		if(doc.mobile.value==""){
			alert("请输入手机号码！");
			doc.mobile.focus();
			return false;
		}

		if((doc.mobile.value.length != 11) || (isNaN(doc.mobile.value))){
			alert("手机号码有误，请重新录入");
			doc.mobile.focus();
			return false;
		}

		if(doc.office_phone.value!=''){

			var patrn=/^0\d{2,3}\-\d{7,8}$/;
			if(!patrn.test(doc.office_phone.value)){
				alert('办公电话格式不对');
				doc.office_phone.focus();
				return false;
			}
		}

		if(doc.home_phone.value!=''){

			var patrn=/^0\d{2,3}\-\d{7,8}$/;
			if(!patrn.test(doc.home_phone.value)){
				alert('家庭电话格式不对');
				doc.home_phone.focus();
				return false;
			}
		}


		if(doc.accounts.value==""){
			alert("请输入邮政储蓄卡号！");
			doc.accounts.focus();
			return false;
		}

		if(doc.accounts.value.length != 19){
			alert("邮政储蓄卡号必须为19位！");
			doc.accounts.focus();
			return false;
		}

		if(isNaN(doc.accounts.value)){
			alert("输入的邮政储蓄卡号有误，请重新输入！");
			doc.accounts.focus();
			return false;
		}

	}
//-->
</script>
</head>

<body topmargin="0" leftmargin="0">

<?php	include("header.php");?>
<table cellpadding="0" cellspacing="0" width="900" align="center">
	<!-- MSTableType="layout" -->
	<tr>
		<td width="197" height="129" valign="top" background="img_www/vipt01.jpg">&nbsp;</td>
		<td width="612" height="129" valign="top" background="img_www/vipt02.jpg">&nbsp;</td>
		<td width="91" height="129" valign="top" background="img_www/vipt03.jpg">&nbsp;</td>
	</tr>
	<tr>
		<td width="197" height="47" valign="top" background="img_www/vipt04.jpg">&nbsp;</td>
		<td width="612" height="47" valign="middle" background="img_www/botton1.jpg">
		<?php	include("menu.php");?>
		</td>
		<td width="91" height="47" valign="top" background="img_www/vipt05.jpg">&nbsp;</td>
	</tr>
	<tr>
		<td width="197" height="73" valign="top" rowspan="2">
		<img border="0" src="img_www/huiyuanzhuanqu.jpg" width="197" height="73"></td>
		<td width="612" height="35" valign="top" background="img_www/background4.jpg">　</td>
		<td width="91" valign="top" rowspan="5"><?php include("right_gg.php");?></td>
	</tr>
	<tr>
		<td width="612" height="38" valign="top" background="img_www/VIPB05.jpg">&nbsp;</td>
	</tr>
	<tr>
		<td width="197" height="36" valign="top">&nbsp;</td>
		<td width="612" height="36" valign="top" background="img_www/VIPB06.jpg">&nbsp;</td>
	</tr>
	<tr>
		<td width="197" height="224" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="36" valign="middle" background="img_www/sidebg2.jpg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="contact.php">&nbsp;<span class="left_title">联系盘古</span></a></td>
          </tr>
          <tr>
            <td height="36" valign="middle" background="img_www/sidebg2.jpg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="join.php">&nbsp;<span class="left_title">加盟盘古</span></a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><a href="cooperation.php"><img src="img_www/side7.jpg" width="197" height="51" border="0"></a></td>
          </tr>
          <tr>
            <td><img src="img_www/side8.jpg" width="197" height="41" border="0"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
		<td width="612" valign="top" rowspan="2" align="center"><table cellpadding="0" cellspacing="0" width="538">
			<!-- MSTableType="layout" -->
			<tr>
				<td valign="top">
				<table cellpadding="0" cellspacing="0" width="500" id="table3">
					<!-- MSTableType="layout" -->
					<tr>
						<td align="center" valign="top" width="500">　
						  <table width="500" cellpadding="0" cellspacing="0" id="table4">
							<!-- MSTableType="layout" -->
							<tr>
							<form name="form_pg" method=post action="register_do.php" onSubmit="return check()">

								<td align="center" valign="top" width="500">
								<table cellpadding="3" cellspacing="1" bgcolor="#C0C0C0" id="table5" width="400">
									<!-- MSTableType="layout" -->
									<tr>
									  <td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="STYLE2">会 员 注 册</span></td>
								    </tr>
									<tr>
                                      <td width="112" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-family: 宋体; font-size: 9pt">省份</span><span style="font-size: 9.0pt; font-family: 宋体">：</span></td>
									  <td width="271" align="left" valign="middle" bgcolor="#FFFFFF">
									  <select size="1" name="coupon">
										<?php
											$sql = "select id,region_name from regions where id like '__0000'";
											$stmt = mysql_query($sql);
											while($arr= mysql_fetch_array($stmt)){
												echo("<option value='".$arr[0]."'>".$arr[1]."</option>");
											}
										?>
                                      </select>
									  <span class="STYLE3">*</span> </td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">登录名：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="login_name" type="text" id="login_name" size="15" maxlength="15">
									    <span class="STYLE3">*</span></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">密码：</span></td>
									  <td align="left" valign="middle" bgcolor="#FFFFFF"><input name="password" type="password" id="password" size="15" maxlength="20">
                                        <span class="STYLE3">*</span></td>
								  </tr>
									<tr>
									  <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">确认密码：</span></td>
								      <td align="left" valign="middle" bgcolor="#FFFFFF"><input name="password2" type="password" id="password2" size="15" maxlength="20">
                                        <span class="STYLE3">*</span></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体"> 真实姓名：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="user_name" type="text" id="user_name" size="15" maxlength="10">
                                        <span class="STYLE3">*</span></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">性别：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><label>
                                        <select name="sex" id="sex">
                                          <option value="1" selected>男</option>
                                          <option value="2">女</option>
                                          </select>
                                        </label>
                                        <span class="STYLE3">*</span></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体"> 身份证号码：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="cert_number" type="text" id="cert_number" size="18" maxlength="18">
                                        <span class="STYLE3">*</span></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">手机号码：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="mobile" type="text" id="mobile" size="15" maxlength="11">
                                        <span class="STYLE3">*</span></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">办公电话：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="office_phone" type="text" id="office_phone" size="15" maxlength="20"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">家庭电话：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="home_phone" type="text" id="home_phone" size="15" maxlength="20"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体"> 邮政储蓄卡号：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="accounts" type="text" id="accounts" size="20" maxlength="19">
                                        <span class="STYLE3">*</span></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">推荐人帐号：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="referees" type="text" id="referees" size="15" maxlength="20" value="www7777"></td>
								  </tr>
									<tr>
									  <td height="40" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF">
										<input type="image" border="0" src="img_www/vipp02.JPG" width="84" height="25">									   </td>
								  </tr>
								</table>
								</td>
							  </form>
							</tr>
						</table>
						  <br>
						  <p align="left" style="line-height: 150%">&nbsp;<br>
						<img border="0" src="img_www/vipp04.JPG" width="401" height="5"><br>
						<font size="2" color="#808080">&nbsp;&nbsp;&nbsp;&nbsp;
						</font>
						<!--
						<img border="0" src="img_www/vipP05.JPG" width="7" height="7"><font size="2" color="#808080">会员注意事项 
						<br>
						&nbsp;&nbsp;&nbsp;&nbsp; 会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项 <br></font>
						-->
						</td>
					</tr>
				</table>
			  </td>
			</tr>
		</table>
	  </td>
	</tr>
	<tr>
		<td width="197" valign="top" background="img_www/background2.jpg">　</td>
	</tr>
	<tr>
		<td width="197" height="20" valign="top" background="img_www/background1.jpg">　</td>
		<td width="612" height="20" valign="top" background="img_www/background3.jpg">　</td>
		<td width="91" height="20" valign="top" background="img_www/top8.jpg">　</td>
	</tr>
</table>
<?php	include("footer.php");?>
</body>

</html>