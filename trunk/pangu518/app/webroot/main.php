<?php
	session_start();
	require_once("db-settings.php");

	$strTitle_GSDT = "select id from categories where category_name = '公司动态' ";
	$stmtTitle_GSDT = mysql_query($strTitle_GSDT);
	$arrTitle_GSDT = mysql_fetch_array($stmtTitle_GSDT);
	$Title_GSDT_ID = $arrTitle_GSDT[0];

	$strTitle_JJZX = "select id from categories where category_name = '经济资讯' ";
	$stmtTitle_JJZX = mysql_query($strTitle_JJZX);
	$arrTitle_JJZX = mysql_fetch_array($stmtTitle_JJZX);
	$Title_JJZX_ID = $arrTitle_JJZX[0];

	$strTitle_XFDW = "select id from categories where category_name = '消费单位推荐' ";
	$stmtTitle_XFDW = mysql_query($strTitle_XFDW);
	$arrTitle_XFDW = mysql_fetch_array($stmtTitle_XFDW);
	$Title_XFDW_ID = $arrTitle_XFDW[0];

	$strTitle_GZZ = "select id from categories where category_name = '推荐工作站' ";
	$stmtTitle_GZZ = mysql_query($strTitle_GZZ);
	$arrTitle_GZZ = mysql_fetch_array($stmtTitle_GZZ);
	$Title_GZZ_ID = $arrTitle_GZZ[0];

	$strTitle_FHJG = "select id from categories where category_name = '分红结果' ";
	$stmtTitle_FHJG = mysql_query($strTitle_FHJG);
	$arrTitle_FHJG = mysql_fetch_array($stmtTitle_FHJG);
	$Title_FHJG_ID = $arrTitle_FHJG[0];
?>
<HEAD>
<TITLE>盘古消费财富网</TITLE>
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body >
<?php	include("header.php");?>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center height=37 style="border:1px solid #cccccc;margin-top:5px;">
<tr>
  <td width=129><img src="images/index_title_01.jpg"></td>
  <td style="padding-left:10px;padding-right:10px;">
  <?php
	$strFHJG = "select a.post_title,a.post_content from posts a,categories b  where a.category_id=b.id and b.id = $Title_FHJG_ID and a.post_status = 'publish' order by created desc limit 1";
	$stmtFHJG = mysql_query($strFHJG);
	while($arrFHJG = mysql_fetch_array($stmtFHJG)) {  
  ?>
	  <marquee direction="left" onmouseout=this.start() onmouseover=this.stop() scrollAmount=3 >
		<b><?=$arrFHJG[0]?></b>&nbsp;&nbsp;&nbsp;&nbsp;<?=$arrFHJG[1]?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"> >>更多</a>
	  </marquee>
  <?php	}?>
  </td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center style="border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;margin-top:2px;padding-top:1px;padding-bottom:1px">
<tr>
  <td><img src="images/ad1.jpg"></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center style="margin-top:2px;">
<tr>
  <td width=275 style="border:1px solid #cccccc;padding:1px" valign=>
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td height=34 background="images/index_title_02_bg.jpg"><img src="images/index_title_02.jpg"></td>
  </tr>
  <tr>
  <form  method=post action="login.php" name="loginForm" id="loginForm" >
    <td style="padding:10px" align=center>

