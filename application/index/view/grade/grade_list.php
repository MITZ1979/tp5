<?php
?>
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
    <title>班级管理</title>
</head>
<body>
<nav class="breadcrumb">班级信息<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-2">
    <div class="cl pd-5 bg-1 bk-gray mt-20">
    <span class="l">
        <a href="javascript:;" onclick="unDelete()" class="btn btn-danger radius"><i class="icon-trash">&#xe6e2;</i> 批量恢复</a>
        <a href="javascript:;" onclick="grade_add('添加班级','{:url("grade/gradeAdd")}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加班级</a>
    </span>
        <span class="r">共有数据：<strong>{$count}</strong> 条</span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="80">ID</th>
            <th width="100">班级名称</th>
            <th width="60">学制</th>
            <th width="90">学费</th>
            <th width="150">开班时间</th>
            <th width="150">授课教师</th>
            <th width="130">状态</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        {volist name='gradeList' id='vo'}
        <tr class="text-c">
            <td >{$vo.id}</td>
            <td >{$vo.name}</td>
            <td >{$vo.length}</td>
            <td >{$vo.price}</td>
            <td >{$vo.create_time}</td>
            <td width="150">{$vo.teacher}</td>
            <td class="td-status">
                <!--根据当前表中的status值确定显示的内容-->
                {if condition="$vo.status eq 1"}
                <span class="label label-success radius">已启用</span>
                {else /}
                <span class="label radius">已停用</span>
                {/if}
            </td>
            <td class="td-manage">
                {if condition="$vo.status eq 1"}
                <a style="text-decoration:none" onClick="grade_stop(this,{$vo.id})" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
                {else /}
                <a style="text-decoration:none" onClick="grade_start(this,{$vo.id})" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe615;</i></a>
                {/if}

                <a title="编辑" href="javascript:;" onclick="grade_edit('编辑列表','{:url("grade/gradeEdit",["id"=>$vo["id"]])}','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                <a title="删除" href="javascript:;" onclick="grade_del(this,{$vo.id})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
            </td>
        </tr>
            {/volist}
        </tbody>
    </table>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="__STATIC__/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="__STATIC__/lib/laypage/1.2/laypage.js"></script>
<script  type="text/javascript">
    //添加班级
    function grade_add(title, url, w, h) {
        $.post(url);
        layer_show(title, url, w, h);
    }
    //停用班级
    function grade_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            $.get("{:url('grade/setStatus')}", {id: id});
            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="grade_start(this,' + id + ')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe615;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label-default radius">已禁用</span>');
            $(obj).remove();
            layer.msg('已停用', {icon: 5, time: 1000});
        });
    }

    //启用班级
    function grade_start(obj, id) {
        layer.confirm('确认要启用吗？', function (index) {
            $.get("{:url('grade/setStatus')}", {id: id});
            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="grade_stop(this,id )" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe615;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
            $(obj).remove();
            layer.msg('已启用!', {icon: 6, time: 1000});
        })
    }
    //删除班级
    function grade_del(obj, id) {
        layer.confirm("确认要删除吗？", function (index) {
            $.get("{:url('grade/gradeDel')}", {id: id});
            $(obj).parents("tr").remove();
            layer.msg("已删除！", {icon: 1, time: 1000});
        });
    }
    //编辑班级
    function grade_edit(title,url,w,h){
        $.get(url);  //控制器中的编辑方法
        layer_show(title,url,w,h);
    }
    function unDelete(){
        // 恢复删除
        layer.confirm('确认要恢复吗？', function () {
            $.get("{:url('grade/gradeUnDelete')}");
            layer.msg('已恢复！',{icon:1 , time: 1000});
            window.location.reload();
        })
    }
</script>
</body>
</html>
