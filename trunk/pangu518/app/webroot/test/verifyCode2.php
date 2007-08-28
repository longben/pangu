<?php
// =========== �ļ�˵�� ==============//
// �ļ�˵����PHP��֤��(PHPУ����)����
// ================================//
    //����ַ������ӣ����Ի�����ĸ������Ӣ���ַ�

    $glbVerifySeed = "1234567890";
    main();
        
    function main() {
//        session_start();
        
        $verifyCode = getRandomCode();
        $_SESSION["verifyCode"] = $verifyCode;
        $imgWidth = $_REQUEST["width"];
        $imgHeight = $_REQUEST["height"];
        $imgFont = $_REQUEST["font"];
        
        if($imgWidth == "") $imgWidth = 50;
        if($imgHeight == "") $imgHeight = 19;
        if($imgFont == "") $imgFont = 6;
        doOutputImg($verifyCode, $imgWidth, $imgHeight, $imgFont);
    }
    
    //��ȡ��������ַ���
    function getRandomCode($length=4) {
        global $glbVerifySeed;
        
        $bgnIdx = 0;
        $endIdx = strlen($glbVerifySeed)-1;
        
        $code = "";
        for($i=0; $i<$length; $i++) {
            $curPos = rand($bgnIdx, $endIdx);
            $code .= substr($glbVerifySeed, $curPos, 1);
        }
        
        return $code;
    }

    
    //���У����ͼ��
    function doOutputImg($string, $imgWidth, $imgHeight, $imgFont,
        $imgFgColorArr=array(0,0,0), $imgBgColorArr=array(255,255,255)) {
        $image = imagecreatetruecolor($imgWidth, $imgHeight);

        //�ð�ɫ�����Ӻ�ɫ�߿򻭸�����
        $backColor = imagecolorallocate($image, 255, 255, 255);
        $borderColor = imagecolorallocate($image, 0, 0, 0);
        imagefilledrectangle($image, 0, 0, $imgWidth - 1, $imgHeight - 1, $backColor);
        imagerectangle($image, 0, 0, $imgWidth - 1, $imgHeight - 1, $borderColor);

        $imgFgColor = imagecolorallocate ($image, $imgFgColorArr[0], $imgFgColorArr[1], $imgFgColorArr[2]);
        doDrawStr($image, $string, $imgFgColor, $imgFont);
        doPollute($image, 64);

        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    //����У����
    function doDrawStr($image, $string, $color, $imgFont) {
        $imgWidth = imagesx($image);
        $imgHeight = imagesy($image);
        
        $count = strlen($string);
        $xpace = ($imgWidth/$count);
        
        $x = ($xpace-6)/2;
        $y = ($imgHeight/2-8);
        for ($p = 0; $p<$count;  $p ++) {
            $xoff = rand(-2, +2);
            $yoff = rand(-2, +2);
            $curChar = substr($string, $p, 1);
            imagestring($image, $imgFont, $x+$xoff, $y+$yoff, $curChar, $color);
            $x += $xpace;
        }

        return 0;
    }
    
    //����һЩ�ӵ�
    function doPollute($image, $times) {   
        $imgWidth = imagesx($image);
        $imgHeight = imagesy($image);
        for($j=0; $j<$times; $j++) {
            $x = rand(0, $imgWidth);
            $y = rand(0, $imgHeight);
            
            $color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
            imagesetpixel($image, $x, $y, $color);
        }
    }
?>