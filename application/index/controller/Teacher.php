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
    //添加教师按钮
    public function teacherAdd()
    {
        $this->view->assign('添加教师');
        return $this->view->fetch('teacher-add');
    }
    //添加教师的方法
    public function AddTeacher(Request $request)
    {
        //从添加表中获取数据
        $data=$request->param();
        //更新表中的数据
        $result=TeacherModel::create($data);
        //
        $status=0;
        $message='添加失败，请检查';
        if (true==$result) {
            $status=1;
            $message='添加成功';
        }

        return ['status'=>$status,'message'=>$message];
    }

}