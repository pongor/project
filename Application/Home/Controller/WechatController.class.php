<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 16/3/24
 * Time: 18:24
 */
namespace Home\Controller;
use Think\Controller;
use Think\Vender;
class WechatController extends Controller {
    public function __construct(){
        parent::__construct();
    }
    public function index($url=''){
        $url = $url ? $url : I('get.url');
        $data = S('wx_cache');
        if($data){
            $r = self::getSignPackage($data['ticket'],$url);
            return array('error'=>0,'data'=>$r,'ticket'=>$data['ticket'],'cache'=>1);
        }else{
            $result = self::getTokenApi();
            $titck = self::getTicket($result['access_token']);
            $result['ticket'] = $titck['ticket'];
            S('wx_cache',$result,array('type'=>'file','expire'=>7000));
            $r = self::getSignPackage($titck['ticket'],$url);
            return array('error'=>0,'data'=>$r,'ticket'=>$titck['ticket'],'get'=>1);die;
        }
    }
    public static function getSignPackage($jsapiTicket,$url) {
        $timestamp = time();
        $nonceStr = self::createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array(
            "appid"     => C('appid'),
            "noncestr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawstring" => $string
        );
        return $signPackage;
    }
    //随机字符串
    private static function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    //获取jsapi_ticket
    public static function getTicket($token,$type='jsapi'){
        $url = C('jsapi_ticket');
        $result = file_get_contents($url.'?access_token='.$token.'&type='.$type);
        return json_decode($result,true);
    }
    //发送get请求获取微信token
    public static function getTokenApi($s = false){
      //  $url = C('weixinAccess_token');// 'http://message.api.mtedu.com/wx/accesstoken/apptoken?only_id=gh_d1272deec0bd';// C('weixinAccess_token');
        $data = S('access_token');
        if($data && $s == false){
            return $data;
        }
        $url = C('weixinAccess_token');
        $res = file_get_contents($url);
        $data = json_decode($res,true);
        if(isset($data['access_token'])){
            S('access_token',$data,60);
            return $data;
        }
        S('access_token',null);
        return $data;
//        $json = file_get_contents($url);
//        if($json){
//            return json_decode($json,true);
//
//        }else{
//            return false;
//        }
    }
    public function access_token(){
        $sign = I('get.sign');
        $s = I('get.s') ? I('get.s') : false;
        if($sign == 'xksdsidiosdoisdasd'){
            echo json_encode(self::getTokenApi($s));
        }else{
            die;
        }
    }
}