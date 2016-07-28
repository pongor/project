<?php
/**
 * Created by PhpStorm.
 * User: pongor
<<<<<<< HEAD
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
        // ���������˳��Ҫ���� key ֵ ASCII ����������
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
    //����ַ���
    private static function createNonceStr($length = 16) {
=======
 * Date: 2016/7/28
 * Time: 9:01
 */

namespace Home\Controller;


use Think\Controller;

class WechatController extends Controller
{
    private $appId;
    private $appSecret;

    public function __construct($appId, $appSecret) {
        parent::__construct();
        $this->appId = C('appid');
        $this->appSecret = C('APPSECRET');
    }
    public function test(){
        dump(share());
    }

    public function index($url='') {
        $jsapiTicket = $this->getJsApiTicket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16) {
>>>>>>> 1fc87fb362964ef767bee1afabf3dd5996c70902
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
<<<<<<< HEAD
    //��ȡjsapi_ticket
    public static function getTicket($token,$type='jsapi'){
        $url = C('jsapi_ticket');
        $result = file_get_contents($url.'?access_token='.$token.'&type='.$type);
        return json_decode($result,true);
    }
    //����get�����ȡ΢��token
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
=======

    private function getJsApiTicket($token,$type='jsapi') {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket';
        $result = file_get_contents($url.'?access_token='.$token.'&type='.$type);
        return json_decode($result,true);
    }

    private function getAccessToken() {
        $data = get_access();
        $access_token = $data->access_token;
        return $access_token;
    }

    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

    private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
    }
    private function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
>>>>>>> 1fc87fb362964ef767bee1afabf3dd5996c70902
    }
}