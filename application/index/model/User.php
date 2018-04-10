<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/7
 * Time: 20:50
 */

namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;

class User extends Model
{
    //导入软删除方法集
    use SoftDelete;

    //设置软删除字段
    //只有该字段为NULL，该字段才会显示出来
    protected $deleteTime = 'delete_time';
    //保存自动完成列表
    protected $auto = [
        'delete_time' => NULL,
        'is_delete' => 1, //1:允许删除 0:禁止删除
    ];
    //新增自动完成列表
    protected $insert = [
        'login_time' => NULL,//新增登录时间为NULL，因为刚创建
        'login_count' => 0,//原因如上，刚创建，没登录过
    ];
    //更新自动完成列表
    protected $update = [];
    protected $autoWriteTimestamp = true;//自动写入时间
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y年m月d日';

    //数据表中角色：role返回处理值
    public function getRoleAttr($value)
    {
        $role = [
            0 => '管理员',
            1 => '超级管理员'
        ];
        return $role[$value];
    }

    //状态字段：status返回处理值
    public function getStatusAttr($value)
    {
        $status = [
            0 => '已停用',
            1 => '已启用'
        ];
        return $status[$value];
    }

    //密码修改器
    public function getPasswordAttr($value)
    {
        return md5($value);
    }

    //登录时间获取器
    public function getLoginTimeAttr($value)
    {
        return date('Y/m/d H:i', $value);
    }
}