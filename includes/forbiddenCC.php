<?php
session_start(); //开启session
$timestamp = time();
$ll_nowtime = $timestamp ;
//判断session是否存在 如果存在从session取值，如果不存在进行初始化赋值
if ($_SESSION){
  $ll_lasttime = $_SESSION['ll_lasttime'];
  $ll_times = $_SESSION['ll_times'] + 1;
  $_SESSION['ll_times'] = $ll_times;
}else{
  $ll_lasttime = $ll_nowtime;
  $ll_times = 1;
  $_SESSION['ll_times'] = $ll_times;
  $_SESSION['ll_lasttime'] = $ll_lasttime;
}
//现在时间-开始登录时间 来进行判断 如果登录频繁 跳转 否则对session进行赋值
if(($ll_nowtime - $ll_lasttime) < 5){
  if ($ll_times>=2){
header("location:http://127.0.0.1/");
  exit;
  }
}else{
  $ll_times = 0;
  $_SESSION['ll_lasttime'] = $ll_nowtime;
  $_SESSION['ll_times'] = $ll_times;
}
?>