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
    //教师列表
    public function teacherList()
    {
        $teacher = TeacherModel::all();
        $this->view->count = TeacherModel::count();
        foreach ($teacher as $value) {
            $data = [
                'id' => $value->id,
                'name' => $value->name,
                'degree' => $value->delete,
                'mobile' => $value->school,
                'hiredate' => $value->hiredate,
                'status' => $value->status
            ];
            $teacherList[] = $data;
        }
        $this->view->assign('teacherList', $teacherList);
        return $this->view->fetch('teacher');
    }

    //教师列表编辑
    public function teacherEdit(Request $request)
    {
        $teacher_id = $request->param('id');
        $result = TeacherModel::get($teacher_id);
        //將教師當前頁面賦值
        $this->view->assign('teacher_info', $result);
        //将班级表中的数据赋值给当前模板
        $this->view->assign('gradeList', \app\index\model\Grade::all());
        //渲染出当前编辑模板
        return $this->view->fetch('teacher-edit');
    }

    //添加教师按钮
    public function teacherAdd()
    {
        $this->view->assign('gradeList', \app\index\model\Grade::all());
        return $this->view->fetch('teacher-add');
    }

    //添加教师的方法
    public function AddTeacher(Request $request)
    {
        //从添加表中获取数据
        $data = $request->param();
        //更新表中的数据
        $result = TeacherModel::create($data);
        //设置返回数据
        $status = 0;
        $message = '添加失败，请检查';
        //检查返回结果
        if (true == $result) {
            $status = 1;
            $message = '添加成功';
        }
        return ['status' => $status, 'message' => $message];
    }

    //编辑
    public function doEdit(Request $request)
    {
        //从编级表中排除字段
        $data = $request->except('grade');
        //设置更新条件
        $condition = ['id' => $data['id']];
        //更新当前记录
        $result = TeacherModel::update($data, $condition);
        //设置返回结果
        $status = 0;
        $message = '更新失败，请检查！';

        if (true == $result) {
            $status = 1;
            $message = '恭喜你，更新成功';
        }
        return ['status' => $status, 'message' => $message];
    }

    //删除功能
    public function deleteTeacher(Request $request)
    {
        $teacher_id = $request->param('id');
        TeacherModel::update(['is_delete' => 1], ['id' => $teacher_id]);
        TeacherModel::destroy($teacher_id);
    }

    //批量恢复
    public function unDelete()
    {
        TeacherModel::update(['delete_time' => NULL], ['is_delete' => 1]);
    }
}