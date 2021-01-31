<?php
error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(E_ALL);
ini_set('date.timezone','UTC');
header("Content-type:text/html;charset=utf-8");
session_start();

include_once 'sqlhelp.php';
$sqlhelp = new \sqlhelp\sqlhelp();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];


//检查登录的方法
function check_login()
{
    session_start();
    $user_id = $_SESSION['user_id'];
    if ($user_id) {
        return true;
    } else {
        return false;
    }
}

//获取参数的方法
function get_arg($name){
    $val = $_REQUEST[$name];
    //防止SQL注入
    $val = addslashes($val);
    $val = str_replace("%","\%",$val);//转义掉”%”
    return $val;
}