<?php	if($_SESSION["osLGflag"] == "bitbee") {?>

	<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		  <td height=30 colspan="2" align="center">欢迎您再次访问盘古消费财富网！</td>
		</tr>
		<tr>
		  <td height=30>用户名:</td>
		  <td align="left"><?=$_SESSION["osUsername"]?></td>
		</tr>
		<tr>
		  <td height=30>级&nbsp;&nbsp;别:</td>
		  <td align="left">普通会员</td>
		</tr>
		<tr>
		  <td height=30 colspan="2" align="right" valign="bottom"><a href="logout.php">退出登录</a></td>
		</tr>
	</table>

<?php	}else {?>		

	<INPUT TYPE="hidden" name="SafeCode" value="<?=$_SESSION['SafeCode']?>">
	<table border=0 cellpadding=0 cellspacing=0>
		<tr>
		  <td height=30>用户名:</td>
		  <td><input name="username" type="text" id="username" style="border:1px solid #999999;width:140px;height:19px;"></td>
		</tr>
		<tr>
		  <td height=30>密码:</td>
		  <td><input name="password" type="password" id="password" style="border:1px solid #999999;width:140px;height:19px;"></td>
		</tr>
		<tr>
		  <td height=30>验证码:</td>
		  <td align=left>
			<input type="text" style="border:1px solid #999999;width:80px;height:19px;" maxlength="4">
			&nbsp;<img src="safecode.php" width=40 height=19 align="absbottom"></td>
		</tr>
	</table>
	<table border=0 cellpadding=0 cellspacing=0 style="margin-top:5px;">
	<tr>
	  <td><input type="image" src="images/button_login.gif"></td>
	  <td width=20></td>
	  <td><input type="reset" style="width:81px;height:22px;border:0;background:url(images/button_reset.gif)" value=""></td>
	</tr>
	<tr>
	  <td height=30><a href="register.php">注册</a></td>
	  <td width=20></td>
	  <td><a href="#">忘记密码?</a></td>
	</tr>
	</table>
<?php	}?>

	</td>
   </form>
  </tr>
  </table>
  </td>
  <td width=7></td>
  <td width=355 style="border:1px solid #cccccc;padding:1px" valign=top>
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td background="images/index_title_03_bg.jpg" height=27>
	<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr>
	  <td align=left><img src="images/index_title_03.jpg"></td>
	  <td align=right style="padding-right:10px">
		<a href="news.php?type=<?=$Title_GSDT_ID?>"><img src="images/more.jpg" border="0"></a>
	  </td>
	</tr>
	</table>
	</td>
  </tr>
  <tr>
    <td style="padding:2px 10px 4px 10px;">
	<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<?php
		$strGSDT = "select a.id,a.post_title from posts a,categories b  where a.category_id=b.id and b.id = $Title_GSDT_ID and a.post_status = 'publish' order by created desc limit 7";
		$stmtGSDT = mysql_query($strGSDT);
		while($arrGSDT = mysql_fetch_array($stmtGSDT)) {
	?>
		<tr>
			<td height=23>
				·<a href="javascript:;"><span onClick = "javascript:window.open('view.php?id=<?=$arrGSDT[0]?>&type=<?=$Title_GSDT_ID?>','PG','scrollbars=auto,width=420,height=300')"><?=$arrGSDT[1]?></span></a></td>
		</tr>
		<tr>
			<td height=1 background='images/point.jpg'></td>
		</tr>			

	<?php	}?>
	</table>
	</td>
  </tr>
  </table>
  </td>
  <td width=6></td>
  <td width=257>
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td style="border:1px solid #cccccc"><img src="images/ad2.jpg"></td>
  </tr>
  <tr>
    <td height=3></td>
  </tr>
  <tr>
    <td style="border:1px solid #cccccc"><img src="images/ad2.jpg"></td>
  </tr>
  <tr>
    <td height=3></td>
  </tr>
  <tr>
    <td style="border:1px solid #cccccc"><img src="images/ad2.jpg"></td>
  </tr>
  </table>
  </td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center style="margin-top:4px">
<tr>
  <td><img src="images/index_title_04.jpg"></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center height=170 style="border-bottom:1px solid #cccccc;margin-top:3px">
<tr>
  <td style="padding-left:5px;padding-right:5px">
    <table border=0 cellpadding=0 cellspacing="0" width=100%>
	<tr>
	<?php
		$strXFDW = "select a.id,a.post_title from posts a,categories b  where a.category_id=b.id and b.id = $Title_XFDW_ID and a.post_status = 'publish' order by created desc limit 5";
		$stmtXFDW = mysql_query($strXFDW);
		while($arrXFDW = mysql_fetch_array($stmtXFDW)) {
	?>
		  <td width=173>
		  <table border=0 cellpadding=0 cellspacing=0 width=100%>
		  <tr>
			<td style="border:1px solid #cccccc" align=center height=138><img src="images/test_01.jpg"></td>
		  </tr>
		   <tr>
			<td style="border-left:1px solid #cccccc;border-right:1px solid #cccccc;border-bottom:1px solid #cccccc" align=center height=20>
				<a href="javascript:;"><span onClick = "javascript:window.open('view.php?id=<?=$arrXFDW[0]?>&type=<?=$Title_XFDW_ID?>','PG','scrollbars=auto,width=420,height=300')"><?=$arrXFDW[1]?></span></a>			
			</td>
		  </tr>
		  </table>
		  </td>
		  <td></td>
	<?php	}?>

	  </td>
	</tr>
	</table>
  </td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center style="margin-top:4px">
