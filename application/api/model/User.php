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
    private $month = [
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
    //新增、更新
    protected $auto = ['update_time'];

    protected function setUpdateTimeAttr()
    {
        return request()->time();
    }

    protected $type = [

        ];

    // birthday修改器
    protected function setBirthdayAttr($value)
    {
        foreach ($this->month as $k => $v){
            if (count(explode($k, $value)) > 1){
                echo str_replace($k, $v, $value);
                return strtotime(str_replace($k, $v, $value));
            }
        }
    }
    protected function getBirthdayAttr($birthday)
    {
        $date = date('m/d/Y', $birthday);
        $date_m = substr($date, 0, 2);
        foreach ($this->month as $k => $v){
            if ($v == $date_m)
                return substr_replace($date, $k, 0, 2);
        }

        return 'January/01/2017';
    }

    protected function setGenderAttr($value)
    {
        switch ($value){
            case 'Female':
                return 0;
            case 'Male':
                return 1;
            case 'Other':
                return 2;
            default:
                return 3;
        }
    }
    protected function getGenderAttr($value)
    {

        switch ($value){
            case 0:
                return 'Female';
            case 1:
                return 'Male';
            case 2:
                return 'Other';
            default:
                return 'Secrete';
        }

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