<?php

/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 10/5/2017
 * Time: 14:29
 */
namespace app\api\controller;
use think\cache\driver\Redis;
use think\Db;
use think\Request;
use app\api\base\ApiBase;
use app\api\model\User;
use app\api\model\PlatformPreference;


class Account extends ApiBase
{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        self::$redis = new Redis();

    }

    public function isuseravailable(){
        $params = input('post.');
        if (isset($params['email'])){
            $user = User::get(['email' => $params['email']]);
            if ($user){
                return mJson(400, '邮箱已存在');
            }
        }elseif (isset($params['name'])){
            $user = User::get(['name' => $params['name']]);
            if ($user){
                return mJson(400, '用户名已存在');
            }
        }

        return mJson(200, '可以注册');

    }

    public function register(){
        $params = input('post.');
        $ref = validate('Account')->check($params);
        if ($ref == false){
            return validate('Account')->getError();
        }
        $user1 = User::get(['name' => $params['name']]);
        $user2 = User::get(['email' => $params['email']]);
        if ($user1 || $user2){
            if ($user1){
                return mJson(400, '用户名已存在');
            }
            if ($user2){
                return mJson(400, '邮箱已存在');
            }
        }

        $user = new User($params);

        $user['create_time'] = time();
        $user['password'] = md5($params['password']);
        if ($user->allowField(true)->save()){
            echo mJson(200, '注册成功');
        }else {
            echo mJson(403, '注册失败');
        }

        /**
         * 分表data存储
         *  sinister_platform_perference
         *  sinister_game_type_preference
         */

        //将字符串分解为数字数组
        //mobile-console-laptop-pc
        if (!isset($params['platform']))
            return '';

        $var = explode('-', $params['platform']);
        $tmp = array();
        foreach ($var as $key=>$value){
            $tmp[$value] = $key + 1;
        }
        $tmp['user_id'] = $user['id'];
        $platformPer = new PlatformPreference($tmp);
        if (!$platformPer->save()){
            return mJson(400, '处理错误');
        }

        //前三
        //PUZZLE-PLATFORMER-SHOOTER

        if (!isset($params['game_type']))
            return '';

        $game_type = $params['game_type'];
        $gameTypes = explode('-', $game_type);
        $nums = array();
        $i = 0;
        foreach ($gameTypes as $value) {
            $nums[$i] = Db::name('game_type')->where('game_type',$value)->value('id');
            $i++;
        }
        Db::name('game_type_preference')->insert(['top1' => $nums[0], 'top2' => $nums[1], 'top3' => $nums[2], 'user_id' => $user['id']]);

    }


    /*
     *支持邮箱和用户名登录
     * 1.判断登录方式
     * 2.根据登录方式sql查找密码是否匹配
     * 3.若匹配，则返回用户相关信息json；否则，返回null
     * 4.app根据返回信息，是否登录
     * 5.登录后的操作均需携带token和id
     * */
    public function login($name, $password){
        $name = input('post.name');
        $password = input('post.password');

        if (strpos($name,'@') == true){
            //邮箱登录
            $user = User::get(['email' => $name]);

        }else {
            //用户名登录
            $user = User::get(['name' => $name]);
        }
        if (!$user){
             return mJson(404, '该用户不存在');
        }

        if (md5($password) != $user['password']){
            return mJson(402, '密码不正确,请重新输入');
        }


//app客户端持久化token
        $token = $this->redis_write($user['id'], strtoupper(md5(uniqid('', true))));
        $user['token'] = $token;
        return mJson('200', '登录成功', ['userInfo' => $user->hidden(['password', 'create_time', 'game_classification'])]);

    }

    /**
     * @param image_small,image_large,birthday,gender,location
     * @return \think\response\Json
     */
    public function update(){
        $params = input('post.');
        $id = $params['id'];
        $sign = $params['sign'];

        if (!$this->isUser($id, $sign, $this->getUrl()))
            return mJson(403, '签名错误');

        $user = User::get($id);

        if ($user->allowField(true)->save($_POST, ['id' => $id]))
            return mJson(200, '个人资料更新成功');
        return mJson(400, 'Bad');
    }

    /**
     * 在Redis中设置token值
     * @param $key
     * @param $value
     * @return Token
     */
    private function redis_write($key,$value){
        self::$redis->set($key, $value);
        return $value;

    }



    public function logout(){
        //验证身份后执行
        self::$redis->rm('id');
    }

}


