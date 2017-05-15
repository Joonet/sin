<?php

/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 10/5/2017
 * Time: 14:33
 */
namespace app\api\model;
use think\Model;

class User extends Model
{

    //新增、更新
    protected $auto = ['update_time'];
    protected function setUpdateTimeAttr()
    {
        return request()->time();
    }

    protected $type = [

        ];

    // birthday修改器
    protected function setBirthdayAttr($value) {
        return strtotime($value);
    }
    // 读取器
    protected function getBirthdayAttr($birthday)
    {
        return date('Y-m-d', $birthday);
    }

    protected function getCreateTimeAttr($createTime)
    {
        return date('Y-m-d h:i:s', $createTime);
    }

    protected function getUpdateTimeAttr($updateTime)
    {
        return date('Y-m-d h:i:s', $updateTime);
    }
}