<?php
namespace app\index\controller;
use app\index\controller\Base;
class Index extends Base
{
    public function index()
    {
        $this -> assign("title","教学管理系统");
        $this -> assign("header","教学管理系统");
        return $this->fetch();
    }
//    public function index()
//    {
//      return dump(\think\Config::get());
//    }
}
