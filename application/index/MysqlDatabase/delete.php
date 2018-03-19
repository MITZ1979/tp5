<?php
/**
 * Created by PhpStorm.
 * User: lol
 * Date: 2017/11/23
 * Time: 14:07
 */
//创建连接
$link=mysqli_connect("127.0.0.1","root","","db1","3306");
//设置编码
mysqli_query($link,"SET NAMES 'UTF8'");
//执行语句
mysqli_query($link,"delete from student WHERE stuid=".$_GET['id']);
//断开连接
$link->close();
?>
删除成功<a href="index.php">返回首页</a>
