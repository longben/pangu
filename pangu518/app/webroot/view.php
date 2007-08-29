<?php
	require_once("db-settings.php");

	$id = $_GET["id"];
	$type_id = $_GET["type"];

	$id = str_replace("'","",$id);
	$id = str_replace("\\","",$id);
	$id = (int)$id;

	$type_id = str_replace("'","",$type_id);
	$type_id = str_replace("\\","",$type_id);
	$type_id = (int)$type_id;

	$strNEWS = "select a.post_title,a.post_content,b.category_name from posts a,categories b where a.category_id=b.id and b.id = $type_id and a.id = $id";
	$stmtNEWS = mysql_query($strNEWS);
	$arrNEWS = mysql_fetch_array($stmtNEWS);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$arrNEWS[2]?></title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<p>&nbsp;</p>
<table width="400" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#000033">
  <tr>
    <td height="35" align="center" bgcolor="#FFFFFF"><span class="title"><?=$arrNEWS[0]?></span></td>
  </tr>
  <tr>    
	<td height="150" valign="top" bgcolor="#FFFFFF" class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$arrNEWS[1]?></td>
  </tr>
  <tr>
    <td height="15" align="center" bgcolor="#FFFFFF">[<a href="javascript:window.close()">关闭窗口</a>]</td>
  </tr>
</table>
</body>
</html>
