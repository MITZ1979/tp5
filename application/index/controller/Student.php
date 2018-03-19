<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4
 * Time: 13:39
 */

namespace app\index\controller;

class Student extends Base
{
    public function student()
    {
        return $this->view->fetch('student:student-list');
    }
}