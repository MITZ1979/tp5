<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/14
 * Time: 0:55
 */

namespace app\index\controller;

class User extends Base
{

    public function login()
    {
        return $this->fetch();
    }

    public function check()
    {
        $data = [
            'name'=>'thinkphp',
            'email'=>'thinkphp@qq.com'
        ];

        $validate = Loader::validate('User');

        if(!$validate->check($data)){
            dump($validate->getError());
        }
    }

}