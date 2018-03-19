<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4
 * Time: 20:52
 */

namespace app\index\controller;
use app\index\controller\Base;

class Admin extends Base
{
    public function admin()
    {
        return $this->fetch('admin:admin-list');
    }

}