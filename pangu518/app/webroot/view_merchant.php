<?php
	require_once("db-settings.php");

	$id = $_GET["id"];
	$industry_id = $_GET["industry_id"];

	$sql = "select a.merchant_name,a.owner,a.created,b.industry_name from merchants a,industries b where a.industry_id=b.id and b.id = $industry_id and a.id = $id";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);
?>
<HEAD>
<TITLE><?=$arr[2]?></TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<br><br>
<table width="400" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#003366">
  <tr>
    <td height="35" colspan="2" align="center" bgcolor="#FFFFFF"><span class="title"><?=$arr[0]?></span></td>
  </tr>
  <tr>    
	<td width="97" height="30" align="center" valign="middle" bgcolor="#FFFFFF">所属行业：</td>
    <td width="303" valign="middle" bgcolor="#FFFFFF"><?=$arr[3]?></td>
  </tr>
  <tr>
    <td height="15" align="center" bgcolor="#FFFFFF">所&nbsp;有&nbsp;人：</td>
    <td bgcolor="#FFFFFF"><?=$arr[1]?></td>
  </tr>
  <tr>
    <td height="15" align="center" bgcolor="#FFFFFF">加入日期：</td>
    <td bgcolor="#FFFFFF"><?=$arr[2]?></td>
  </tr>
  <tr>
    <td height="35" colspan="2" align="center" bgcolor="#FFFFFF">[<a href="javascript:window.close()">关闭窗口</a>]</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>