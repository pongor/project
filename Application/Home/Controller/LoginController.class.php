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
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code ";
        $result = file_get_contents($url);
        $data = json_decode($result,true);
        if(isset($data['errcode'])) {
            return ;
        }
        $user_Url = "https://api.weixin.qq.com/sns/userinfo?access_token={$data['access_token']}&openid={$data['openid']}&lang=zh_CN"; //拉取用户详细信息
        $user_Result = file_get_contents($user_Url);
        $user_Data = json_decode($user_Result,true);
       $user = [
            'openid'    =>  $user_Data['openid'],
           'nickname'   =>  $user_Data['nickname'],
           'sex'        =>  $user_Data['sex'],
           'city'       =>  $user_Data['city'],
           'province'   =>  $user_Data['province'],
           'country'    =>  $user_Data['country'],
           'headimgurl' => $user_Data['headimgurl']
       ];
        $model = D('users');
        $userInfo = $model->getInfo(array('openid'=>$user_Data['openid']));
        if($userInfo){ //用户存在 更新用户信息
            $user_id = $userInfo['id'];
            $model->getUpdate(array('id' => $user_id));
            session('user_id',$user_id,31536000);//设置session
            session('code',1,31536000);//设置session
            if($userInfo['status'] == 2){ //跳转到企业端
                redirect(U('Backend/Index/index'));die;
            }else{//其他跳转到学生端
                redirect(U('Index/index'));die;
            }
        }else{ //新用户
            $user['at_time']    = time();
            $user_id = $model->getAdd($user);
            session('user_id',$user_id,31536000);//设置session
            //跳转到学生端。并输入验证码
            redirect(U('Index/index'));die;
        }

    }
    public function logout(){ //注销用户登录
        session('user_id',null);
        session('code',null);
    }

}