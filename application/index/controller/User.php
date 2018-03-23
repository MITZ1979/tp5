<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/14
 * Time: 0:55
 */

namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Request;
use think\Session;
class User extends Base
{
    /**
     * @return string
     * 登录界面
     */
    public function login()
    {
        $this->alreadyLogin();
        return $this->view->fetch();
    }

    /*
     * @param Request
     * $request
     * 登录验证 $this->validate($data, $rule, $msq)
     */
    public function checkLogin(Request $request)
    {
        /**
         * 初始返回参数
         * 从当前方法返回三个变量
         * $status:当前状态
         * $result:提示信息
         * $data:返回数据
         * 打包成JSON数据返回前端
         */
        $status = 0;
        $result = '登录失败';
        $data = $request->param();

        $rule = [
            'name|姓名' => 'require',
            'password|密码' => 'require',
            'verify|验证码' => 'require|captcha',
        ];
        //自定义验证失败提示信息
        $msg = [
            'name' => ['用户名不能为空,请输入！'],
            'password' => ['密码不能为空,请输入！'],
            'verify' => ['验证码不能为空,请输入！']
        ];
        //进行验证
        $result = $this->validate($rule, $data, $msg);
        if (true === $result) {
            //
            $map = [
                'name' => $data['name'],
                'password' => md5($data['password'])
            ];
            //查询用户信息
            $user = UserModel::get($map);
            if ($user == null) {
                $result = '没有找到该用户';
            } else {
                $status = 1;
                $result = '验证通过,点击【确定】进入';
                //用来检测用户登陆状态和防止重复登陆
                Session::set('user_id', $user->id);  //用户id
                Session::set('user_info', $user->getData()); //获取用户所以信息
                //更新用户登录次数:自增1
                $user -> setInc('login_count');
            }
        }
        return ['status' => $status, 'message' => $result, 'data' => $data];
    }

    //退出登陆
    public function logout()
    {
        //注销登陆
        UserModel::update(['login_time'=>time()],['id'=>Session::get('user_id')]);
        Session::delete('user_id');
        Session::delete('user_info');
        $this->success('注销登陆，正在返回', 'user/login');
    }

    //管理员列表
    public function adminList()
{
    $this->view->assign('title','管理员列表');
    $this->view->assign('keywords','教学管理系统');
    $this->view->assign('description','管理员页面');

    $this->view->count = UserModel::count();
    $userName = Session::get('user_info.name');
    if ($userName == 'admin')//判断当前用户是否为admin用户
    {
        $list = UserModel::all();
    } else {
        //非admin只能看自己的信息，数据要经过模型处理器处理
        $list = UserModel::all(['name' => $userName]);
    }
    $this->view->assign('list', $list);
    //渲染模板
    return $this->view->fetch('user/admin-list');
}

    //管理员状态变更
    public function setStatus(Request $request)
    {
        $user_id = $request->param('id');
        $result = UserModel::get($user_id);
        if ($result->getData('status') == 1) {
            UserModel::update(['status' => 0], ['id' => $user_id]);
        } else {
            UserModel::update(['status' => 1], ['id' => $user_id]);
        }
        return $this->view->fetch('user/admin-list');
    }

    public function adminEdit(Request $request)
    {
        $user_id = $request->param('id');
        $result = UserModel::get($user_id);
        $this->view->assign("title", "编辑管理员信息");
        $this->view->assign("keywords", "教学管理系统");

        $this->view ->assign('user_info',$result->getData());
        return $this->view->fetch('admin_edit');
    }

    //更新数据
    public function editUser(Request $request)
    {
        //获取表单返回的数据
        $param =$request->param();
        foreach ($param as $key => $value ){
            if (!empty($value)){
                $data[$key]=$value;
            }
        }
        $condition = ['id'=>$data['id']];
        $result = UserModel::update($data,$condition);
        if (Session::get('user_info.name')=='admin'){
            Session::set('user_info.role',$data['role']);
        }
        if (ture == $result){
            return ['status'=>1,  'message'=>'更新成功'];
        }else{
            return ['status'=>0, 'message'=>'更新失败,请检查'];
        }
    }

    public function deleteUser(Request $request)
    {
        $user_id = $request->param('id');
        UserModel::update(['is_delete'=>1],['id'=>$user_id]);
        UserModel::destroy($user_id);
    }

    public function unDelete()
    {
        UserModel::update(['delete_time'=>NULL],['is_delete'=>1]);
    }

    public function adminAdd()
    {
        $this->view->assign('title','添加管理员');
        $this->view->assign('keywords','教学管理系统');
        return $this->view->fetch('admin-add');
    }

    public function checkUserName(Request $request)
    {
        $userName = tirm($request->param('name'));
        $status=1;
        $message = '用户名可用';
        if (UserModel::get(['name'=>$userName])){
            $status = 1;
            $message = '用户名重复，请重新输入！！';
        }
        return ['status'=>$status,'message'=>$message];
    }

    public function checkUserEmail(Request $request)
    {
        $userEmail = tirm($request->param('email'));
        $status=1;
        $message = '邮箱可用';
        if (UserModel::get(['email'=>$userEmail])){
            $status = 1;
            $message = '邮箱重复，请重新输入！！';
        }
        return ['status'=>$status,'message'=>$message];
    }

    public function addUser(Request $request)
    {
        $data = $request->param();
        $status = 1;
        $message = '添加成功';

        $rule = [
            'name|用户名'=>"request|min:3|max:10",
            'password|密码'=>"request|min:3|max:10",
            'email|邮箱'=>"request|eamil"
        ];
        $result = $this->validate($data,$rule);
        if ($result === true){
            $user = UserModel::create($request->$rule);
            if($user===null){
                $status=0;
                $message='添加失败！！！';
            }
        }
        return ['status'=>$status,'message'=>$message];
    }
}