<?php

/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 26/5/2017
 * Time: 16:51
 */
namespace app\api\base;
use think\Controller;


class ApiBase extends Controller
{

    static public $redis;
    /**
     * 判断用户有效性
     * @param $id
     * @param $sign
     * @return bool
     */
    protected function isUser($id, $sign, $url){
        if (!self::$redis)
            return;
        $token = self::$redis->get($id);
        echo($this->getSign($url, $token));
        echo("<script>console.log('".$sign."');</script>");
        echo("<script>console.log('".$this->getSign($url, $token)."');</script>");
        if ($sign == $this->getSign($url, $token)){
            return true;
        }else {
            return false;
        }
    }

    protected function getUrl(){
        return $_SERVER["HTTP_HOST"].$_SERVER["PATH_INFO"];
    }

    protected function getSign($url, $token) {
        return substr(md5($url."?token=".$token), 8, 24);
    }
}