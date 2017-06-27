<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 17/5/2017
 * Time: 10:36
 */

namespace app\api\controller;
require EXTEND_PATH.'/autoload.php';

use app\api\model\User;
use think\Request;
use think\Db;
use app\api\base\ApiBase;
use Qiniu\Auth;
use Qiniu\Zone;

define('AK', 'ktWhhIycoPOuXyntFn60_fRydB1gcYnowbWLGcz5', false);
define('SK', '8PfAKarg77ipKFswyL7mAXMmHtOsZ80ryuHWP5vb', false);
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

    /**
     * @return string $token
     */
    public function qiniu(){
        $accessKey = AK;
        $secretKey = SK;
        $auth = new Auth($accessKey, $secretKey);
        // 空间名  https://developer.qiniu.io/kodo/manual/concepts
        $bucket = 'jonet';
        // 生成上传Token
        return $auth->uploadToken($bucket, null, 3600, null);
    }

    public function jo(){

        echo substr(md5('139.199.228.33/account/update?token=85C71A4B832588C6995602846191CF55'), 8, 24);


        $user = User::get('2');
        //userInfo
        $userInfo = ['userinfo' => $user];
        return mJson(655, '的监控网络接口', $userInfo);
//        return myJson(200, '登录成功', $userInfo);

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