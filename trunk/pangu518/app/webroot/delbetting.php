<?php 
  require_once('db-settings.php');
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
			alert("请输入会员登录帐号！");
			doc.mobile.focus();
			return false;
		}
		if(doc.loginname.value==""){
			alert("请输入管理员编号！");
			doc.loginname.focus();
			return false;
		}
		if(doc.password1.value==""){
			alert("请输入管理员口令！");
			doc.password1.focus();
			return false;
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
            <td width="685" valign="top"><table cellpadding="0" cellspacing="0" width="665" id="table3">
                <!-- MSTableType="layout" -->
                <tr>
                  <td align="center" valign="top" width="663">　
                    <table width="691" cellpadding="0" cellspacing="0" id="table4">
                        <!-- MSTableType="layout" -->
                        <tr>
                          <form name="form_pg" method=post action="delbettingchecking.php" onSubmit="return check()">
                            <td align="center" valign="top" width="685"><table cellpadding="3" cellspacing="1" bgcolor="#C0C0C0" id="table5" width="675">
                                <!-- MSTableType="layout" -->
                                <tr>
                                  <td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="style7 STYLE2"><strong><span class="STYLE2 style7">批量删除参与分红投注信息</span></strong></span> </td>
                                </tr>
                                <tr>
                                  <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">会员登陆帐号：</span></td>
                                  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><input name="mobile" type="text" id="mobile" size="15">
                                      <span class="STYLE3"><span class="style6">注意：此为会员申请的会员登陆帐号，不包括登陆名为中文的会员登陆帐号，不能是会员的姓名等其他，否则将出错，请仔细核对！<span class="style9">*</span></span></span></td>
                                </tr>
                                <?php 
	$sql=mysql_query("select * from lotteries where flag='1' order by id");
    $result = mysql_fetch_array($sql);
?>
                                <tr>
                                  <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">分红期数：</span></td>
                                  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"> 第
                                    <select size="1" name="coupon">
                                        <?php
									    $sql = "select id from lotteries order by id";
											$stmt = mysql_query($sql);
											while($arr= mysql_fetch_array($stmt)){
												echo("<option value='".$arr[0]."'>".$arr[0]."</option>");
											}
									 ?>
                                      </select>
                                    期</td>
                                </tr>
								<tr>
                                  <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">删除类别：</span></td>
                                  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"> 第
                                    <select size="1" name="coupon1">
                                      <option value="全部">全部</option>
									  <option value="商家">商家</option>
									  <option value="会员">会员</option>
                                      </select>
                                    期</td>
                                </tr>
								<tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">管理员编号：</span></td>
								    <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="loginname" type="text" id="loginname" size="15" maxlength="10"><span class="STYLE3"><span class="style6"><span class="style3"></span><span class="style9">*</span></span></span></td>
								  </tr>
								   <tr>
                                      <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">管理员编号口令：</span></td>
							         <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="password1" type="password" id="password1" size="15">
							         <span class="STYLE3"><span class="style6"><span class="style3"></span><span class="style9">*</span></span></span></td>
								   </tr>
                                <tr>
                                  <td height="40" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><input name="image" type="image" src="img_www/login1.gif" width="84" height="25" border="0"></td>
                                </tr>
                            </table></td>
                          </form>
                        </tr>
                      </table>
                    <!--
						<img border="0" src="img_www/vipP05.JPG" width="7" height="7"><font size="2" color="#808080">会员注意事项 
						<br>
						&nbsp;&nbsp;&nbsp;&nbsp; 会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项 <br></font>
						-->                  </td>
                </tr>
            </table></td>
          </tr>
        </table></td>
	</tr>
	<tr>
		<td width="683" height="20" valign="top" background="img_www/background3.jpg">　</td>
	</tr>
</table>
</body>

</html>