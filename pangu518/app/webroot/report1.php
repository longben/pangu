<?php
	require_once('db-settings.php');
	require_once('function.php');
	if($_POST["year"]){
		$reportYear = $_POST["year"];
		$reportMonth = $_POST["month"];	
		$reportDays	= getdaysinmonth($reportYear,$reportMonth);
	}else {
		$reportYear = date("Y");
		$reportMonth = date("m");	
		$reportDays	= date("t");
	}

	$member_no = $_POST["coupon"].$cert_number;
	$starttime = $reportYear.'-'.$reportMonth.'-1';
	$nowtime = date("Y").'-'.date("m").'-'.date("d");
$d3=substr($starttime,8,2);  //日
$d2=substr($starttime,5,2); //月
$d1=substr($starttime,0,4); //年
//$endtime = date("Y-m-d",mktime(0,0,0,$d2+1,$d3-1,$d1));
$endtime = date("Y-m-d",mktime(0,0,0,$d2+1,$d3-1,$d1));
$sql1="delete from coumoney where starttime>'".$starttime."' and endtime<'".$endtime."'";
mysql_query($sql1);
?>
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
<table align="center">
  <tr>
  <td width="350" height="30" align="center" valign="middle" class="title_small_new"><img src="imgs/book.gif" width="18" height="18" alt="会员·消费单位·工作站数据统计报表"><a href="report.php">会员·消费单位·工作站数据统计报表</a></td>
  </tr>
  <tr>
   <td width="350" height="29" align="center" valign="middle" class="title_small_new"><img src="imgs/book.gif" width="18" height="18" alt="会员·每月排名数据统计报表"><a href="report1.php">会员·每月排名数据统计报表</a></td>
  </tr>
  <tr>
   <td width="350" height="29" align="center" valign="middle" class="title_small_new"><img src="imgs/book.gif" width="18" height="18" alt="会员·每月排名数据统计报表"><a href="addcoupons.php">批量录入会员分红凭证</a></td>
  </tr>
  <tr>
   <td width="350" height="29" align="center" valign="middle" class="title_small_new"><img src="imgs/book.gif" width="18" height="18" alt="会员·每月排名数据统计报表"><a href="delbetting.php">批量删除会员参与分红记录</a></td>
  </tr>
  <tr>
   <td width="350" height="29" align="center" valign="middle" class="title_small_new"><img src="imgs/book.gif" width="18" height="18" alt="会员·每月排名数据统计报表"><a href="testmoney.php">提款处理</a></td>
  </tr>
</table><br><br>
<div align="center"> <span class="STYLE4"><span class="STYLE3">注意：此功能必须先由会员查询了个人业绩后才有数据！</span></span><br>
  当前查询时间为： <span class="STYLE5">从<?php echo "$starttime"?>至<?php echo "$endtime"?></span><br>
  当前查询城市范围： <span class="STYLE5"><?php echo "$member_no"?></span><br>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
	  <form name="form1" method="post" action="report1.php">	
      <td width="119" height="30" valign="middle" class="title_small_new">会员排名报表统计</td>
      <td width="73" valign="middle" align="center">【<a href="javascript:window.print()" class="text">打印报表</a>】</td>
	  <td width="504" align="left">
        <select name="year" id="year">
		<?php
			for($iyear=2007; $iyear<2010; $iyear++) {

				if($_POST["year"] == $iyear) {
					$st_y = "selected";
				}elseif(empty($_POST["year"]) && date("Y") == $iyear) {
					$st_y = "selected";
				}else{
					$st_y = " ";
				}
				echo("<option value='$iyear' $st_y>$iyear</option>");
			}
		?>
        </select>
		
      年
      <select name="month" id="month">
        <?php
			for($imonth=01; $imonth<13; $imonth++) {
				if(strlen($imonth) == 1) {
					$imonth = "0".$imonth;
				}
				if($_POST["month"] == $imonth) {
					$st_m = "selected";
				}elseif(empty($_POST["month"]) && date("m") == $imonth){
					$st_m = "selected";
				}else{
					$st_m = " ";
				}
				echo("<option value='$imonth' $st_m>$imonth</option>");
			}
		?>
      </select>
      月&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;查询范围
	    <select size="1" name="coupon">
	      <option value="全国">全国</option>
	      <?php
											$sql = "select id,region_name from regions where id like '__0000'";
											$stmt = mysql_query($sql);
											while($arr= mysql_fetch_array($stmt)){
								    	echo("<option value='".$arr[1]."'>".$arr[1]."</option>");
											}
										?>
        </select></td>
	  <td width="55" valign="middle">
        <input name="Submit" type="submit" class="backbotton" value="查 询"></td>
	  </form>	  
    </tr>
</table>
</div>
<p>
  <!-- 选择45×25CM的纸张，横向打印  -->
</p>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#888888">
  <tr>
    <td width="76" align="center" bgcolor="#CCFFCC"><span class="text2 STYLE2">登录名</span></td>
    <td width="76" align="center" bgcolor="#CCFFCC"><span class="STYLE2">姓名</span></td>
    <td width="76"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">会员等级</span></td>
    <td width="100"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">所属地区</span></td>
    <td width="80" align="center" bgcolor="#CCFFCC"><span class="STYLE2">移动电话</span></td>
    <td width="80"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">总收入</span></td>
    <td width="80"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">所得税</span></td>
    <td width="80"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">累积所得</span></td>
	<td width="140"  align="center" bgcolor="#CCFFCC"><span class="STYLE2">查看</span></td>
  </tr>
  <?php 
     if($member_no=="全国" or $member_no==""){
	$sql=mysql_query("select * from coumoney where starttime='".$starttime."' and endtime='".$endtime."' order by countmoney desc limit 100");
	 }else{
    $sql=mysql_query("select * from coumoney where starttime='".$starttime."' and endtime='".$endtime."' and u_address='".$member_no."' order by countmoney desc limit 10");}
	 while($result=mysql_fetch_array($sql)){
	?>
 <tr>
    <td width="76" align="center"><span class="STYLE2"><?php echo $result[l_name]?></span></td>
    <td width="76" align="center"><span class="STYLE2"><?php echo $result[u_name]?></span></td>
 	<td width="76"  align="center"><span class="STYLE2"><?php echo $result[r_rgeinos]?></span></td>
    <td width="100"  align="center"><span class="STYLE2"><?php echo $result[u_address]?></span></td>
    <td width="80" align="center"><span class="STYLE2"><?php echo $result[u_modie]?></span></td>
    <td width="80"  align="center"><span class="STYLE2"><?php echo $result[countmoney]?></span></td>
    <td width="80"  align="center"><span class="STYLE2"><?php echo $result[income_tax]?></span></td>
    <td width="80"  align="center"><span class="STYLE2"><?php echo $result[mymoney]?></span></td>
	<td width="140"  align="center" bgcolor="#CCFFCC"><span class="STYLE2"><a href="../users/performance/<?php echo $result[id];?>">个人业绩</a>┋<a href="../users/network/<?php echo $result[id];?>">会员网络</a></span></td>
  </tr>
    <?php
  };
  ?>
</table>
</body>
</html>
