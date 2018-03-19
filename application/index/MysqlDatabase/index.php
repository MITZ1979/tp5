<script language="JavaScript" src="../ajax/ajax.js"></script>
<script>
    function regist() {
        var stuname=document.getElementById("stuname").value;
        var stusex=document.getElementById("stusex").value;
        var stupassword=document.getElementById("stupassword").value;
        var stutel=document.getElementById("stutel").value;
        var getValue="?stuname="+stuname+"&stusex="+stusex+"&stupassword="+stupassword+"&stutel="+stutel;
        document.getElementById("showdiv").style.display="block";
        ajaxfunction('showdiv','insert.php'+getValue);
        setTimeout("showOK()",3000);
    }
    function showOK() {
        location.reload();
    }
    function update(id) {
        //具体更新方法
        ajaxfunction("updatediv","update.php?id="+id);

    }
</script>
<?php
/**
 * Created by PhpStorm.
 * User: lol
 * Date: 2017/11/23
 * Time: 9:51
 */
    $link;//数据库的连接对象
    $database="db1";//要连接的数据库名
    $url="127.0.0.1";//要连接的数据库服务器位置
    $username="root";//连接数据库的登录名
    $password="";//连接数据库的密码
    $sql="select * FROM student";//要执行的数据库语句
    $result;//通过sql语句查询出来的结果（所有结果）
    $line;//查询出来的数据中的某一行

//    //创建连接
//    $link=mysql_connect($url,$username,$password);
//    //指定要使用的数据库
//    mysql_select_db($database);
//    $result=mysql_query($sql);
//    var_dump($result);
//    /* 释放资源 */
//    mysql_free_result($result);
//    /* 断开连接 */
//    mysql_close($link);
//创建连接对象
$link=mysqli_connect($url,$username,$password,$database,"3306");
//设置编码为UTF8
mysqli_query($link,"SET NAMES 'UTF8'");
//执行SQL语句，得出结果
$result=mysqli_query($link,$sql);

//显示结果
//var_dump($result);
//要输出表格的头
echo "<table border='1'>
    <tr>
        <td>学生的id</td>
        <td>学生的姓名</td>
        <td>学生的性别</td>
        <td>学生的密码</td>
        <td>学生的电话</td>
        <td>删除</td>
        <td>修改</td>
    </tr>
";
//要输出数据库具体内容
while($line=$result->fetch_array()){
    //判断问号左边的条件表达式是否为真
    //如果是，则将冒号左边的值保存给sex,否则将冒号右边的值保存给sex
    $sex=$line[2]==0?'女':'男';
    echo "<tr>
        <td>".$line[0]."</td>
        <td>".$line[1]."</td>
        <td>".$sex."</td>
        <td>".$line[3]."</td>
        <td>".$line[4]."</td>
        <td><a href='delete.php?id=".$line[0]."'>删除</a></td>
        <td><input type='button' value='修改' onclick='update(".$line[0].")'></td>
      </tr>";
}
//用于添加数据
echo "<form>
       <tr>
        <td>添加学生：</td>
        <td><input type='text' id='stuname' name='stuname' placeholder='学生姓名'></td>
        <td><input type='text' id='stusex' name='stusex'></td>
        <td><input type='text' id='stupassword' name='stupassword'></td>
        <td><input type='text' id='stutel' name='stutel'></td>
        <td colspan='2'><input style='width: 100%' type='button' value='添加' onclick='regist()'/></td>
      </tr>
      </form>
      ";

//要结束表格

echo "</table>";
//关闭数据库连接
$link->close();

?>
<div id="showdiv" style="display:none;position: absolute;z-index: 2;top: 0px;left: 0px;opacity:0.5;background-color: white;border: solid 1px black;width: 25%;height: 25%;padding: 20%"></div>
<div id="updatediv" style="width: 300px;height: 600px;background-color: white">
    修改“容器”
</div>