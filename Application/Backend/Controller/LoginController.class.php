<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/13
 * Time: 15:00
 */

namespace Backend\Controller;
use Think\Controller;
use Boris\DumpInspector;

class LoginController extends Controller
{   
    public function index(){
        
        $access = get_access();
        $appid = C('appid');
        $redirect_uri = urlencode('http://css.dulishuo.com/Backend/Login/check'); //回调地址
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"; // 微信登录链接
        redirect($url);
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
            'nickname' => json_decode(preg_replace("#(\\\ud[0-9a-f]{3})|(\\\ue[0-9a-f]{3})#ie",'',json_encode($user_Data['nickname']))),
            'sex'       =>  $user_Data['sex'],
            'city'      =>  $user_Data['city'],
            'country'   =>  $user_Data['country'],
            'headimgurl'=>  $user_Data['headimgurl'],
            'openid'    =>  $user_Data['openid'],

            //'name'      =>  $user_Data['']
        ];

        //dump($data);die;
        
        
        //$r =  $model->getInfo(" openid = '{$user_Data['openid']}'");
        $map['openid']=$data['openid'];
        $r = M('Company')->where($map)->find();
        //dump($r);die;
        if($r){ //存在就更新
            //dump($r);die;
            $biil=M('Company')-> where('id='.$r['id'])->save($data);
            $user_id = $r['id'];

        }else{
            //echo $model->_sql();die;
            $data['at_time']    = time();
            //$user_id =  $model->getInsert($data);
            $user_id=M('Company')->add($data);
        }
        
        session('uid',$user_id,31536000);
        session('headimgurl',$user_Data['headimgurl'],31536000);
        //dump($data['openid']);die;

        redirect(U('Personnel/index'));


    }

        public function test(){

          $id=I('get.pdf');
          $file='http://123.57.250.189/upload/file/'.$id.'.pdf';
          redirect($file);

    }
}