<?php
 require_once('db-settings.php');
 $username=trim($_POST["username"]);
 $password1=trim($_POST["password1"]);
 $password1=md5($password1);
 $sql = "select uid from members where username='".$username."' and password='".$password1."'";
 $stmt = mysql_query($sql);
 $arr = mysql_fetch_array($stmt);
 $sql1 = "select merchant_name from merchants where user_id='".$arr[0]."'";
 $stmt1 = mysql_query($sql1);
 $arr1 = mysql_fetch_array($stmt1);
 
 if(empty($arr)){
   echo("<script language='JavaScript'>alert('抱歉，密码或登陆名不正确！');location.replace('../findmoney.php');</script>");
		exit();
   }elseif(empty($arr1)){
 $sql2 = "select sum(ubetdian) from coulottery where uid='".$arr[0]."'";
 $stmt2 = mysql_query($sql2);
 $arr2 = mysql_fetch_array($stmt2);
   }else{
 $sql3 = "select sum(cldian) from coumercherts where cuid='".$arr[0]."'";
 $stmt3 = mysql_query($sql3);
 $arr3 = mysql_fetch_array($stmt3);
   }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>盘古财富网</title>

<style type="text/css">
<!--
.STYLE10 {
	color: #0000FF;
	font-size: large;
	font-family: "新宋体";
}
-->
</style>
</head>
<body topmargin="0" leftmargin="0">
<br><br><br>
<table cellpadding="0" cellspacing="0" width="715" align="center">
	<tr>
	  <td width="683" height="137" align="center" valign="top"><table cellpadding="0" cellspacing="0" width="697">
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
							

							  <td align="center" valign="top" width="685">
								<table cellpadding="3" cellspacing="1" bgcolor="#C0C0C0" id="table5" width="675">
									<!-- MSTableType="layout" -->
									<tr>
									  <td height="35" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="STYLE10">查 询 已 有 积 点</span></td>
								    </tr>
						
			
									<tr>
                                      <td width="146" height="22" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">会员帐号：</span></td>
									  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><?php echo $username?></td>
									</tr>
								  <tr>
                                      <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">拥有点数：</span></td>
									  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><?php if(empty($arr1)){
									     echo $arr2[0];
									  }else{
									  echo $arr3[0];
									  }?></td>
								  </tr>
								   <tr>
                                      <td width="146" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">单位名称：</span></td>
									  <td width="512" align="left" valign="middle" bgcolor="#FFFFFF"><?php if(empty($arr1)){
									     echo "不是消费单位";
									  }else{
									  echo $arr1[0];
									  }?></td>
								  </tr>
								  <tr>
									  <td height="40" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
								  </tr>
								</table>							  </td>

							</tr>
						</table>
						  <!--
						<img border="0" src="img_www/vipP05.JPG" width="7" height="7"><font size="2" color="#808080">会员注意事项 
						<br>
						&nbsp;&nbsp;&nbsp;&nbsp; 会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项会员注意事项 <br></font>
						-->					  </td>
					</tr>
			  </table>			  </td>
			</tr>
	  </table></td>
	</tr>
	<tr>
									  <td height="40" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
	</tr>
</table>
</body>

</html>