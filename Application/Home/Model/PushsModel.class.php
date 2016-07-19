<?php
/**
 * Created by PhpStorm.
 * User: pongor
 * Date: 2016/7/11
 * Time: 15:20
 */

namespace Home\Model;


use Think\Model;

class PushsModel extends Model
{

    public function getList($where){
        $model = M('pushs');
        return $model->field('pushs.*,pushs.id as pid,company.company,company.headimgurl,company.headimg,company.id as company_id ,industry.file as files')
            ->where($where)->join(' left join company on company.id = pushs.company_id')
            ->join(' left join industry on industry.id = company.brand_id ')->select();

    }
    public function getUpdate($where,$data){
        $sql = "update pushs set {$data} where {$where} ";
        return $this->execute($sql);
    }

}