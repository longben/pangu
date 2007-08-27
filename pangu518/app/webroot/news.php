<?php
	session_start();
	require_once("db-settings.php");

	if($_GET["type"]){
		$Title_JJZX_ID = $_GET["type"];
	}else{
		$strTitle_JJZX = "select id from categories where category_name = '经济资讯' ";
		$stmtTitle_JJZX = mysql_query($strTitle_JJZX);
		$arrTitle_JJZX = mysql_fetch_array($stmtTitle_JJZX);
		$Title_JJZX_ID = $arrTitle_JJZX[0];	
	}
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
		<img border="0" src="img_www/zixunfabu.jpg" width="197" height="73"></td>
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
		<td width="612" valign="top" rowspan="2" align="center"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

	<?php
		$strJJZX = "select a.id,a.post_title,a.created from posts a,categories b  where a.category_id=b.id and b.id = $Title_JJZX_ID and a.post_status = 'publish' order by created desc ";
		$stmtJJZX = mysql_query($strJJZX);
		while($arrJJZX = mysql_fetch_array($stmtJJZX)) {
	?>

          <tr>
            <td width="354" height="22" class="text_a"><img src="img_www/shouyep06.JPG" alt=" " width="5" height="7" border="0">
				<a href="javascript:;"><span onClick = "javascript:window.open('view.php?id=<?=$arrJJZX[0]?>&type=<?=$Title_JJZX_ID?>','PG','scrollbars=auto,width=420,height=300')"><?=$arrJJZX[1]?></span></a><br>
            <img src="img_www/shouyep05.JPG" alt=" " width="100%" height="5" border="0"></td>
            <td width="195" height="22" class="text"><?=$arrJJZX[2]?></td>
          </tr>

	<?php	}?>


        </table></td>
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