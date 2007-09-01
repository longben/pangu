<?php
	require_once("db-settings.php");

	$strTop3 = "select id,merchant_name,industry_id from merchants where status = 1 order by id desc limit 3";
	$stmtTop3 = mysql_query($strTop3);

	$strIndustry = "select id,industry_name from industries where flag = 1 order by id asc limit 6";
	$stmtIndustry = mysql_query($strIndustry);

?>
<html>
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/style.css" rel="stylesheet" type="text/css">
<TITLE>盘古消费财富</TITLE>
<style type="text/css">
<!--
.STYLE1 {
	color: #000033;
	font-weight: bold;
	font-size: 14px;
}
-->
</style>
</head>

<body topmargin="0" leftmargin="0">
<?php	include("header.php");?>
<table cellpadding="0" cellspacing="0" width="900" align="center">
	<tr>
		<td width="197" height="73" valign="top" rowspan="2">
		<img border="0" src="img_www/shangjiazhuanqu.jpg" width="197" height="73"></td>
		<td width="612" height="35" valign="top" background="img_www/background4.jpg">&nbsp;</td>
		<td width="91" valign="top" rowspan="5"><?php include("right_gg.php");?></td>
	</tr>
	<tr>
		<td width="612" height="38" valign="top" background="img_www/background5.jpg">&nbsp;</td>
	</tr>
	<tr>
		<td height="2" colspan="2" valign="top">&nbsp;</td>
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
		<td rowspan="2" valign="top">
		  <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>

			<?php	while($arrTop3 = mysql_fetch_array($stmtTop3)) {?>
              <td align="center" valign="top">
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center"><font face="黑体" color="#333333"><img src="img_www/VIPUSEP.JPG" alt=" " width="132" height="87" border="0" /></font></td>
                </tr>
                <tr>
                  <td height="30" align="center" valign="bottom"><font size="2">
				  <a href="view_merchant.php?id=<?=$arrTop3[0]?>&industry_id=<?=$arrTop3[2]?>"><?=$arrTop3[1]?></a></font></td>
                </tr>
              </table>
			  </td>
			<?php	}?>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>

			<?php
				$i = 1;
				while($arrIndustry = mysql_fetch_array($stmtIndustry)) {
					if($i == 1 || $i == 4) {
						echo("<tr>");
					}
			?>


              <td valign="top">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="25">
					&nbsp;<img src="img_www/vipusep01.JPG" alt=" " width="13" height="14" border="0" /><span class="title_small"><?=$arrIndustry[1]?></span></td>
                </tr>
                <tr>
                  <td>
				  <table border="1" width="204" cellspacing="0" cellpadding="0" id="table4" height="85" bordercolordark="#FFFFFF">
                    <tr>
                      <td align="left" valign="top" height="18" bgcolor="#808080"><p align="center">　</p></td>
                    </tr>
					<?php
						$strMerchant = "select id,merchant_name,industry_id from merchants where status = 1 and industry_id = ".$arrIndustry[0]." order by id desc limit 5";
						$stmtMerchant = mysql_query($strMerchant);
						$j = 1;
						while($arrMerchant = mysql_fetch_array($stmtMerchant)) {
							if($j == 2 || $j == 4) {
								$bgcolor = "#C0C0C0";
							}else {
								$bgcolor = "";
							}
					?>
                    <tr>
                      <td align="center" valign="middle" bgcolor="<?=$bgcolor?>"><font size="2">
					  <a href="view_merchant.php?id=<?=$arrMerchant[0]?>&industry_id=<?=$arrMerchant[2]?>"><?=$arrMerchant[1]?></a>
					</font></td>
                    </tr>
					<?php
							$j++;
						}
					?>

                  </table>
				  </td>
                </tr>
              </table>
			  </td>

			<?php	
					if($i == 3 || $i == 6) {
						echo("
							</tr>
							<tr>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							  <td>&nbsp;</td>
							</tr>						
						");
					}

					$i++;
				}
			?>

          </table>
		  <p><br>
</p></td>
	</tr>
	<tr>
		<td width="197" valign="top" background="img_www/background2.jpg">&nbsp;</td>
	</tr>
	<tr>
		<td width="197" height="20" valign="top" background="img_www/background1.jpg">&nbsp;</td>
		<td width="612" height="20" valign="top" background="img_www/background3.jpg">&nbsp;</td>
		<td width="91" height="20" valign="top" background="img_www/top8.jpg">&nbsp;</td>
	</tr>
</table>
<?php	include("footer.php");?>

</body>

</html>
