<?php
/*
 * @Author: yuk255
 * @Description: 验证码生成函数
 */

/**
 * @description: 
 * @param $x:图片宽度
 * @param $y:图片高度
 * @param $length:生成验证码长度
 * @param $size:验证码文字尺寸（px）
 * @return 
 */
function code($x,$y,$length,$size){

    $img = imagecreatetruecolor($x, $y);
    $white = imagecolorallocate($img, 255, 255, 255);
    imagefill($img, 0, 0, $white);

    /**
     * @description: 背景圆点随机生成
     */
    for ($i = 0; $i < 100; $i++) {
        $color = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
        imagesetpixel($img, rand(0, $x), rand(0, $y), $color);
        imagefilledellipse($img, rand(0, $x), rand(0, $y), 3, 3, $color);
    }

    /**
     * @description: 背景图线条随机生成
     */
    for ($i = 0; $i < 10; $i++) {
        $color = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));
        imageline($img, rand(0, $x), rand(0, $y), rand(0, $x), rand(0, $y), $color);
    }

    /**
     * @description: 验证码生成
     */
    $str = 'abcdefghijkmnpqrstuvwxyz23456789';
    $a = 0;
    $b = $y/2+10;
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $string = $str[rand(0,strlen($str)-1)];
        $code .= $string;
        $color = imagecolorallocate($img, 0, rand(0, 200), rand(0, 255));
        $start = rand($a+5,$a+10);
        $a+=$x/$length;
        // $b += $b+rand(-5 ,5);
		$ttf = realpath('./simhei.ttf');
        imagettftext($img,$size,rand(-40,40),$start,$b,$color,$ttf,$string);
    }

    header("content-type:image/jpeg");
    imagejpeg($img);
    // return($img);
    imagedestroy($img);
}

$res = code(200,80,8,30);