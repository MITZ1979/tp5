<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4
 * Time: 10:40
 */

namespace app\index\controller;
use app\index\model\Teacher as TeacherModel;
use think\Request;

class Teacher extends Base
{
    public function teacher()
    {
        $list=TeacherModel::all();
        $this->view->count=TeacherModel::count();
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

}