<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <script type="text/javascript" src="__STATIC__/lib/html5shiv.js"></script>
    <script type="text/javascript" src="__STATIC__/lib/respond.min.js"></script>
    <script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="__STATIC__/static/h-ui/js/H-ui.min.js"></script>

    <link href="__STATIC__/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="__STATIC__/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css"/>
    <link href="__STATIC__/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="__STATIC__/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css"/>

    <title>后台登录</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value=""/>
<div class="header">
</div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <form class="form form-horizontal" action="{:url('index/index')}" method="post">
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input name="name" type="text" placeholder="账户" class="input-text size-L">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input name="password" type="password" placeholder="密码" class="input-text size-L">
                </div>
            </div>

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="captcha" class="input-text size-L" type="text" placeholder="验证码"
                           onblur="if(this.value==''){this.value='验证码'}"
                           onclick="if(this.value=='验证码'){this.value='';}" value="验证码" style="width:150px;">
                    <img src="{:captcha_src()}" onclick="this.src='{:captcha_src()}'" id="verify_img"
                         style="width: 205px;height:50px;">
                </div>
            </div>

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <label for="online">
                        <input type="checkbox" name="online" id="online" value="">
                        使我保持登录状态</label>
                </div>
            </div>

            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="login" id="login" type="submit" class="btn btn-success radius size-L"
                           value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L"
                           value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
    <div id="msg" style="position: relative;display:none;margin: auto;height:300px;background-color: yellow;width: 600px"></div>

</div>
<div class="footer">Copyright 南方IT学院</div>
<script>
    /*添加提交表带（AJAX）*/
    $("#login").on('click', function (event) {
        $.ajax({
            Type: "POST",                    //提交方式为POST
            url: "{:url('user/checkLogin')}",   //设置提交数据的脚本地址
            data: $("form").serialize(),    //将当前的数据序列化之后在提交数据
            dataType: 'json',               //设置提交的数据的类型为json
            success: function (data) {       //只有返回标志位为1，才进行处理
                if (data.status == 1) {
                    alert(data.message);     //先弹出提示框，提示框，提醒用户成功
                    window.location.href = "{:url('index/index')}";
                } else {
                    $('msg').innerText(alert(data.message));
                }
            }
        });
    });
    /*javascript自动刷新验证码*/
    //    $(function () {
    //        $('#verify_img').on('click',function () {
    //            $(this).attr('src',onclick=this.src'{:captcha_src()}');
    //        })
    //    });
</script>
</body>
</html>
