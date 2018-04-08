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
    <form action="/tp5/public/index.php/index/grade/gradeUpdate" method="post" class="form form-horizontal" id="form-grade-edit">
      <div class="row cl">
          <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>班级:</label>
            <div class="formControls col-xs-8 col-sm-9">
              <input type="text" class="input-text disable" value="{$grade_info.name}" placeholder="班级" id="name" name="name">
            </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>学制:</label>
        <div class="form-Controls col-xs-8 col-sm-9">
          <input type="text" id="length" name="length" class="input-text" autocomplete="off" placeholder="学制" value="{$grade_info.length}">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>学费:</label>
        <div class="form-Controls col-xs-8 col-sm-9">
          <input type="text" class="input-text" id="price" name="price" placeholder="学费" value="{$grade_info.price}">
        </div>
      </div>

      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-3">状态:</label>
          <div class="form-Controls col-xs-8 col-sm-9">
            <span class="select-box" style="width:150px"><select class="select" name="status" size="1">
                    {eq name='$grade_info.status' value="1"}
                    <option value="1">启用</option>
                    {else /}
                    <option value="0" selected>不启用</option>
                    {/eq}
                </select>
            </span>
          </div>
      </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">授课教师:</label>
            <div class="form-Controls col-xs-8 col-sm-9">
                <input type="text" class="input-text disabled readonly" readonly id="teacher" name="teacher" value="{$grade_info.teacher}">
            </div>
        </div>
            <!--將当前记录的id作为隐藏域发送到服务器-->
      <input type="hidden" value="{$grade_info.id}" name="id">

      <div class="row cl">
        <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
             <input class="btn btn-primary radius" type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" id="submit">
        </div>
      </div>

    </form>
  </article>
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/messages_zh.js"></script>
    <script>
     $(function () {
        $('form').children().change(function () {
            $("#submit").removeClass('disabled');
        });

        $("#submit").on('click', function (event) {
            $.ajax({
                type: 'POST',
                url: "{:url('grade/gradeUpdate')}",
                data: $('#form-grade-edit').serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.status ==1){
                        alert(data.message);
                    }else {
                        alert(data.message);
                    }
                }
            });
        }
    })
</script>
</body>
</html>