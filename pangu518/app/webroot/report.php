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


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>报表查询</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
	  <form name="form1" method="post" action="report.php">	
      <td width="350" height="30" valign="middle" class="title_small_new">会员·消费单位·工作站数据统计报表</td>
      <td width="135" valign="middle">【<a href="javascript:window.print()" class="text">打印报表</a>】</td>
      <td width="192" valign="middle" class="title_small_new">
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
      月</td>
      <td width="298" valign="middle">
        <input name="Submit" type="submit" class="backbotton" value="查 询"></td>
	  </form>	  
    </tr>
</table>
</div>
<!-- 选择45×25CM的纸张，横向打印  -->
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#33FFCC">
  <tr>
    <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFCC" class="title"><?=$reportYear?>年</td>
    <td width="70" rowspan="2" align="center" bgcolor="#CCFFCC">新增会员总数</td>
    <td colspan="31" align="center" bgcolor="#CCFFCC">新增会员分省总数</td>
    <td width="140" rowspan="2" align="center" bgcolor="#CCFFCC">新增会员消费单位总数</td>
    <td width="140" rowspan="2" align="center" bgcolor="#CCFFCC">已审核总数</td>
    <td width="140" rowspan="2" align="center" bgcolor="#CCFFCC">未审核总数</td>
    <td colspan="31" align="center" bgcolor="#CCFFCC">新增会员消费单位分省总数</td>
    <td width="87" rowspan="2" align="center" bgcolor="#CCFFCC">新增工作站总数</td>
    <td width="140" rowspan="2" align="center" bgcolor="#CCFFCC">已审核总数</td>
    <td width="140" rowspan="2" align="center" bgcolor="#CCFFCC">未审核总数</td>
    <td colspan="31" align="center" bgcolor="#CCFFCC">新增工作站分省总数</td>
  </tr>
  <tr>

	<?php
		//抬头分别显示会员、单位、工作站31个省
		$sql_member_sheng = "select id,region_name from regions where id like '__0000'";
		$stmt_member_sheng = mysql_query($sql_member_sheng);
		while($arr_member_sheng= mysql_fetch_array($stmt_member_sheng)){
			echo("<td align='center'>$arr_member_sheng[1]</td>");
		}	

		$sql_merchat_sheng = "select id,region_name from regions where id like '__0000'";
		$stmt_merchat_sheng = mysql_query($sql_merchat_sheng);
		while($arr_merchat_sheng= mysql_fetch_array($stmt_merchat_sheng)){
			echo("<td align='center'>$arr_merchat_sheng[1]</td>");
		}	

		$sql_workstation_sheng = "select id,region_name from regions where id like '__0000'";
		$stmt_workstation_sheng = mysql_query($sql_workstation_sheng);
		while($arr_workstation_sheng= mysql_fetch_array($stmt_workstation_sheng)){
			echo("<td align='center'>$arr_workstation_sheng[1]</td>");
		}	
	?>

  </tr>
  
