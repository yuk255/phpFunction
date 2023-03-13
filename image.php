<?php
/*
 * @Description: 图片裁剪缩放加水印
 */

/**
 * @description: 
 * @param $path:图片路径
 * @param $startx：裁剪开始x
 * @param $starty：裁剪开始y
 * @param $width：裁剪宽度
 * @param $height：裁剪高度
 * @return 
 */ 
function fun($path,$startx,$starty,$width,$height){
    
    $old = imagecreatefromjpeg($path);
    $new = imagecreatetruecolor($width,$height);
    
    switch(getimagesize($path)['mime']){
        case 'image/jpeg':
            $old = imagecreatefromjpeg($path);
            break;
        case 'image/png':
            $old = imagecreatefrompng($path);
            break;
        case 'image/gif':
            $old = imagecreatefromgif($path);
            break;
    }
    
    imagecopy($new,$old,0,0,$startx,$starty,$width,$height);
    
    header("content-type:image/jpeg");
    imagejpeg($new,'./new.jpeg');
    imagedestroy($new);
}

// fun('./2.jpeg',200,200,500,500);

/**
 * @description: 
 * @param $path:图片路径
 * @param $width：缩放完宽度
 * @param $height：缩放完高度
 * @return 
 */
function fun1($path,$width,$height){
    
    $old = imagecreatefromjpeg($path);
    $new = imagecreatetruecolor($width,$height);
    
    switch(getimagesize($path)['mime']){
        case 'image/jpeg':
            $old = imagecreatefromjpeg($path);
            break;
        case 'image/png':
            $old = imagecreatefrompng($path);
            break;
        case 'image/gif':
            $old = imagecreatefromgif($path);
            break;
    }

    $oldWidth = imagesx($old);
    $oldHeight = imagesy($old);
    
    imagecopyresampled($new,$old,0,0,0,0,$width,$height,$oldWidth,$oldHeight);
    
    header("content-type:image/jpeg");
    imagejpeg($new,'./new1.jpeg');
    imagedestroy($new);
}
// fun1('./2.jpeg',300,300);

/**
 * @description: 
 * @param $path:图片路径
 * @param $str:水印文字（适配中文字符）
 * @param $size：水印文本大小（px）
 * @return 
 */
function fun2($path, $str, $size){
    $old = imagecreatefromjpeg($path);
    $oldWidth = imagesx($old);
    $oldHeight = imagesy($old);
    
    $length=strlen($str);
    
    $color = imagecolorallocatealpha($old, 255,255,255, 60);
	$ttf = realpath('./simhei.ttf');
    imagettftext($old,$size,0,$oldWidth-$size/2*($length),$oldHeight-$size,$color,$ttf,$str);
    
    header("content-type:image/jpeg");
    imagejpeg($old);
    imagedestroy($old);
}

fun2('./2.jpeg','test',20);