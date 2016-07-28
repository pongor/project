<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/6/30
 * Time: 11:28
 */
/*
 * 递归创建目录
 * dir 目录
 */
function mkDirs($dir){
    if(!is_dir($dir)){
        if(!mkDirs(dirname($dir))){
            return false;
        }
        if(!mkdir($dir,0777)){
            return false;
        }
    }
    return true;
}
/* pongor
 *分页实现公共方法
 *@ model 表明
 * @where array 条件
 * @ limit每页显示条数
 * @parameter 参数
 * @ filed  p 设置接受当前页的参数值
 * @ current 是否显示 当前页 默认显示
 *
 * return array('page'=>$html,'total'=>$pageTotal);
 */
function page($model,$where,$limit=0,$parameter=array(),$field = 'p',$current = true){
    $start = intval(I('get.'.$field));
    $model = D($model);
    $limit = intval($limit);
    $number = $model->where($where)->count();
    $pageTotal = ceil($number / $limit);
//    if($pageTotal <= 1){ //页数小于1页不显示
//    //    return array('page'=>'','total'=>0);
//    }
    $start = $start >= 1 ? $start : 1;
    $str = '';
    if($parameter && is_array($parameter)){
        while(list($key,$val) = each($parameter)){
            $str .= '/'.$key.'/'.$val;
        }
    }
    $url = C('ADMIN') ? __APP__.'/'.strtolower(MODULE_NAME).'/'.CONTROLLER_NAME.'/'.ACTION_NAME.$str :__ACTION__.$str;
    $html = '<div class="cell_page">
                
                    <p>总共 <span>'.ceil($number/$limit).'</span> 页 </p>
						<p> 当前第 <span>'.$start.'</span> 页</p>

                </div>
                <!--元件：选页-->
                <div class="cell_slew attr_right">';
    $html .= '<p class="cell_slewOne"><a href="'.$url.'/'.$field.'/'.($start >1 ? $start-1 : $start).'.html"><img src="'.__ROOT__.'/Public/Admin/img/icon_slewArrowLeft-1.png" /></a> </p><ul class="cell_slewOne">';
    for($i=1;$i<=$pageTotal;$i++){ //__SELF__
        if($i == $start){
            $html .= '<li class="offSlew">'.$i.'</li>';
        }else{
            $html .= '<li><a href="'.$url.'/'.$field.'/'.$i.'.html">'.$i.'</a></li> ';
        }
    }
    $html .= ' </ul>
                    <p class="cell_slewOne"><a href="'.$url.'/'.$field.'/'.($start >= $pageTotal ? $start : $start+1).'.html"><img src="'.__ROOT__.'/Public/Admin/img/icon_slewArrowRight-1.png" /></a></p>
                </div>';
    return array('page'=>$html,'total'=>$pageTotal);
}

/*
 * 获取access_token  有效期2小时
 */
function get_access(){
    $data = S('access_toke');
    if($data){
        return $data;
    }else{
        $url = C('access_token');
        $url .= "&appid=".C('appid')."&secret=".C('APPSECRET');
        $result = file_get_contents($url);
        $data = json_decode($result,true);
        if($data){
            S('access_toke',$data);
            return $data;
        }else{
            return false;
        }
    }
}
/*
 * 分享
 */
function share($url=''){
    $obj = A('Wechat');
    return $obj->index($url);
}