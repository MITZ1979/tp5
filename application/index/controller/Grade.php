<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4
 * Time: 20:52
 */

namespace app\index\controller;

use app\index\model\Grade as GradeModel;
use think\Request;

class Grade extends Base
{

    public function gradeList()
    {
        //获取所有班级信息表
        $grade = GradeModel::all();
        //获取记录数量
        $this->view->count = GradeModel::count();
        //遍历grade表
        foreach ($grade as $value) {
            $data = [
                'id' => $value->id,
                'name' => $value->name,
                'length' => $value->length,
                'price' => $value->price,
                'status' => $value->status,
                'create_time' => $value->create_time,
                // 用关联方法teacher属性方式访问teacher表中的数据库
                'teacher' => isset($value->teacher->name) ? $value->teacher->name : '<span style="color:red">未分配</span>'
            ];
            // 每次关联查询结果，保存到数组$gradeList中
            //二维数组
            $gradeList[] = $data;
        }

        $this->view->assign('gradeList', $gradeList);
        //$this->view->assign('count',$count);
        return $this->view->fetch('grade/grade_list');
    }

    //添加班级按钮
    public function gradeAdd(Request $request)
    {
        $this->view->assign('title', '添加班级');
        return $this->view->fetch('grade-add');
    }

    // 添加班级方法
    public function addGrade(Request $request)
    {
        //从提交表单中获取数据
        $data = $request->param();
        // 更新当前记录
        $result = GradeModel::create($data);
        //设置返回的初始值
        $status = 0;
        $message = '很遗憾，添加失败，请检查！';
        // 检查添加结果
        if (true == $result) {
            $status = 1;
            $message = '恭喜您，添加成功';
        }
        return "<html style='width: 300px;height:100px;margin: auto;'><h1> $message</h1>is_delete</html>"; //json_encode(['status'=>$status,'message'=>$message]);
    }

    //删除班级的方法
    public function gradeDel(Request $request)
    {
        $user_id = $request -> param('id');
        GradeModel::update(['is_delete'=>1],['id'=> $user_id]);
        GradeModel::destroy($user_id);
    }
    // 恢复删除
    public function gradeDelete()
    {
        GradeModel::update(['delete_time' =>NULL], ['is_delete'=>1]);
    }


    // 停用班级的方法
    public function setStatus(Request $request)
    {
        $grade_id = $request->param('id');

        $result = GradeModel::get($grade_id);
        //
        if ($result->getData('status') == 1) {
            GradeModel::update(['status' => 0], ['id' => $grade_id]);
        } else {
            GradeModel::update(['status' => 1], ['id' => $grade_id]);
        }
        return $this->view->fetch('grade_list');
    }

    // 渲染编辑班级的方法
    public function gradeEdit(Request $request)
    {
        //获取到要编辑的班级ID
        $grade_id = $request->param('id');
        //根据ID进行查询
        $result = GradeModel::get($grade_id);
        //关联查询，获取与当前班级对应的教师姓名
        $result->teacher = $result->teacher->name;

        $this->view->assign('title', '班级编辑');
        $this->view->assign('grade_info', $result);
        return $this->view->fetch('grade-edit');
    }
    // 更新班级的方法
    public function gradeUpdate(Request $request){
        //排出表中关联字段teacher
        $data = $request->except('teacher');
        //设置更新条件
        $condition = ['id'=>$data['id']];
        //更新数据
        $result=GradeModel::update($data,$condition);
        //设置返回类型
        $status = 0;
        $message='更新失败，请检查';
        //检测更新结果,将结果返回给grade_edit模板中的ajax提交回调处理
        if (true==$result){
            $status=1;

        }

    }


}