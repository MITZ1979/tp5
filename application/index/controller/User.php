<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/14
 * Time: 0:55
 */

namespace app\index\controller;
use app\index\controller\Base;
use think\Request;
class User extends Base
{


    /**
     * @return string
     * 登录界面
     */
    public function login()
    {
        return $this->view->fetch();
    }

    /**
     * @param Request $request
     * 登录验证 $this->validate($data, $rule, $msq)
     */
    public function checkLogin(Request $request)
    {
        /**
         * 初始返回参数
         *
         * 从当前方法返回三个变量
         * $status:当前状态
         * $result:提示信息
         * $data:返回数据
         * 打包成JSON数据返回前端
         */
        $status = 0;
        $result = '';
        $data = $request -> param();

        return ['status'=>$status, 'message'=>$result, 'data'=>$data];
        /*$data = [
            'name'=>'thinkphp',
            'email'=>'thinkphp@qq.com'
        ];

        $validate = Loader::validate('User');

        if(!$validate->check($data)){
            dump($validate->getError());
        }
        */
    }

}