<tr>
  <td width=275 valign=top>
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td height=26 width=5><img src="images/index_media_top_01.jpg"></td>
	<td background="images/index_media_top_02.jpg"><img src="images/index_title_05.jpg"></td>
	<td width=10><img src="images/index_media_top_03.jpg"></td>
  </tr>
  <tr>
    <td background="images/index_media_middle_left.jpg"></td>
	<td align=center style="padding-top:5px"><object id="player" height="195" width="258" classid="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6"> 
<param NAME="AutoStart" VALUE="0"> 
<!--是否自动播放--> 
<param NAME="Balance" VALUE="-1"> 
<!--调整左右声道平衡,同上面旧播放器代码--> 
<param name="enabled" value="-1"> 
<!--播放器是否可人为控制--> 
<param NAME="EnableContextMenu" VALUE="1"> 
<!--是否启用上下文菜单--> 
<param NAME="url" value="videos/ringin.wav"> 
<!--播放的文件地址--> 
<param NAME="PlayCount" VALUE="1"> 
<!--播放次数控制,为整数--> 
<param name="rate" value="1"> 
<!--播放速率控制,1为正常,允许小数,1.0-2.0--> 
<param name="currentPosition" value="0"> 
<!--控件设置:当前位置--> 
<param name="currentMarker" value="0"> 
<!--控件设置:当前标记--> 
<param name="defaultFrame" value=""> 
<!--显示默认框架--> 
<param name="invokeURLs" value="0"> 
<!--脚本命令设置:是否调用URL--> 
<param name="baseURL" value=""> 
<!--脚本命令设置:被调用的URL--> 
<param name="stretchToFit" value="0"> 
<!--是否按比例伸展--> 
<param name="volume" value="5"> 
<!--默认声音大小0%-100%,50则为50%--> 
<param name="mute" value="0"> 
<!--是否静音--> 
<param name="uiMode" value="mini"> 
<!--播放器显示模式:Full显示全部;mini最简化;None不显示播放控制,只显示视频窗口;invisible全部不显示--> 
<param name="windowlessVideo" value="0"> 
<!--如果是0可以允许全屏,否则只能在窗口中查看--> 
<param name="fullScreen" value="0"> 
<!--开始播放是否自动全屏--> 
<param name="enableErrorDialogs" value="-1"> 
<!--是否启用错误提示报告--> 
<param name="SAMIStyle" value> 
<!--SAMI样式--> 
<param name="SAMILang" value> 
<!--SAMI语言--> 
<param name="SAMIFilename" value> 
<!--字幕ID--> 
</object><br>如不能正常播放，请下载media player


</td>
	<td background="images/index_media_middle_right.jpg"></td>
  </tr>
  <tr>
    <td height=11><img src="images/index_media_bottom_left.jpg"></td>
	<td background="images/index_media_bottom_bg.jpg"></td>
	<td><img src="images/index_media_bottom_right.jpg"></td>
  </tr>
  </table>
  </td>
  <td width=7></td>
  <td width=355 style="border:1px solid #cccccc" valign=top>
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td height=21 background="images/index_title_bg.jpg" style="border-bottom:1px solid #cccccc">
	<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr>
	  <td align=left style="padding-left:10px"><img src="images/index_title_06.jpg"></td>
	  <td align=right style="padding-right:10px"><a href="news.php?type=<?=$Title_JJZX_ID?>"><img src="images/more.jpg" border="0"></a></td>
	</tr>
	</table>
	</td>
  </tr>
  <tr>
    <td class="text">
	<?php
		$strJJZX = "select a.id,a.post_title from posts a,categories b  where a.category_id=b.id and b.id = $Title_JJZX_ID and a.post_status = 'publish' order by created desc limit 10";
		$stmtJJZX = mysql_query($strJJZX);
		while($arrJJZX = mysql_fetch_array($stmtJJZX)) {
	?>
			·<a href="javascript:;"><span onClick = "javascript:window.open('view.php?id=<?=$arrJJZX[0]?>&type=<?=$Title_JJZX_ID?>','PG','scrollbars=auto,width=420,height=300')"><?=$arrJJZX[1]?></span></a><br>
	<?php	}?>
	</td>
  </tr>
  </table>
  </td>
  <td width=6 height="265"></td>
  <td width=257 valign=top>
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td style="border:1px solid #cccccc"><img src="images/ad3.jpg"></td>
  </tr>
  <tr>
    <td height=7></td>
  </tr>
  <tr>
    <td style="border:1px solid #cccccc"><img src="images/ad3.jpg"></td>
  </tr>
  <tr>
    <td height=6></td>
  </tr>
  <tr>
    <td style="border:1px solid #cccccc"><img src="images/ad3.jpg"></td>
  </tr>
  </table>
  </td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center style="margin-top:4px">
