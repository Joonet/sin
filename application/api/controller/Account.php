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
                return myJson(400, '用户名已存在');
            }
            if ($user2){
                return myJson(400, '邮箱已存在');
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
        $var = explode("-", $params['platform']);
        $tmp = array();
        foreach ($var as $key=>$value){
            $tmp[$value] = $key + 1;
        }
        $tmp['user_id'] = $user['id'];
        $platformPer = new PlatformPreference($tmp);
        if ($platformPer->save()){
            return '';
        }

        //前三
        

    }

    /*
     *支持邮箱和用户名登录
     * 1.判断登录方式
     * 2.根据登录方式sql查找密码是否匹配
     * 3.若匹配，则返回用户相关信息json；否则，返回null
     * 4.app根据返回信息，是否登录
     * 5.登录后的操作均需携带sign和id
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
             return myJson(404, '该用户不存在');
        }

        if (md5($password) != $user['password']){
            return myJson(402, '密码不正确,请重新输入');
        }

        $url = $this->getUrl();

        $token = $this->redis_write($user['id'], md5(time()));
        $sign = $this->getSign($url, $token);
        $user['sign'] = $sign;
        return myJson('200', '登录成功', $user);
    }


    public function update($id,$sign){
        $id = isset($id)?input('post.id'):1;
        $sign = input('post.sign');

        if (!$this->isUser($id, $sign))
            return myJson(403, '签名错误');

        $user = User::get($id);
        $this->assign('createTime',$user->create_time);

        echo $user->create_time;
        echo $user->update_time;
        $user['birthday'] = '2003-03-02';
        $user->save();
        echo $user->birthday;
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



    public function index(){

        return $this->fetch('jo');
        echo $_POST['fname']."Jo";

        $config = array(
            'host'      =>  '127.0.0.1',
            'username'  =>  'root',
            'password'  =>  'admin',
        );
        $conn = mysqli_connect($config['host'], $config['username'], $config['password']);
        if ($conn->error){
            echo '没有链接';
        }

        $pre = $conn->prepare('');
//        $pre->bind_param("sss")
        $pre->execute();


    }

}


