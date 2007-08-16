<!--
将代码放到新增代金券生成列表后的页面里面，然后每次生成后会自动调取test.php的程序来后来生成
暂时在test.php最后面有输出，用于测试，看有无生成成功，最后去掉即可
-->
<script language="javascript" src="ajaxsack.js"></script>
<script language="javascript">

window.onload=getfunction;
function getfunction(){
	showdialog2('objadd2club');
	addbook();
	return false;
}
function addbook(){
var ajaxfile='test.php';
	var ajaxlogin = new sack(ajaxfile);
	if ( ajaxlogin.failed ) {
		alert("Some error occured!");
		return false;
	}
	var ajaxres=document.getElementById('objadd2club');
	//ajaxres.innerHTML='正在请求中。。。。。';
	//alert(bookid);
	ajaxlogin.method = 'GET';

	ajaxlogin.onLoading = function() {};
	ajaxlogin.onLoaded = function() {};
	ajaxlogin.onInteractive = function() {};
	ajaxlogin.onCompletion = function() {  addbookresult(ajaxlogin,ajaxres); };
	ajaxlogin.runAJAX();
}
function  addbookresult(ajaxlogin,ajaxres){
	//alert(ajaxlogin.response);
	ajaxres.innerHTML = ajaxlogin.response;
}
function showdialog2(id) {
	var obj = document.getElementById(id);
	var myTop =0;
	if( typeof( window.scrollTop ) == 'number' ) {
	//Non-IE
	   myTop = window.scrollTop;
	} else if( document.documentElement &&
		( document.documentElement.scrollWidth || document.documentElement.scrollHeight ) ) {
		//IE 6+ in 'standards compliant mode'
		myTop = document.documentElement.scrollTop;
	} else if( document.body && ( document.body.scrollWidth || document.body.scrollHeight ) ) {
	//IE 4 compatible
		myTop = document.body.scrollTop;
	}
	obj.style.top = myTop + 280 +'px';
	obj.style.display = 'block';
}
</script>
<div id="objadd2club"></div>