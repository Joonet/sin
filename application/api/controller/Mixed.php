<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 17/5/2017
 * Time: 10:36
 */

namespace app\api\controller;

use think\Controller;
use think\Request;

class Mixed extends Controller
{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        define("CONSTANT", 'nidaye');

    }

    public function index(){
        dump(input('get.'));
        //将字符串分解为数字数组
        //mobile-console-laptop-pc
        $var = explode("-", "mobile-console-laptop-pc");
        $tmp = array();
        foreach ($var as $key=>$value){
            $tmp[$value] = $key;
        }
        dump($tmp);
        echo CONSTANT;

        echo __LINE__;
        echo __FILE__;
        echo __DIR__;
        echo __CLASS__;
        echo __NAMESPACE__;

//        return $this->fetch();
    }

    public function test(){


        $tmp = 300;
        $int_options = array(
            "options" => array(
                "min_range" => 200,
                "max_range" => 302,
            ),
        );

        if (filter_var(300, FILTER_VALIDATE_INT,$int_options)){
            echo "2";
        }else {
            echo "3";
        }


        if (!filter_has_var(INPUT_GET, 'name')){
            echo 'no';
        }else {
            echo $_GET['name'];
        }

        echo "</br>";
        echo "jo","ja";

        $dd = 7;
        var_dump($dd);


        $arr = array(
            'name'      => 'jo',
            'age'       => 25,
            'sex'       => 'male',
            'birthday'  => '1992-10-30'
        );

        ksort($arr);

        foreach ($arr as $key => $value){
            echo $key."-".$value."</br>";
        }

        $a = 5;
        while ($a){
            echo --$a;
        }


    }

    public function hehe(){
        echo $_REQUEST['fname'];
    }


}