<?php
	//循环当月天数·start
	for($iday =1;$iday<=$reportDays;$iday++){
?>
  <tr>

  <?php	
		//显示第一列月份，且根据当月的天数判断rowspan
		if($iday == 1){
  ?>
    <td rowspan="<?=$reportDays?>" align="center" class="title"><?=$reportMonth?>月</td>
  <?php	}?>

	<!--显示第二列天-->
    <td align="center"><?=$iday?></td>

	<!-- 显示会员总数数据 -->
	<?php
		$sql_member_total = " select count(*) from users where substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday";	
		$stmt_member_total = mysql_query($sql_member_total);
		while($arr_member_total = mysql_fetch_array($stmt_member_total)){
			echo "<td align='center' class='title_small'>$arr_member_total[0]</td>";
		}
	?>

	<!-- 显示会员分省总数数据 -->
	<?php
		$sql_member_sheng = "select id from regions where id like '__0000' ";
		$stmt_member_sheng = mysql_query($sql_member_sheng);
		while($arr_member_sheng= mysql_fetch_array($stmt_member_sheng)){
	
			$sql_member_count = "select count(*) from users where region_id = ".$arr_member_sheng[0]." and substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday";
			$stmt_member_count = mysql_query($sql_member_count);
			while ($arr_member_count = mysql_fetch_array($stmt_member_count)){
				echo "<td align='center'>";
				if($arr_member_count[0] == 0){
					echo "&nbsp;";
				}else{
					echo $arr_member_count[0];
				}
				echo "</td>";
			}
		}	
	?>

	<!-- 显示会员消费单位总数、已审核总数、未审核总数  0无效  1有效  9待审核 -->
	<?php
		$sql_merchant_total = " select count(*) from merchants where substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday";	
		$stmt_merchant_total = mysql_query($sql_merchant_total);
		while($arr_merchant_total = mysql_fetch_array($stmt_merchant_total)){
			echo "<td align='center' class='title_small'>$arr_merchant_total[0]</td>";
		}

		$sql_merchant_total_1 = " select count(*) from merchants where substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday and status = 1";	
		$stmt_merchant_total_1 = mysql_query($sql_merchant_total_1);
		while($arr_merchant_total_1 = mysql_fetch_array($stmt_merchant_total_1)){
			echo "<td align='center' class='title_small'>$arr_merchant_total_1[0]</td>";
		}

		$sql_merchant_total_9 = " select count(*) from merchants where substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday and status = 9";	
		$stmt_merchant_total_9 = mysql_query($sql_merchant_total_9);
		while($arr_merchant_total_9 = mysql_fetch_array($stmt_merchant_total_9)){
			echo "<td align='center' class='title_small'>$arr_merchant_total_9[0]</td>";
		}
	?>

	<!-- 显示会员消费单位分省总数数据 -->
	<?php
		$sql_merchant_sheng = "select id from regions where id like '__0000' ";
		$stmt_merchant_sheng = mysql_query($sql_merchant_sheng);
		while($arr_merchant_sheng= mysql_fetch_array($stmt_merchant_sheng)){
	
			$sql_merchant_count = "select count(*) from merchants where region_id = ".$arr_merchant_sheng[0]." and  substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday";
			$stmt_merchant_count = mysql_query($sql_merchant_count);
			while ($arr_merchant_count = mysql_fetch_array($stmt_merchant_count)){
				echo "<td align='center'>";
				if($arr_merchant_count[0] == 0){
					echo "&nbsp;";
				}else{
					echo $arr_merchant_count[0];
				}
				echo "</td>";
			}
		}	
	?>


	<!-- 显示工作站总数、已审核总数、未审核总数  0无效  1有效  9待审核 -->
	<?php
		$sql_workstation_total = " select count(*) from workstations where substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday";	
		$stmt_workstation_total = mysql_query($sql_workstation_total);
		while($arr_workstation_total = mysql_fetch_array($stmt_workstation_total)){
			echo "<td align='center' class='title_small'>$arr_workstation_total[0]</td>";
		}

		$sql_workstation_total_1 = " select count(*) from workstations where substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday and status = 1";	
		$stmt_workstation_total_1 = mysql_query($sql_workstation_total_1);
		while($arr_workstation_total_1 = mysql_fetch_array($stmt_workstation_total_1)){
			echo "<td align='center' class='title_small'>$arr_workstation_total_1[0]</td>";
		}

		$sql_workstation_total_9 = " select count(*) from workstations where substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday and status = 9";	
		$stmt_workstation_total_9 = mysql_query($sql_workstation_total_9);
		while($arr_workstation_total_9 = mysql_fetch_array($stmt_workstation_total_9)){
			echo "<td align='center' class='title_small'>$arr_workstation_total_9[0]</td>";
		}
	?>


	<!-- 显示工作站分省总数数据 -->
	<?php
		$sql_workstation_sheng = "select id from regions where id like '__0000' ";
		$stmt_workstation_sheng = mysql_query($sql_workstation_sheng);
		while($arr_workstation_sheng= mysql_fetch_array($stmt_workstation_sheng)){
	
			$sql_workstation_count = "select count(*) from workstations where region_id = ".$arr_workstation_sheng[0]." and substring(created,1,4) = '$reportYear' and substring(created,6,2) = '$reportMonth' and substring(created,9,2) = $iday";
			$stmt_workstation_count = mysql_query($sql_workstation_count);
			while ($arr_workstation_count = mysql_fetch_array($stmt_workstation_count)){
				echo "<td align='center'>";
				if($arr_workstation_count[0] == 0){
					echo "&nbsp;";
				}else{
					echo $arr_workstation_count[0];
				}
				echo "</td>";
			}
		}	
	?>


  </tr>
	
<?php
//循环当月天数·end
	}
?>

</table>
</body>
</html>
