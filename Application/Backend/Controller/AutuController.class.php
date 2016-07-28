<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/13
 * Time: 14:58
 */

namespace Backend\Controller;
use Think\Controller;

class AutuController extends Controller
{    
	public $code;
    
    public function __construct()
    {   
        parent::__construct();
        $this->user_id = intval(session('uid'));
        
        if($this->user_id <= 0 ){
            redirect(U('Login/index'));return;
        }
        $this->code     = session('code');
    }
}