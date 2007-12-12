<?php
	require_once('db-settings.php');
	require_once('function.php');
	$coupon = $_POST["coupon"].$cert_number;;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>报表查询</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.STYLE2 {font-size: 12px}
.STYLE7 {font-size: 12px; color: #0000FF; }
.STYLE9 {font-size: 12px; color: #000000; }
.STYLE10 {color: #0000FF}
-->
</style>

</head>
<script>

	function makesure()
	{
		return(confirm("此操作将拒绝支付，你确定要确认吗？"))
	}	
	function makesureConfirm()
	{
		return(confirm("此操作将确认支付，你确定要确认吗？"))
	}
</script>
<body>
<div align="center"><br>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="9%" height="30" valign="middle" class="title_small_new">审核提款</td>
        <td width="11%" align="left" valign="middle">【<a href="javascript:window.print()" class="text">打印报表</a>】</td>
        <td align="left"><a href="testmoney.php" class="STYLE10">未审核</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="testmoney3.php" class="STYLE10">审核并支付</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="testmoney4.php" class="STYLE10">审核并拒绝</a></td>
	</tr>
</table>
</div>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#888888">
  <tr>
    <td width="76" align="center" bgcolor="#CCFFCC"><span class="text2 STYLE2">登录名</span></td>
    <td width="76" align="center" bgcolor="#CCFFCC"><span class="STYLE2">姓名</span></td>
    <td width="76"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">拥有张数</span></td>
    <td width="100"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">申请提现张数</span></td>
    <td width="80" align="center" bgcolor="#CCFFCC"><span class="STYLE2">提现金额</span></td>
    <td width="80"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">应交所得税</span></td>
    <td width="80"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">累积所得</span></td>
    <td width="80"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">申请时间</span></td>
    <td colspan="3"  align="center" bgcolor="#CCFFCC"><span class="STYLE9">查看</span></td>
  </tr>
  <?php 
	 $sql=mysql_query("select cotmoney.*,users.user_name from cotmoney inner join users on cotmoney.ctnid=users.id where cotmoney.flag='0'");
	 while($result=mysql_fetch_array($sql)){
	?>
  <tr>
    <td width="76" align="center" class="title_small_new"><a href="../users/view/<?php echo $result[ctnid];?>"><span class="STYLE7"><?php echo $result[ctname]?></span></a></td>
    <td width="76" align="center"><span class="STYLE2"><?php echo $result[user_name]?></span></td>
    <td width="76"  align="center"><span class="STYLE2"><?php echo $result[count1]?></span></td>
    <td width="100"  align="center"><span class="STYLE2"><?php echo $result[timo]?></span></td>
    <td width="80" align="center"><span class="STYLE2"><?php echo $result[timo]*2?></span></td>
    <td width="80"  align="center"><span class="STYLE2"><?php echo $result[timo]*2*0.2?></span></td>
    <td width="80"  align="center"><span class="STYLE2"><?php echo ($result[timo]*2)-($result[timo]*2*0.2)?></span></td>
    <td width="80"  align="center"><span class="STYLE2"><?php echo $result[crmy]?></span></td>
    <td width="140"  align="center" bgcolor="#CCFFCC"><span class="STYLE2"><a href="testmoney1.php?id=<?php echo $result[id];?>" onClick="return makesureConfirm();">同意支付</a>┋<a href="testmoney2.php?id=<?php echo $result[id];?>" onClick="return makesure();">拒绝支付</a></span></td>

  </tr>
  <?php
  };
  ?>
</table>
</body>
</html>
