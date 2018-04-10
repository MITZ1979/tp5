<?php

namespace app\index\controller;

class Index extends Base
{
    public function index()
    {
        $this->isLogin();
        //更改模板中的标题
        $this->assign("title", "教学管理系统");
        //更改模板中的header
        $this->assign("header", "教学管理系统");
        return $this->view->fetch();
    }

    public function welcome()
    {
        return $this->view->fetch('welcome');
    }
}
