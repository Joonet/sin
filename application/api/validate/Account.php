<?php

/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 10/5/2017
 * Time: 17:40
 */
namespace app\api\validate;
use think\Validate;

class Account extends Validate
{
    // 验证规则
    protected $rule = [
        ['name', 'require|min:2|max:32'],
        ['email', 'require|email'],
    ];
}