<!--<img src="img_www/jz-0815-90x280.gif" alt="" width="90" height="280">-->

<script>

var online= new Array();

if (!document.layers)

document.write('<div id="divStayTopLeft" style="position:absolute">')

</script>

<layer id="divStayTopLeft">

<table border="0" width="90" cellspacing="0" cellpadding="0">

<tr><td width="90"><img border=0 src= http://imis.qq.com/images/wpa/images/kefu_up.gif></td></tr>

<script src="http://webpresence.qq.com/getonline?Type=1&18700132:"></script>

<tr><td valign=middle  background=http://imis.qq.com/images/wpa/images/kefu_middle.gif>

<script>

if (online[0]==0)

document.write("&nbsp;&nbsp;&nbsp;&nbsp;<img src= http://imis.qq.com/images/wpa/images/QQoffline.gif border=0 align=middle>&nbsp;&nbsp;<a class='qqb' target=blank href='http://wpa.qq.com/msgrd?V=1&Uin=592554822&Site=在线咨询&Menu=no' title='客服不在线，请留言'>客服1</a><br>&nbsp;&nbsp;&nbsp;&nbsp;<img src= http://imis.qq.com/images/wpa/images/QQoffline.gif border=0 align=middle>&nbsp;&nbsp;<a class='qqb' target=blank href='http://wpa.qq.com/msgrd?V=1&Uin=756888640&Site=在线咨询&Menu=no' title='客服不在线，请留言'>客服2</a><br>&nbsp;&nbsp;&nbsp;&nbsp;<img src= http://imis.qq.com/images/wpa/images/QQoffline.gif border=0 align=middle>&nbsp;&nbsp;<a class='qqb' target=blank href='http://wpa.qq.com/msgrd?V=1&Uin=506680731&Site=在线咨询&Menu=no' title='客服不在线，请留言'>客服3</a>");

else

document.write("&nbsp;&nbsp;&nbsp;&nbsp;<img src= http://imis.qq.com/images/wpa/images/QQonline.gif border=0 align=middle>&nbsp;&nbsp;<a class='qqa' target=blank href='http://wpa.qq.com/msgrd?V=1&Uin=592554822&Site=在线咨询&Menu=no' title='在线即时交谈'>客服1</a><br>&nbsp;&nbsp;&nbsp;&nbsp;<img src= http://imis.qq.com/images/wpa/images/QQonline.gif border=0 align=middle>&nbsp;&nbsp;<a class='qqa' target=blank href='http://wpa.qq.com/msgrd?V=1&Uin=756888640&Site=在线咨询&Menu=no' title='在线即时交谈'>客服2</a><br>&nbsp;&nbsp;&nbsp;&nbsp;<img src= http://imis.qq.com/images/wpa/images/QQonline.gif border=0 align=middle>&nbsp;&nbsp;<a class='qqa' target=blank href='http://wpa.qq.com/msgrd?V=1&Uin=506680731&Site=在线咨询&Menu=no' title='在线即时交谈'>客服3</a>");

</script >

</td></tr>

<tr><td width="110"><img border=0 src= http://imis.qq.com/images/wpa/images/kefu_down.gif></td></tr>

</table>

</layer>

<script type="text/javascript">

//Enter "frombottom" or "fromtop"

var verticalpos="frombottom"

if (!document.layers)

document.write('</div>')

function JSFX_FloatTopDiv()

{

       var startX =892,

       startY = 600;

       var ns = (navigator.appName.indexOf("Netscape") != -1);

       var d = document;

       function ml(id)

       {

              var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];

              if(d.layers)el.style=el;

              el.sP=function(x,y){this.style.left=x;this.style.top=y;};

              el.x = startX;

              if (verticalpos=="fromtop")

              el.y = startY;

              else{

              el.y = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;

              el.y -= startY;

              }

              return el;

       }

       window.stayTopLeft=function()

       {

              if (verticalpos=="fromtop"){

              var pY = ns ? pageYOffset : document.body.scrollTop;

              ftlObj.y += (pY + startY - ftlObj.y)/8;

              }

              else{

              var pY = ns ? pageYOffset + innerHeight : document.body.scrollTop + document.body.clientHeight;

              ftlObj.y += (pY - startY - ftlObj.y)/8;

              }

              ftlObj.sP(ftlObj.x, ftlObj.y);

              setTimeout("stayTopLeft()", 10);

       }

       ftlObj = ml("divStayTopLeft");

       stayTopLeft();

}

JSFX_FloatTopDiv();

</script>
