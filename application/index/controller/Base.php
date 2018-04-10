<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/14
 * Time: 1:02
 */

namespace app\index\controller;


use think\Controller;
use think\Session;

class Base extends Controller
{
    //初始化
    protected function _initialize()
    {
        //继承父类中的初始化操作
        parent::_initialize();
        //判断用户是否登录，用户登录则获取用户id，用户未登录则为空则跳到isLogin()
        define('USER_ID', Session::has('user_id') ? Session::get('user_id') : null);
        // define('GRADE_ID',Session::has('grade_id')? Session::get('grade_id') : null);
    }

    //判断用户是否登陆,放在系统后台入口前面: index/index
    protected function isLogin()
    {
        if (is_null(USER_ID)) {
            $this->error('用户未登陆，无权限访问', url('user/login'));
        }
    }

    //重复登陆,放在登陆操作前面:user/login
    protected function alreadyLogin()
    {
        if (USER_ID) {
            $this->error('用户已经登陆，请勿重复登录', url('index/index'));
        }
    }
}