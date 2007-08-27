<?PHP
session_start();
session_register("osSafeCode");

$type = 'gif';
$width= 40;
$height= 19;
header("Content-type: image/".$type);
srand((double)microtime()*1000000);
$randval = randStr(4,"");
if($type!='gif' && function_exists('imagecreatetruecolor')){
$im = @imagecreatetruecolor($width,$height);
}else{
$im = @imagecreate($width,$height);
}
$r = Array(225,211,255,223);
$g = Array(225,236,237,215);
$b = Array(225,236,166,125);

$key = rand(0,3);

//$backColor = ImageColorAllocate($im,$r[$key],$g[$key],$b[$key]);//����ɫ�������
$backColor = imagecolorallocate($im, 255, 255, 255);
$borderColor = ImageColorAllocate($im, 0, 0, 0);//�߿�ɫ
$pointColor = ImageColorAllocate($im, 255, 170, 255);//����ɫ


@imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);//����λ��
@imagerectangle($im, 0, 0, $width-1, $height-1, $borderColor); //�߿�λ��
$stringColor = ImageColorAllocate($im, 255,51,153);

for($i=0;$i<=100;$i++){
$pointX = rand(2,$width-2);
$pointY = rand(2,$height-2);
@imagesetpixel($im, $pointX, $pointY, $pointColor);
}

@imagestring($im, 3, 5, 1, $randval, $stringColor);
$ImageFun='Image'.$type;
$ImageFun($im);
@ImageDestroy($im);
$_SESSION['osSafeCode'] = $randval;

//��������ַ���
function randStr($len=4,$format='ALL') {
	switch($format) {
	case 'ALL':
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; 
		break;
	case 'CHAR':
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
		break;
	case 'NUMBER':
		$chars='0123456789'; 
		break;
	default :
		$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		break;
	}
	$string="";
	while(strlen($string)<$len)
	$string.=substr($chars,(mt_rand()%strlen($chars)),1);
	return $string;
}

?>
