<?php

/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 10/5/2017
 * Time: 14:29
 */
namespace app\api\controller;
use app\api\model\User;
use think\Controller;
use think\Cache\Driver\Redis;


class Account extends Controller
{
    public function register(){
        echo $_SERVER["REQUEST_URI"]."</br>";
        echo $_SERVER["PATH_INFO"]."</br>";
        $new_u = input('get.');
        $ref = validate('Account')->check($new_u);
        if ($ref == false){
            return validate('Account')->getError();
        }
        $user1 = User::get(['name' => $new_u['name']]);
        $user2 = User::get(['email' => $new_u['email']]);
        if ($user1 || $user2){
            if ($user1){
                echo 'user exists'."</br>";
            }
            if ($user2){
                echo 'email exists';
            }
            return '';
        }
        $user = new User($new_u);
        $user['create_time'] = time();

        if ($user->allowField(true)->save()){
            echo 'succces';
        }else {
            echo 'failed';
        }
    }

    /*
     *支持邮箱和用户名登录
     * 1.判断登录方式
     * 2.根据登录方式sql查找密码是否匹配
     * 3.若匹配，则返回用户相关信息json；否则，返回null
     * 4.app根据返回信息，是否登录
     * */
    public function login(){
        $name = input('get.username');

        if (strpos($name,'@') == true){
            //邮箱登录
            $user = User::get(['email' => $name]);

        }else {
            //用户名登录
            $user = User::get(['name' => $name]);

        }
        if ($user == null){
            echo '用户不存在';
        }
        echo $user->create_time;
    }

    public function update(){


        return $this->fetch('jo');
        $user = User::get(1);
        $this->assign('createTime',$user->create_time);
        return $this->fetch();
        echo $user->create_time;
        echo $user->update_time;
        $user['birthday'] = '2003-03-02';
        $user->save();
    }

    public function redis(){

        echo date('Y-m-d H:i:s', time());
        $redis = new Redis();
        $array = [
            'name' => "Jo",
            'age'  => 25,
        ];
        $redis->set('name', $array, 5);
        dump($redis->get('name')) ;
        echo "Connection to server sucessfully"."</br>";
        header("refresh:1");

    }

    public function jo(){
        echo "changefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsa
        changefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsa
        changefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsa
        changefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsachangefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsachangefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsa
        changefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsa
        changefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsa
        changefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsachangefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsa
        changefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsa
        changefdsafdsafkdlsa;fjdsaklfjdklas;jfkldasfdsajk fjdsak;fdsajkjkfsa;ljkf dsa jkfdsaj;klaskl;j fjfkas;dl; fdjsa";
    }
}


