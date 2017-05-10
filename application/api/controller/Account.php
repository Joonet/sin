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

class Account extends Controller
{
    public function register(){

        $new_u = input('get.');

        $user = new User($new_u);

        $ref = validate('Account')->check($new_u);
        if ($ref == false){
            dump(validate('Account')->getError());
            return '不符合';
        }
        if ($user->save()){
            echo 'succces';
        }else {
            echo 'failed';
        }
    }

    public function login(){
        echo 'login';
    }
}