<tr>
  <td width=275 valign=top style="border:1px solid #cccccc;border-top:0px">
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td height=21 background="images/index_media_top_02.jpg" style="border-bottom:1px solid #cccccc">
	<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr>
	  <td align=left style="padding-left:10px"><img src="images/index_title_07.jpg"></td>
	  <td align=right style="padding-right:10px"><a href="news.php?type=<?=$Title_GZZ_ID?>"><img src="images/more.jpg" border="0"></a></td>
	</tr>
	</table>
	</td>
  </tr>
  <tr>
    <td class="text">
	<?php
		$strGZZ = "select a.id,a.post_title from posts a,categories b  where a.category_id=b.id and b.id = $Title_GZZ_ID and a.post_status = 'publish' order by created desc limit 11";
		$stmtGZZ = mysql_query($strGZZ);
		while($arrGZZ = mysql_fetch_array($stmtGZZ)) {
	?>
			·<a href="javascript:;"><span onClick = "javascript:window.open('view.php?id=<?=$arrGZZ[0]?>&type=<?=$Title_GZZ_ID?>','PG','scrollbars=auto,width=420,height=300')"><?=$arrGZZ[1]?></span></a><br>
	<?php	}?>
	</td>
  </tr>
  </table>
  </td>
  <td width=7></td>
  <td width=355 valign=top style="border:1px solid #cccccc">
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td height=21 background="images/index_title_bg.jpg" style="border-bottom:1px solid #cccccc">
	<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr>
	  <td align=left style="padding-left:10px"><img src="images/index_title_08.jpg"></td>
	  <td align=right style="padding-right:10px"><a href="forum.php"><img src="images/more.jpg" border="0"></a></td>
	</tr>
	</table>
	</td>
  </tr>
  <tr>
    <td class="text">·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	·<a href="#">我公司再与中国科工航天集团提供新产品</a><br>
	</td>
  </tr>
  </table>
  </td>
  <td width=6></td>
  <td width=257 valign=top>
  <table border=0 cellpadding=0 cellspacing=0 width=100% style="border:1px solid #cccccc">
  <tr>
    <td height=21 background="images/index_title_bg.jpg" style="border-bottom:1px solid #cccccc">
	<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<tr>
	  <td align=left style="padding-left:10px"><img src="images/index_title_09.jpg"></td>
	  <td align=right style="padding-right:10px"></td>
	</tr>
	</table>
	</td>
  </tr>
  <tr>
    <td align=center><a href="news.php?type=<?=$Title_GZZ_ID?>"><img src="images/test02.jpg" border="0"></a> </td>
  </tr>
  <tr>
    <td style="border-top:1px solid #cccccc"><img src="images/ad4.jpg"></td>
  </tr>
  </table>
  </td>
</tr>
</table>

<table border=0 cellpadding=0 cellspacing=0 width=900 align=center style="border-top:1px solid #cccccc;border-bottom:1px solid #cccccc;margin-top:4px">
<tr>
  <td><img src="images/ad5.jpg"></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center style="margin-top:4px">
<tr>
  <td><img src="images/index_title_10.jpg"></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=900 align=center style="border:1px solid #cccccc">
<tr>
  <td width=30px style="border-right:1px solid #cccccc;padding:5px" align=center>
  <a href="#">申<br>请<br>友<br>情<br>链<br>接</a>
  </td>
  <td style="padding:5px" valign=top>
  <table border=0 cellpadding=0 cellspacing=0 width=100%>
  <tr>
    <td align=center><img src="images/test_02.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
  </tr>
  <tr>
    <td height=10></td>
  </tr>
  <tr>
    <td align=center><img src="images/test_02.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
	<td align=center><img src="images/test_03.jpg" style="border:1px solid #cccccc"></td>
  </tr>
  </table>
  </td>
</tr>
</table>
<?php	include("footer.php");?>
</body>
</html>
