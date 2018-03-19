<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/4
 * Time: 20:52
 */

namespace app\index\controller;

class Gradea extends Base
{
    public function gradea()
    {
        //$this->display('gradea:gradea');
        return $this->fetch();
    }

}