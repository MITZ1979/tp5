<?php
/**
 * Created by PhpStorm.
 * User: lol
 * Date: 2017/11/24
 * Time: 9:55
 */
$link=mysqli_connect("127.0.0.1","root","","db1");
mysqli_query($link,"SET NAMES 'UTF8'");
$result=mysqli_query($link,"select * from student where stuid=".$_GET['id']);
//var_dump($result);
//echo $result->fetch_array()[1];
$data=$result->fetch_array();
$link->close();
?>
<form action="updateinDB.php" method="post">
    <table>
    <tr>
        <td>学生的id<input name="stuid" value="<?php echo $data[0]?>"></td>
        <td>学生的姓名<input name="stuname" value="<?php echo $data[1]?>"></td>
        <td>学生的性别<input name="stusex" value="<?php echo $data[2]?>"></td>
        <td>学生的密码<input name="stupassword" value="<?php echo $data[3]?>"></td>
        <td>学生的电话<input name="stutel" value="<?php echo $data[4]?>"></td>
    </tr>
    <tr>
        <td colspan="5">
            <input type="submit" value="修改"/>
        </td>
    </tr>
    </table>
</form>
