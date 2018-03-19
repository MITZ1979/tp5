<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4
 * Time: 10:40
 */

namespace app\index\controller;


class Teacher extends Base
{
    public function teacher()
    {
        // $this->redirect('teacher/teacher');
        $this->display('teacher:teacher');
        return $this->fetch();
    }
}