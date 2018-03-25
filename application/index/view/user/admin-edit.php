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
  <script type="text/javascript" src="__STATIC__/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
  <script>DD_belatedPNG.fix('*');</script>
  <title>{$title|default="标题"}</title>
  <meta name="keywords" content="{$keywords|default='关键字'}">
  <meta name="description" content="{$description|default='描述'}">
  </head>
<body>
  <article class="cl pd-20">
    <form action="" method="post" class="form form-horizontal" id="form-admin-edit">
      <div class="row cl">
          <label class="form-label col-xs-4 col-sm-3"><span class="c-red">管理员:</span></label>
            <div class="formControls col-xs-8 col-sm-9">
              {eq name="$user_info.name" value="admin"}
              <input type="text" class="input-text disable" value="{$user_info.name}" placeholder="" id="name" name="name">
              {else /}
              {eq name="$Think.session.user_info.name" value="$user_info.name"}
              <input type="text" class="input-text disable" value="{$user_info.name}" placeholder="" id="name" name="name">
              {else /}
              <input type="text" class="input-text disable" value="{$user_info.name}" placeholder="" id="name" name="name">
              {/eq}
              {/eq}
            </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>新密码:</label>
        <div class="form-Controls col-xs-8 col-sm-9">
          <input type="password" class="input-text" autocomplete="off" value="{$user_info.password}" placeholder="密码6位数" id="password" name="password">
        </div>
      </div>

      {eq name="$Think.session.user_info.name" value="admin"}
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">启用状态:</label>
        <div class="form-Controls col-xs-8 col-sm-9">
          <span class="select-box" style="width:150px">
            <select class="select" name="status" size="1">
              <option value="1">启用</option>
              <option value="0" selected>不启用</option>
            </select>
          </span>
        </div>
      </div>
      {/eq}

      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱:</label>
        <div class="form-Controls col-xs-8 col-sm-9">
          <input type="email" class="input-text" id="email" name="email" placeholder="@" value="{$user_info.email}">
        </div>
      </div>
      {eq name="$Think.session.user_info.name" value="admin"}
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">角色:</label>
        <div class="form-Controls col-xs-8 col-sm-9">
          <span class="select-box" style="width:150px">
            <select class="select" name="role" size="1">
              <option value="1">超级管理员</option>
              <option value="0" selected>管理员</option>
            </select>
          </span>
        </div>
      </div>
      {/eq}
      <!--將当前记录的id作为隐藏域发送到服务器-->
      <input type="hidden" value="{$user_info.id}" name="id">

      <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
          <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" id="submit">
        </div>
      </div>
    </form>
  </article>
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    $(function () {
        $("form").children().change(function () {
            $("#submit").removeClass('disabled')
        });

        $("#submit").on('click', function (event) {
            $.ajax({
                type: 'POST',
                url: "{:url('user/editUser')}",
                data: $('#form-admin-add').serialize(),
                dataTpye: "json",
                success: function (data) {
                    if (data.status==1){
                        alert(data.message);
                    }else {
                        alert(data.message);
                    }
                }
            });
        })
    });
</script>
</body>
</html>