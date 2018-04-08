<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4
 * Time: 13:39
 */

namespace app\index\controller;
use app\index\model\Student as StudentModel;
use think\Request;
class Student extends Base
{
    //查询
    public function student(Request $request)
    {
        $this->view->count = StudentModel::count();
        $user_id=$request->param('id');

        return $this->view->fetch('student:student-list');
    }



    public function unDelete(Request $request)
    {
        StudentModel::update(['delete_time'=>NULL],['is_delete'=>1]);
    }
}