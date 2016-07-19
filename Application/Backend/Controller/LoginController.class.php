<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/13
 * Time: 15:00
 */

namespace Backend\Controller;
use Think\Controller;

class LoginController extends Controller
{
    public function index(){
        $access = get_access();
        $appid = C('appid');
        $redirect_uri = urlencode('http://css.dulishuo.com/Backend/Login/check'); //回调地址
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"; // 微信登录链接
        redirect($url);die;
    }
    public function check()
    {
        $code = I('get.code');

        if (!$code) return;
        $appid = C('appid');
        $secret = C('APPSECRET');
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code ";
        $result = file_get_contents($url);
        $data = json_decode($result, true);
        if (isset($data['errcode'])) {
            return;
        }
        $user_Url = "https://api.weixin.qq.com/sns/userinfo?access_token={$data['access_token']}&openid={$data['openid']}&lang=zh_CN"; //拉取用户详细信息
        $user_Result = file_get_contents($user_Url);
        $user_Data = json_decode($user_Result, true);
        $model = D('Company');
        $data = [
            'nickname' => $user_Data['nickname'],
            'sex'       =>  $user_Data['sex'],
            'city'      =>  $user_Data['city'],
            'country'   =>  $user_Data['country'],
            'headimgurl'=>  $user_Data['headimgurl'],
            'openid'    =>  $user_Data['openid'],

            //'name'      =>  $user_Data['']
        ];

       $r =  $model->getInfo(" openid = '{$user_Data['openid']}'");
        if($r){ //存在就更新
            $model -> getUpdate(array('id' => $r['id']),$data);
            $user_id = $r['user_id'];
        }else{
            $data['at_time']    = time();
           $user_id =  $model->getInsert($data);
        }

        session('user_id',$user_id,31536000);

        redirect(U('Index/index'));die;


    }
}