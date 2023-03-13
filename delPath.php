<?php
/*
 * @Author: yuk255
 * @Description: 删除目录函数
 */

/**
 * @description: 
 * @param $dir
 * @return 
 */
function rmnedir($dir){

    //检测目录是否存在
    if(!file_exists($dir)){
        die('目录不存在');
    }

    //打开目录
    $res = opendir($dir);
    while($result = readdir($res)){

        //过滤特殊目录
        if($result == '.' || $result == '..'){
            continue;
        }

        $pathName = $dir.'/'.$result;
        if(is_file($pathName)){
            unlink($pathName);            
        }
        if(is_dir($pathName)){
            rmnedir($pathName);
        }
    }
    rmdir($dir);
}
$path = './test';
rmnedir($path);