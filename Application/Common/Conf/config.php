<?php
return array(
   'URL_MODEL'          => 2, //URL模式
//    'SESSION_AUTO_START' => true, //是否开启session
   // 'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),
   'DEFAULT_MODULE'       =>    'Home',
//
//    'MULTI_MODULE'          =>  true,
    //更多配置参数
    //...
    'LOAD_EXT_CONFIG' => 'db',
    /***********************************微信配置***********************************************/
    'APPSECRET' =>  '103e688b8013ae4e53ecb3b67ae81e33',
    'appid'     =>  'wxee8924b7550b4570',
    'access_token'  => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential',
);