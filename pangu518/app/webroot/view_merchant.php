<?php
	require_once("db-settings.php");

	$id = $_GET["id"];
	$industry_id = $_GET["industry_id"];

	$id = str_replace("'","",$id);
	$id = str_replace("\\","",$id);
	$id = (int)$id;

	$industry_id = str_replace("'","",$industry_id);
	$industry_id = str_replace("\\","",$industry_id);
	$industry_id = (int)$industry_id;

	$sql = "select a.merchant_name,a.owner,a.created,b.industry_name from merchants a,industries b where a.industry_id=b.id and b.id = $industry_id and a.id = $id";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);
?>
<html>
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<TITLE>盘古经济</TITLE>
</head>

<body topmargin="0" leftmargin="0">
<?php	include("header.php");?>
<table width="900" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="197" height="73" valign="top" rowspan="2">
		<img border="0" src="img_www/jingjizixun.jpg" width="197" height="73"></td>
		<td width="612" height="35" valign="top" background="img_www/background4.jpg">&nbsp;</td>
		<td width="91" valign="top" rowspan="5"><?php include("right_gg.php");?></td>
	</tr>
	<tr>
		<td width="612" height="38" valign="top" background="img_www/qiyeB05.jpg">&nbsp;</td>
	</tr>
	<tr>
		<td width="197" height="36" valign="top">&nbsp;</td>
		<td width="612" height="36" valign="top" background="img_www/qiyeB06.jpg"></td>
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
		<td width="612" valign="top" rowspan="2" align="center">
		
			<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#E6E6E6">
			  <tr>
				<td height="35" colspan="2" align="center" bgcolor="#FFFFFF"><span class="title"><?=$arr[0]?></span></td>
			  </tr>
			  <tr>    
				<td width="108" height="30" align="center" bgcolor="#FFFFFF">所属行业：</td>
				<td width="426" valign="middle" bgcolor="#FFFFFF"><?=$arr[3]?></td>
			  </tr>
			  <tr>
				<td height="15" align="center" bgcolor="#FFFFFF">所&nbsp;有&nbsp;人：</td>
				<td bgcolor="#FFFFFF"><?=$arr[1]?></td>
			  </tr>
			  <tr>
				<td height="15" align="center" bgcolor="#FFFFFF">加入日期：</td>
				<td bgcolor="#FFFFFF"><?=$arr[2]?></td>
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