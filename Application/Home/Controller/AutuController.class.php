<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/7
 * Time: 13:33
 */

namespace Home\Controller;
use Think\Controller;

class AutuController extends Controller
{
    public $code;

    public function __construct()
    {
        parent::__construct();

        $this->user_id =session('user_id');

        
        if($this->user_id <= 0){
            redirect(U('Login/index')); return;
        }
        $this->code     = session('code');
        
    }

}