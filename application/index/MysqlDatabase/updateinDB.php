<?php
/**
 * Created by PhpStorm.
 * User: lol
 * Date: 2017/11/24
 * Time: 10:13
 */
$link=mysqli_connect("127.0.0.1","root","","db1");
mysqli_query($link,"SET NAMES 'UTF8'");
$stuid=$_POST['stuid'];
$stuname=$_POST['stuname'];
$stusex=$_POST['stusex'];
$stupassword=$_POST['stupassword'];
$stutel=$_POST['stutel'];
echo "stuid=$stuid,stuname=$stuname,stusex=$stusex,stupassword=$stupassword,stutel=$stutel";
$sql="update student set stuname=$stuname,stusex=$stusex,stupassword=$stupassword,stutel=$stutel WHERE stuid=$stuid";
mysqli_query($link,$sql);
$link->close();
echo "<script>location.href='./index.php'</script>"
?>


