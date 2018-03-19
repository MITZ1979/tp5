<?php
return array(
    //'配置项'=>'配置值'
    //系统默认Common、Runtime模块是禁止访问的
    //禁止模块访问
    // 'MODULE_DENY_LIST'=>array('Common','Runtime'),
    //允许模块访问
    // 'MODULE_ALLOW_LIST'=>array('Home','Admin'),
    //设置默认的加载模块
    'DEFAULT_MODULE'=>'Admin',
//    /* 数据库设置 */
//    'DB_TYPE'               =>  'mysql',     // 数据库类型
//    'DB_HOST'               =>  'localhost', // 服务器地址
//    'DB_NAME'               =>  'test',          // 数据库名
//    'DB_USER'               =>  'root',      // 用户名
//    'DB_PWD'                =>  'root',          // 密码
//    'DB_PORT'               =>  '3306',        // 端口
//    'DB_PREFIX'             =>  'time_',    // 数据库表前缀
    //PDO专用定义数据库连接
    'DB_TYPE' =>'mysql',
    'DB_USER'=>'root',
    'DB_PWD'=>'root',
    'DB_PREFIX'=>'time_',
    'DB_DSN'=>'mysql:host=localhost;dbname=test;charset=UTF8',

    //页面调试信息输出
    'SHOW_PAGE_TRACE'=>true,
);