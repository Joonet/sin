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
use think\cache\driver\Redis;
use think\Request;


class Account extends Controller
{
    public $redis;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->redis = new Redis();

    }

    public function register(){
        $new_u = input('get.');
        $ref = validate('Account')->check($new_u);
        if ($ref == false){
            return validate('Account')->getError();
        }
        $user1 = User::get(['name' => $new_u['name']]);
        $user2 = User::get(['email' => $new_u['email']]);
        if ($user1 || $user2){
            if ($user1){
                return myJson(400, '用户名已存在');
            }
            if ($user2){
                echo myJson(400, '邮箱已存在');
            }
            return '';
        }

        $user = new User($new_u);
        $user['create_time'] = time();
        $user['password'] = md5($new_u['password']);
        if ($user->allowField(true)->save()){
            return myJson(200, '注册成功');
        }else {
            echo myJson(200, '注册失败');
        }


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
        $name = input('get.name');
        $password = input('get.password');

        if (strpos($name,'@') == true){
            //邮箱登录
            $user = User::get(['email' => $name]);

        }else {
            //用户名登录
            $user = User::get(['name' => $name]);
        }
        if (!$user){
             myJson(403, '该用户不存在');
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


    public function update($sign){
        $id = isset($id)?input('get.id'):1;
        $sign = input('get.sign');

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
        $this->redis->set($key, $value);
        return $value;

    }

    /**
     * 判断用户有效性
     * @param $id
     * @param $sign
     * @return bool
     */
    private function isUser($id, $sign){
        $url = $this->getUrl();
        $token = $this->redis->get($id);
        if ($sign == $this->getSign($url, $token)){
            return true;
        }else {
            return false;
        }
    }

    private function getUrl(){
        return $_SERVER["SERVER_ADMIN"].$_SERVER["SERVER_ADDR"];
    }

    private function getSign($url, $token) {
        return substr(md5($url."?token=".$token), 8, 24);
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


