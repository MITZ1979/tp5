﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
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
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb">管理员信息<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    {eq name="$Think.session.user_info.name" value="admin"}
    <div class="cl pd-5 bg-1 bk-gray mt-1">
        <span class="l">
            <a href="javascript:;" onclick="unDelete()" class="btn btn-danger radius">
                <i class="Hui-iconfont">&#xe6e2;</i>批量恢复</a>
            <a href="javascript:;" onclick="admin_add('添加管理员','{:url("user/adminAdd")}','800','500')" class="btn btn-primary radius">
            <i class="Hui-iconfont">&#xe600;</i> 添加管理员</a></span>
        <span class="r">共有数据：<strong>{$count}</strong> 条</span>
    </div>
    {/eq}
    <table class="table table-border table-bordered table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="9">员工列表</th>
        </tr>
        <tr class="text-c">
            <th width="40">ID</th>
            <th width="150">用户</th>
            <th width="150">邮箱</th>
            <th width="100">角色</th>
            <th width="50">登录次数</th>
            <th width="130">上次登录时间</th>
            <th width="100">是否已经启用</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        {volist name="list" id="vo"}
        <tbody>
        <tr class="text-c">
            <td>{$vo.id}</td>
            <td>{$vo.name}</td>
            <td>{$vo.email}</td>
            <td>{$vo.role}</td>
            <td>{$vo.login_count}</td>
            <td>{$vo.login_time}</td>
            <td class="td-status">
                {if condition="$vo.status eq '已启用'"}
                <span class="label label-success radius">{$vo.status}</span>
                {else/}
                <span class="label radius">{$vo.status}</span>
                {/if}
            </td>
            <td class="td-manage">
                <!--切换启用与禁用图标-->
                <!--只允许admin有权限线启用或禁用-->
                {eq name="$Think.session.user_info.name" value="admin" }
                {if condition="$vo.status eq '已启用'"}
                    <a style="text-decoration:none" onClick="admin_stop(this,{$vo.id})" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
                {else /}
                    <a style="text-decoration:none" onClick="admin_start(this,{$vo.id})" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe631;</i></a>
                {/if}
                {/eq}

                <a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','{:url("user/adminEdit",['id'=>$vo["id"]])}','1','800','500')" class="ml-5" style="text-decoration:none">
                <i class="Hui-iconfont">&#xe6df;</i></a>
                {eq name="$Think.session.user_info.name" value="admin"}
                <a title="删除" href="javascript:;" onclick="admin_del(this,{$vo.id})" class="ml-5" style="text-decoration:none">
                    <i class="Hui-iconfont">&#xe6e2;</i></a>
                {/eq}
            </td>

        </tr>

        </tbody>
        {/volist}
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
<script type="text/javascript">
    /*
        参数解释：
        title	标题
        url		请求的url
        id		需要操作的数据id
        w		弹出层宽度（缺省调默认值）
        h		弹出层高度（缺省调默认值）
    */
    /*管理员-增加*/
    function admin_add(title, url, w, h) {
        $.post(url);
        layer_show(title, url, w, h);
    }

    /*管理员-删除*/
    function admin_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.get("{:url('user/deleteUser')}", {id: id});
            $(obj).parents("tr").remove();
            layer.msg('已删除!', {icon: 1, time: 1000});

        });
    }

    /*管理员-编辑*/
    function admin_edit(title, url, id, w, h) {
        $.get(url, {id: id});//控制器中的编辑方法
        layer_show( title,url, w, h);
    }

    /*管理员-停用*/
    function admin_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.get("{:url('user/setStatus')}", {id: id});
            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,' + id + ')" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
            $(obj).remove();
            layer.msg('已停用!', {icon: 5, time: 1000});
        });
    }

    /*管理员-启用*/
    function admin_start(obj, id) {
        layer.confirm('确认要启用吗？', function (index) {
            //此处请求后台程序，下方是成功后的前台处理……
            $.get("{:url('user/setStatus')}", {id: id});
            $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
            $(obj).remove();
            layer.msg('已启用!', {icon: 6, time: 1000});
        });
    }

    function unDelete() {
        layer.confirm('确认要恢复吗？', function (index) {
            $.get("{:url('user/unDelete')}");
            layer.msg('已恢复', {icon: 1, time: 1000});
            window.location.reload();
        });
    }
</script>
</body>
</html>