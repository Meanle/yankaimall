<?php

namespace Home\Action;

/**
 * Class Entrepreneurs
 * @package Weixin\Controller
 */
class EntrepreneursAction extends BaseAction
{
    public function login_request()
    {
        $m = D('Home/Payments');
        $this->wxpay = $m->getPayment("weixin");
        $appid = $this->wxpay ['appId'];
        $redirect_url = WEB_HOST . '/index.php/Home/Entrepreneurs/index';
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
        header("Location:" . $url);
    }

    public function index()
    {
        $m = D('Home/Payments');
        $this->wxpay = $m->getPayment("weixin");
        $appid = $this->wxpay ['appId'];
        $secret = $this->wxpay ['appsecret'];
        $code = I('code');
        //1.获取access_token

        $at_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
        $at_token_json = JX_curl($at_url, null);

        //2.判断处理返回的json

        $ret = json_decode($at_token_json);
        if ($ret->errcode) {
            echo $at_token_json . '2';
            return;
        }
        $token = $ret->access_token;
        $openid = $ret->openid;
        $scope = $ret->scope;

        //3.获取用户信息

        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid&lang=zh_CN";
        $user_info = JX_curl($url, null);
        $ret = json_decode($user_info);

        $user = M('users')->where(array('wxOpenId' => $openid))->find();

        if ($ret->errcode) {
            echo $at_token_json . '1';
            return;
        } $m = D('Home/Users');
        if ($user) {
            //注册了就登陆
            $user = $m->get($user['userId']);
            session('WST_USER', $user);
        } else {
            //没有注册就注册
            $autoRegister = array();
            $loginName = $ret->nickname;
            if (strlen($loginName) < 3) {
                $loginName = '@' . $loginName . '@';
            }
            $autoRegister['loginName'] = $loginName;
            $autoRegister['loginPwd'] = '888888';
            $autoRegister['reUserPwd'] = '888888';
            $autoRegister['protocol'] = 1;
            $autoRegister['wxOpenId'] = $openid;
            $autoRegister['userPhoto'] = $ret->headimgurl;
            $res = $m->regist($autoRegister);
            if ($res['userId'] > 0) {//注册成功
                //加载用户信息
                $user = $m->get($res['userId']);
                if (!empty($user)) session('WST_USER', $user);

            }

        }

        $local = session("local");
        if ($local) {
        	session("local",null);
            header("Location:" . $local);
        } else
            header("Location:" . U('index/index'));
    }
}