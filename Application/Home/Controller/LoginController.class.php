<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/7
 * Time: 14:09
 */

namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller
{

    public function index(){
        dump(get_access());
    }

}