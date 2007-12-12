<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>报表查询</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.STYLE2 {font-size: 12px}
.STYLE3 {color: #FF0000}
.STYLE4 {color: #000000}
.STYLE5 {
	color: #000066;
	font-weight: bold;
}
-->
</style>

</head>
<body>
<?php
	require_once('db-settings.php');
	require_once('function.php');
	$id=$_GET["id"];
	$nowtime = date("Y").'-'.date("m").'-'.date("d");
	$sql="update cotmoney set flag=1,crto='".$nowtime."' where id='".$id."'";
    mysql_query($sql);
	echo("<script language='JavaScript'>alert('恭喜你，已成功支付！');location.replace('../testmoney3.php');</script>");
?>
</body>
</html>