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
-->
</style>
<?php
	// DB LINK
	$db_name 		= "pangu518";
	$db_host 		= "localhost";
	$db_user 		= "root";
	$db_password 	= "";	

	$db = mysql_connect($db_host, $db_user, $db_password);
	mysql_query("set names 'utf8'");
	mysql_select_db($db_name, $db);
?>
</head>

<body topmargin="0" leftmargin="0">

<?php	include("header.php");?>
<table cellpadding="0" cellspacing="0" width="900" height="825" align="center">
	<!-- MSTableType="layout" -->
	<tr>
		<td width="197" height="129" valign="top" background="img_www/vipt01.jpg">　</td>
		<td width="612" height="129" valign="top" background="img_www/vipt02.jpg">
		　</td>
		<td width="91" height="129" valign="top" background="img_www/vipt03.jpg">　</td>
	</tr>
	<tr>
		<td width="197" height="47" valign="top" background="img_www/vipt04.jpg">　</td>
		<td width="612" height="47" valign="middle" background="img_www/botton1.jpg">
		<p align="center">
		<font face="黑体" size="2"><a href="main.php">首页</a></font><font face="黑体" size="2" color="#666666">|<a href="qiye.php">企业文化</a><font color="#666666">|</font><a href="falv.php">法律法规</a><font color="#666666">|</font><a href="fenhong.php">分红规则</a><font color="#666666">|</font><a href="qiye.php">客户服务中心</a><font color="#666666">|</font><a href="huikuan.php">汇款内容</a><font color="#666666">|</font><a href="VIPuse.php">会员消费单位</a><font color="#666666">|</font><a href="xiazai.php">下载专区</a><font color="#666666">|</font><a href="vip.php">会员专区</a>|盘古论坛</font></td>
		<td width="91" height="47" valign="top" background="img_www/vipt05.jpg">　</td>
	</tr>
	<tr>
		<td width="197" height="73" valign="top" rowspan="2">
		<img border="0" src="img_www/huiyuanzhuanqu.jpg" width="197" height="73"></td>
		<td width="612" height="35" valign="top" background="img_www/background4.jpg">　</td>
		<td width="91" valign="top" rowspan="5">　</td>
	</tr>
	<tr>
		<td width="612" height="38" valign="top" background="img_www/VIPB05.jpg">　</td>
	</tr>
	<tr>
		<td width="197" height="36" valign="top">
		<img border="0" src="img_www/side2.jpg" width="197" height="36"></td>
		<td width="612" height="36" valign="top" background="img_www/VIPB06.jpg">　</td>
	</tr>
	<tr>
		<td width="197" height="224" valign="top">
		<img border="0" src="img_www/side3.jpg" width="197" height="33"><img border="0" src="img_www/side4.jpg" width="197" height="33"><img border="0" src="img_www/side5.jpg" width="197" height="33"><img border="0" src="img_www/side6.jpg" width="197" height="33"><img border="0" src="img_www/side7.jpg" width="197" height="51"><img border="0" src="img_www/side8.jpg" width="197" height="41"></td>
		<td width="612" valign="top" rowspan="2" align="center"><table cellpadding="0" cellspacing="0" width="538">
			<!-- MSTableType="layout" -->
			<tr>
				<td valign="top">
				<table cellpadding="0" cellspacing="0" width="500" height="341" id="table3">
					<!-- MSTableType="layout" -->
					<tr>
						<td align="center" valign="top" width="500">　
						  <table width="500" height="250" cellpadding="0" cellspacing="0" id="table4">
							<!-- MSTableType="layout" -->
							<tr>
							<form method=post action="register_do.php">

								<td align="center" valign="top" width="500">
								<table cellpadding="3" cellspacing="1" bgcolor="#C0C0C0" id="table5" width="400">
									<!-- MSTableType="layout" -->
									<tr>
									  <td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="STYLE2">会 员 注 册</span></td>
								    </tr>
									<tr>
                                      <td width="480" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-family: 宋体; font-size: 9pt">省份</span><span style="font-size: 9.0pt; font-family: 宋体">：</span></td>
									  <td width="480" align="left" valign="middle" bgcolor="#FFFFFF">
									  <select size="1" name="coupon">
										<?php
											$sql = "select id,region_name from regions where id like '__0000'";
											$stmt = mysql_query($sql);
											while($arr= mysql_fetch_array($stmt)){
												echo("<option value='".$arr[0]."'>".$arr[1]."</option>");
											}
										?>
                                        </select>                                      </td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">登录名：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="login_name" type="text" id="login_name" size="15"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">密码：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="password" type="text" id="password" size="15"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体"> 真实姓名：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="user_name" type="text" id="user_name" size="15"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">性别：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="sex" type="text" id="sex" size="15"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体"> 身份证号码：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="cert_number" type="text" id="cert_number" size="15"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">固定电话：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="telephone" type="text" id="telephone" size="15"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">联系手机：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="mobile" type="text" id="mobile" size="15"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体"> 邮政储蓄银行帐号：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="accounts" type="text" id="accounts" size="20"></td>
								  </tr>
									<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">推荐人帐号：</span></td>
									  <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="referees" type="text" id="referees" size="15"></td>
								  </tr>
									<tr>
									  <td height="40" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><img border="0" src="img_www/vipp02.JPG" width="84" height="25"></td>
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
						<img border="0" src="img_www/vipP05.JPG" width="7" height="7"><font size="2" color="#808080">会员注意事项 
						<br>
&nbsp;&nbsp;&nbsp;&nbsp; 1 会员注意事项会员注意事项会员注意事项会员注意事项 <br>
&nbsp;&nbsp;&nbsp;&nbsp; 2 会员注意事项会员注意事项会员注意事项 <br>
&nbsp;&nbsp;&nbsp;&nbsp; 3 会员注意事项会员注意事项 <br>
&nbsp;&nbsp;&nbsp;&nbsp; 4 会员注意事项会员注意事项</font>
						<p align="left" style="line-height: 150%">　</td>
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