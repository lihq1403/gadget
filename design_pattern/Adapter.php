<?php

/**
 * 适配器模式
 * 适配器模式将一个类的接口转换成客户希望的另外一个接口，使得原本由于接口不兼容而不能一起工作的那些类可以在一起工作
 */

/**
 * 微博登录
 * Class WeiBo
 */
class WeiBo
{
    public function myLogin($username, $password)
    {
        echo $username.' is login WeiBo with password '. $password. PHP_EOL;
    }
}

/**
 * 微信登录
 * Class WeiXin
 */
class WeiXin
{
    public function login2($config){
        echo $config['username'].' is login WeiXin with password '. $config['password']. PHP_EOL;
    }
}

/**
 * 适配器
 * Interface Adapter
 */
interface Adapter
{
    public function login($username, $password);
}

/**
 * 微博适配器
 * Class WeiBoAdapter
 */
class WeiBoAdapter extends WeiBo implements Adapter
{
    public function login($username, $password)
    {
        $this->myLogin($username, $password);
    }
}

/**
 * 微信适配器
 * Class WeiXinAdapter
 */
class WeiXinAdapter extends WeiXin implements Adapter
{
    public function login($username, $password) {
        $this->login2([
            'username'=>$username,
            'password'=> $password
        ]);
    }
}

/**
 * Class LoginUser
 */
class LoginUser
{
    private $adapter;

    public function setAdapter(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function login($username, $password)
    {
        $this->adapter->login($username, $password);
    }
}

// 微博用户想要登录
$weiBoUser = new LoginUser();
// 实例化微博适配器
$adapter = new WeiBoAdapter();
$weiBoUser->setAdapter($adapter);
$weiBoUser->login('WeiBoUser', '123456');

$weiXinUser = new LoginUser();
// 实例化微博适配器
$adapter = new WeixinAdapter();
// 设置适配器
$weiXinUser->setAdapter($adapter);
$weiXinUser->login('WeiXinUser', '123456');

// 输出结果
//WeiBoUser is login WeiBo with password 123456
//WeiXinUser is login WeiXin with password 123456