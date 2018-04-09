<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="__STATIC__/lib/html5shiv.js"></script>
<script type="text/javascript" src="__STATIC__/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="__STATIC__/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加管理员</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<article class="page-container">
	<form action="/tp5/public/index.php/index/teacher/AddTeacher" method="post" class="form form-horizontal" id="form-teacher-add">

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" id="name" name="name" placeholder="姓名">
		</div>
	</div>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>学历:</label>
		<div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width: 150px;">
                <select class="select" size="1">
                    <option selected value="1">专科</option>
                    <option value="2">本科</option>
                    <option value="3">研究生</option>
                </select>
            </span>
		</div>
	</div>

	<div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>毕业学校:</label>
		<div class="formControls col-xs-8 col-sm-9">
            <input type="text" id="school" name="school" class="input-text" placeholder="毕业学校">
		</div>
	</div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机号:</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input type="text" class="input-text" maxlength="11" placeholder="phoneNumber" name="mobile" id="mobile">
        </div>
    </div>

    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>入职时间:</label>
        <div class="formControls col-xs-8 col-sm-9">
            <input id="hiredate" name="hiredate" placeholder="入职时间" type="date" value="">
        </div>
    </div>
    <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">负责班级:</label>
        <div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width: 150px">
                <select class="select" name="grade_id" size="1">
                    {volist name='gradeList' id='vo'}
                    <option value="{$vo.id}" selected>{$vo.name}</option>
                    {/volist}
                    <option value="0" selected>不分配</option>
                </select>
            </span>
        </div>
    </div>

    <div class="row cl">
        <label class="form-lable col-xs-4 col-sm-3">启用状态:</label>
        <div class="formControls col-xs-8 col-sm-9"><span class="select-box" style="width: 150px;">
                <select class="select" name="status" size="1">
                    <option value="1">启用</option>
                    <option value="0" selected>不启用</option>
                </select>
            </span>
        </div>
    </div>

	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="__STATIC__/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
    //防止用户无更新提交，只有表中用户更新了才提交
    $("form").children().change(function () {
        $("#submit").removeClass('disable');
    });
    //失去焦点，检查用户名是否重复
	$('#name').blur(function () {
        $.ajax({
            type:'GET',
            url:"checkUserName",
            data:{name:$(this).val()},
            dataType:'json',
            success: function (data) {
                if ( data.status == 1){
                    alert(data.message);
                }else {
                    alert(data.message);
                }
            }
        });
    });
	//失去焦点，检查邮箱是否重复
	$("#email").blur(function () {
        $.ajax({
            type:'GET',
            url:"checkUserEmail",
            dataType:'json',
            data:{email:$(this).val()},
            success:function (data) {
                if (data.status==1){
                    alert(data.message);
                }else {
                    alert(data.message);
                }
            }
        });
    });
    //
	$("#submit").on("click",function (event) {
        $.ajax({
            type:"POST",
            url:"{:url('teacher/AddTeacher')}",
            data:$("#form-admin-add").serialize(),
            dataType:"json",
            success: function (data) {
                if (data.status==1){
                    alert(data.message);
                }else {
                    alert(data.message);
                }
            }
        });
    });
});
</script>
</body>
</html>