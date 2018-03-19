<?php
/**
 * Created by PhpStorm.
 * User: lol
 * Date: 2017/11/23
 * Time: 14:23
 */
$stuname=$_GET['stuname'];
$stusex=$_GET['stusex'];
$stupassword=$_GET['stupassword'];
$stutel=$_GET['stutel'];
$link=mysqli_connect("127.0.0.1","root","","db1","3306");
mysqli_query($link,"SET NAMES 'UTF8'");
$sql="insert into student(stuname,stusex,stupassword,stutel)VALUES ";
$sql.="('$stuname','$stusex' ,'$stupassword' ,'$stutel' )";
mysqli_query($link,$sql);
$link->close();
?>
添加成功
<script>
    alert("ok");
</script>

