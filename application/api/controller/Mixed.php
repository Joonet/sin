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
use think\Db;
use app\api\base\ApiBase;

class Mixed extends ApiBase
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
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        define("CONSTANT", 'nidaye');

    }

    public function jo(){
        $date = date('m/d/Y', 1046534400);
        $date_m = substr($date, 0, 2);
        foreach ($this->month as $k => $v){
            if ($v == $date_m)
                return substr_replace($date, $k, 0, 2);
        }

        return 'January/01/2017';

        echo substr(md5('139.199.228.33/account/update?token=FBCB372EAE067AB652286AECAF11AE11'), 8, 24);
        echo json_encode([22,'33']);
        return json([22,'33']);
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
        // 数组-字符串-数组
        echo implode('-', [1,2,4]);



        $date = '3/2/2017';
        echo strtotime($date)."</br>";
        echo date('m/d/Y', 1488384000);
        return '';

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
        echo $this->getUrl();
        echo $_SERVER['HTTP_HOST'].$_SERVER['PATH_INFO'];
        echo "</br>";
        return uniqid('',true);
        //前三
        $game_type = 'PUZZLE-PLATFORMER-SHOOTER';
        $gameTypes = explode('-', $game_type);
        dump($gameTypes);
        //前三
        $nums = array();
        $i = 0;
        foreach ($gameTypes as $value) {
            $nums[$i] = Db::name('game_type')->where('game_type',$value)->value('id');
            $i++;
        }
        Db::name('game_type_preference')->insert(['top1' => $nums[0], 'top2' => $nums[1], 'top3' => $nums[2], 'user_id' => 2222]);

    }


}