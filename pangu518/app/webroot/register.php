<?php
	require_once('db-settings.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>中国消费财富网</title>
<link href="css/pg.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" leftmargin="0">
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
  <td height=4 bgcolor="#31659C"></td>
</tr>
<tr>
  <td height=1 bgcolor="#ffffff"></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing="0" width=100% height="25" style="background:#EBEBEB;border-bottom:1px solid #cccccc">
<tr>
  <td style="padding-left:20px;" width=26 align="left"><img src="/img/website/top_smllogo1.gif"></td>
  <td align=left style="padding-top:5px">中国消费财富网</td>
  <td align="right" style="padding-right:20px;color:#990000">
		今天是 
			<script language=JavaScript>        
				today=new Date();
				function initArray(){
					this.length=initArray.arguments.length;
					for(var i=0;i<this.length;i++)
					this[i+1]=initArray.arguments[i];
				}
				var d=new initArray(
				"星期日",
				"星期一",
				"星期二",
				"星期三",
				"星期四",
				"星期五",
				"星期六");
				document.write(
				"<font color=#990000 style='font-size:9pt;'> ",
				today.getYear(),"年",
				today.getMonth()+1,"月",
				today.getDate(),"日   ",
				d[today.getDay()+1],
				"</font>" );
			</script>
  </td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=976 align=center height=108>
<tr>
  <td align=left width=144><img src="/img/website/top_logo.jpg"></td>
  <td align=center><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="722" height="80">
    <param name="movie" value="/img/ad/1.swf">
    <param name="quality" value="high">
    <embed src="/img/ad/1.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="722" height="80"></embed>
  </object></td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=976 align=center height=32 background="/img/website/menu_bg.jpg" style="margin-bottom:4px">
<tr>
  <td width=3><img src="/img/website/menu_left.jpg"></td>
  <td style="font-size:14px;font-weight:bold;color:#ffffff">
  <table width=100% height=32 border=0 cellpadding=0 cellspacing=0>
  <tr>
    <td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'">
	<a href="/" class="whitelink">首页</a>
	</td>
	<td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'">
	<a href="/homes/news_index" class="whitelink">网站新闻</a>
	</td>
	<td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'">
	<a href="/homes/consumer_market_index" class="whitelink">消费市场</a>
	</td>
	<td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'">
	<a href="/homes/fortune_index" class="whitelink">财富资讯</a>
	</td>
	<td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'">
	 <a href="/homes/cs_center_index" class="whitelink">客服中心</a>
	</td>
	<td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'">
	 <a href="/homes/legal_index" class="whitelink">政策法规</a>
	</td>
	<td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'">
	 <a href="/homes/merchants_index" class="whitelink">合作商家</a>
	</td>
	<td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'">
	 <a href="/homes/workstations_index" class="whitelink">服务机构</a>
	</td>
	<td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'">
	<a href="/homes/cooperation_index" class="whitelink">合作机会</a>
	</td>
	<td>&nbsp;</td>
	<td width=78 align=center style="font-size:14px;font-weight:bold;color:#ffffff" onMouseOver="this.style.background='url(/img/website/menu_over_bg.jpg)'" onMouseOut="this.style.background='url()'"><a href="mailto:sichuanpangu@126.com" class="whitelink">联系我们</a></td>
	<td>&nbsp;</td>
  </tr>
  </table>
  </td>
  <td width=3><img src="/img/website/menu_right.jpg"></td>
</tr>
</table>





<table cellpadding="0" cellspacing="0" width="90%" align="center">
	<tr>
		<td  valign="top" align="center"><form name="form_pg" method=post action="register_do.php" onSubmit="return check()">
		  <table cellpadding="3" cellspacing="1" bgcolor="#C0C0C0" id="table5" width="800">
            <!-- MSTableType="layout" -->
            <tr>
              <td height="35" colspan="4" align="center" valign="middle" bgcolor="#FFFFFF"><span class="STYLE2">会 员 注 册</span></td>
            </tr>
            <tr>
              <td width="109" height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-family: 宋体; font-size: 9pt">省份</span><span style="font-size: 9.0pt; font-family: 宋体">：</span></td>
              <td width="269" align="left" valign="middle" bgcolor="#FFFFFF"><select size="1" name="coupon">
                  <?php
											$sql = "select id,region_name from regions where id like '__0000'";
											$stmt = mysql_query($sql);
											while($arr= mysql_fetch_array($stmt)){
												echo("<option value='".$arr[0]."'>".$arr[1]."</option>");
											}
										?>
                </select>
                  <span class="STYLE3">*</span> </td>
              <td width="142" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">登录名：</span></td>
              <td width="225" align="left" valign="middle" bgcolor="#FFFFFF"><input name="login_name" type="text" id="login_name" size="15" maxlength="15">
                <span class="STYLE3">*</span></td>
            </tr>

            <tr>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">密码：</span></td>
              <td align="left" valign="middle" bgcolor="#FFFFFF"><input name="password" type="password" id="password" size="15" maxlength="20">
                  <span class="STYLE3">*</span></td>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">确认密码：</span></td>
              <td align="left" valign="middle" bgcolor="#FFFFFF"><input name="password2" type="password" id="password2" size="15" maxlength="20">
                  <span class="STYLE3">*</span></td>
            </tr>

            <tr>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体"> 真实姓名：</span></td>
              <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="user_name" type="text" id="user_name" size="15" maxlength="10">
                  <span class="STYLE3">*</span></td>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">性别：</span></td>
              <td valign="middle" bgcolor="#FFFFFF" align="left"><label>
                <select name="sex" id="sex">
                  <option value="1" selected>男</option>
                  <option value="2">女</option>
                </select>
                </label>
                  <span class="STYLE3">*</span></td>
            </tr>

            <tr>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体"> 身份证号码：</span></td>
              <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="cert_number" type="text" id="cert_number" size="18" maxlength="18">
                  <span class="STYLE3">*</span></td>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">手机号码：</span></td>
              <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="mobile" type="text" id="mobile" size="15" maxlength="11">
                  <span class="STYLE3">*</span></td>
            </tr>

            <tr>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">办公电话：</span></td>
              <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="office_phone" type="text" id="office_phone" size="15" maxlength="12"></td>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">家庭电话：</span></td>
              <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="home_phone" type="text" id="home_phone" size="15" maxlength="12"></td>
            </tr>

            <tr>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体"> 银行卡号：</span></td>
              <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="accounts" type="text" id="accounts" size="20" maxlength="19">
                  <span class="STYLE3">*</span></td>
              <td height="23" align="left" valign="middle" bgcolor="#FFFFFF"><span style="font-size: 9.0pt; font-family: 宋体">推荐人帐号：</span></td>
              <td valign="middle" bgcolor="#FFFFFF" align="left"><input name="referees" type="text" id="referees" size="15" maxlength="20" value="www7777"></td>
            </tr>

            <tr>
              <td height="40" colspan="4" align="center" valign="middle" bgcolor="#FFFFFF"><input name="image" type="image" src="img_www/vipp02.JPG" width="84" height="25" border="0">              </td>
            </tr>
          </table>
                </form></td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width=976 align=center>
<tr>
  <td align=center style="color:#666666;padding:5px">
  | 关于公司 | 设为首页 | 加入收藏 | 公司邮箱 | 友情链接 | 网站公告 | 管理登录 | <br>  
蜀ICP备 川B2-20070164号  国际域名：www.pangu518.com <br>
 工商经营许可证5101002016468号     邮箱：chinaxfcfw@163.com  <br>
 总部地址：四川省成都市猛追湾街125号4楼　总部电话：028-84385570 028-84385510
  </td>
</tr>
</table>


</body>

</html>


<script language="JavaScript">
<!--
	function check() {
		doc = document.form_pg;

		if(doc.login_name.value==""){
			alert("请输入登录名！");
			doc.login_name.focus();
			return false;
		}

		if(doc.login_name.value.length<3){
			alert("登录名至少3位，请重新输入！");
			doc.login_name.focus();
			return false;
		}

		if(doc.password.value==""){
			alert("请输入密码！");
			doc.password.focus();
			return false;
		}

		if(doc.password.value.length<6){
			alert("密码至少6位，请重新输入！");
			doc.password.focus();
			return false;
		}

		if(doc.password2.value==""){
			alert("请输入确认密码！");
			doc.password2.focus();
			return false;
		}

		if(doc.password.value!=doc.password2.value){
			alert("两次输入的密码不符，请重新输入！");
			doc.password.focus();
			return false;
		}

		if(doc.user_name.value==""){
			alert("请输入真实姓名！");
			doc.user_name.focus();
			return false;
		}

		if(doc.cert_number.value==""){
			alert("请输入身份证号码！");
			doc.cert_number.focus();
			return false;
		}

		if((doc.cert_number.value.length != 15) && (doc.cert_number.value.length != 18)){
			alert("身份证位数不对，请核对重新输入！");
			doc.cert_number.focus();
			return false;
		}

		if(doc.cert_number.value!=''){

			var patrn = /[0-9Xx]$/;
			if(!patrn.test(doc.cert_number.value)){
				alert('身份证号码格式不对！');
				doc.cert_number.focus();
				return false;
			}
		}

		if(doc.mobile.value==""){
			alert("请输入手机号码！");
			doc.mobile.focus();
			return false;
		}

		if((doc.mobile.value.length != 11) || (isNaN(doc.mobile.value))){
			alert("手机号码有误，请重新录入");
			doc.mobile.focus();
			return false;
		}

		if(doc.office_phone.value!=''){

			var patrn=/^0\d{2,3}\-\d{7,8}$/;
			if(!patrn.test(doc.office_phone.value)){
				alert('办公电话格式不对');
				doc.office_phone.focus();
				return false;
			}
		}

		if(doc.home_phone.value!=''){

			var patrn=/^0\d{2,3}\-\d{7,8}$/;
			if(!patrn.test(doc.home_phone.value)){
				alert('家庭电话格式不对');
				doc.home_phone.focus();
				return false;
			}
		}


		if(doc.accounts.value==""){
			alert("请输入邮政储蓄卡号！");
			doc.accounts.focus();
			return false;
		}

		if(doc.accounts.value.length != 19){
			alert("邮政储蓄卡号必须为19位！");
			doc.accounts.focus();
			return false;
		}

		if(isNaN(doc.accounts.value)){
			alert("输入的邮政储蓄卡号有误，请重新输入！");
			doc.accounts.focus();
			return false;
		}

	}
//-->
</script>