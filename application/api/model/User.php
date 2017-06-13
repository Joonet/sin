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

    private $time;
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

        $month = [
            'January'   => '01',
            'February'  => '02',
            'March'     => '03',
            'April'     => '04',
            'May'       => '05',
            'June'      => '06',
            'July'      => '07',
            'August'    => '08',
            'September' => '09',
            'October'   => '10',
            'November'  => '11',
            'December'  => '12',
        ];

        foreach ($month as $k => $v){
            if (!stripos($value, $k))
                return 1;
            str_replace($k, $v, $value);
            return strtotime($value);
        }
    }
    protected function getBirthdayAttr($birthday)
    {
        return date('Y-m-d', $birthday);
    }

    protected function setGenderAttr($value)
    {
        if ($value == 'Male')
            return 1;
        return 0;
    }
    protected function getGenderAttr($value)
    {
        if ($value == 1)
            return 'Male';
        return 'Female';
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