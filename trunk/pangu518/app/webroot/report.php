<?php
	require_once('db-settings.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>报表查询</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<br><div align="left" class="title">当月数据统计报表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:window.print()" class="text">【打印报表】</a></div>
<!-- 选择45×25CM的纸张，横向打印  -->
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#33FFCC">
  <tr>
    <td colspan="2" rowspan="2" align="center" bgcolor="#CCFFCC" class="title"><?=date('Y')?>年</td>
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
	for($i =1;$i<=date('t');$i++){
?>
  <tr>

  <?php	
		//显示第一列月份，且根据当月的天数判断rowspan
		if($i == 1){
  ?>
    <td rowspan="<?=date('t')?>" align="center" class="title"><?=date('n')?>月</td>
  <?php	}?>

	<!--显示第二列天-->
    <td align="center"><?=$i?></td>

	<!-- 显示会员总数数据 -->
	<?php
		$sql_member_total = " select count(*) from users where to_days(created) = (to_days(now())-".(date('t')-$i).")";	
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
	
			$sql_member_count = "select count(*) from users where region_id = ".$arr_member_sheng[0]." and to_days(created) = (to_days(now())-".(date('t')-$i).")";
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
		$sql_merchant_total = " select count(*) from merchants where to_days(created) = (to_days(now())-".(date('t')-$i).")";	
		$stmt_merchant_total = mysql_query($sql_merchant_total);
		while($arr_merchant_total = mysql_fetch_array($stmt_merchant_total)){
			echo "<td align='center' class='title_small'>$arr_merchant_total[0]</td>";
		}

		$sql_merchant_total_1 = " select count(*) from merchants where to_days(created) = (to_days(now())-".(date('t')-$i).") and status = 1";	
		$stmt_merchant_total_1 = mysql_query($sql_merchant_total_1);
		while($arr_merchant_total_1 = mysql_fetch_array($stmt_merchant_total_1)){
			echo "<td align='center' class='title_small'>$arr_merchant_total_1[0]</td>";
		}

		$sql_merchant_total_9 = " select count(*) from merchants where to_days(created) = (to_days(now())-".(date('t')-$i).") and status = 9";	
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
	
			$sql_merchant_count = "select count(*) from merchants where region_id = ".$arr_merchant_sheng[0]." and to_days(created) = (to_days(now())-".(date('t')-$i).")";
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
		$sql_workstation_total = " select count(*) from workstations where to_days(created) = (to_days(now())-".(date('t')-$i).")";	
		$stmt_workstation_total = mysql_query($sql_workstation_total);
		while($arr_workstation_total = mysql_fetch_array($stmt_workstation_total)){
			echo "<td align='center' class='title_small'>$arr_workstation_total[0]</td>";
		}

		$sql_workstation_total_1 = " select count(*) from workstations where to_days(created) = (to_days(now())-".(date('t')-$i).") and status = 1";	
		$stmt_workstation_total_1 = mysql_query($sql_workstation_total_1);
		while($arr_workstation_total_1 = mysql_fetch_array($stmt_workstation_total_1)){
			echo "<td align='center' class='title_small'>$arr_workstation_total_1[0]</td>";
		}

		$sql_workstation_total_9 = " select count(*) from workstations where to_days(created) = (to_days(now())-".(date('t')-$i).") and status = 9";	
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
	
			$sql_workstation_count = "select count(*) from workstations where region_id = ".$arr_workstation_sheng[0]." and to_days(created) = (to_days(now())-".(date('t')-$i).")";
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
