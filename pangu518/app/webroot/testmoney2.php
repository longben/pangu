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
	$sql="update cotmoney set flag=2,crto='".$nowtime."' where id='".$id."'";
    mysql_query($sql);
	$sql1="select ctnid,timo from cotmoney where id='".$id."'";
	$stmt1=mysql_query($sql1);
	$arr1=mysql_fetch_array($stmt1);
	$sql2="update user_coupons set status='421' where user_id='".$arr1[0]."' and status='212' limit $arr1[1]";
	mysql_query($sql2);
	echo("<script language='JavaScript'>alert('恭喜你，已成功拒绝支付！');location.replace('../testmoney4.php');</script>");
?>
</body>
</html>