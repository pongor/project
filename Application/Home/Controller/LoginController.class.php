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
        dump($_GET);
        dump($_POST);
        dump($_REQUEST);
    }

}