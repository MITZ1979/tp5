<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/14
 * Time: 1:50
 */

namespace app\index\validate;

use think\Validate;

/*定义验证器类验证User*/

class User extends Validate
{
    protected $rule = [
        'name' => 'require'
    ];
    protected $msg = [
        'name' => ['require' => '此选项必须填写~']
    ];
}