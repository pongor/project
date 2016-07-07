<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/7
 * Time: 14:09
 */

namespace Home\Controller;

use Boris\DumpInspector;
use Think\Controller;

class LoginController extends Controller
{

    public function index(){
        $access = get_access();
        $appid = C('appid');
        $redirect_uri = urlencode('http://css.dulishuo.com/Login/check'); //回调地址
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"; // 微信登录链接
        redirect($url);die;
    }
    public function check(){
        $code = I('get.code');

        if(!$code) return ;
        $appid = C('appid');
        $secret = C('APPSECRET');
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code=CODE&grant_type=authorization_code ";
        $result = file_get_contents($url);
        $data = json_decode($result,true);
        dump($data);
        if(isset($data['errcode'])) {
            return ;
        }
        $user_Url = "https://api.weixin.qq.com/sns/userinfo?access_token={$data['access_token']}&openid={$data['openid']}&lang=zh_CN"; //拉取用户详细信息
        $user_Result = file_get_contents($user_Url);
        $user_Data = json_decode($user_Result,true);
        dump($user_Data);
    }

}