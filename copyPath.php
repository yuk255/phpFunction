<?php
/*
 * @Author: yuk255
 * @Description: 复制文件夹
 */

/**
 * @description: 复制目录，新目录要不存在才可复制
 * @param $dir：复制源路径
 * @param $newPath：复制后的新路径
 * @return 
 */
function copydir($dir,$newPath){

    //检测目录是否存在
    if(!file_exists($dir)){
        die('要复制的目录不存在');
    }
    if(!file_exists($newPath)){
        mkdir($newPath);
    }else{
        die('目录已存在');
    }

    //打开目录
    $res = opendir($dir);
    while($result = readdir($res)){

        //过滤特殊目录
        if($result == '.' || $result == '..'){
            continue;
        }

        $pathName = $dir.'/'.$result;
        $newPathName = $newPath.'/';
        if(is_file($pathName)){
            copy($pathName,$newPathName.$result);            
        }
        if(is_dir($pathName)){
            copydir($pathName,$newPathName.$result);
        }
    }
}
$path = './test';
$new = './test4';

copydir($path,$new);
