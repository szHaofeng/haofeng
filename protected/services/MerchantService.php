<?php
class MerchantService
{
    public static function updateHeadpic($id,$src) {
        $entity=new MerchantEntity();
        $data=array("head_pic"=>$src);
        return $entity->update($id,$data);
    }

    public static function MerConfig(){
        $check = Req::args("check");
        if(empty($check)){
            return [];
        }
        $where =array(
            'ct__mer_d_merchant_name_or_ct__domain_name'=>$check,
        );
        $Merconfig =(new MerconfigEntity)->queryAll($where);
        return $Merconfig;
    }
    /*-----------------------------------------------------------------------------------------
    *商户审核开通配置
    *------------------------------------------------------------------------------------------*/
    public static function MerchantConfig($data){
        $domain = $_SERVER['HTTP_HOST'];
        preg_match('/(.*\.)?\w+\.\w+$/', $domain, $matches);
        if(count($matches) > 1){
            $data['domain_name'] = str_replace($matches[1],$data['domain_prefix'].".",$domain);
        }else{
            $data['domain_name'] = $data['domain_prefix'].".".$domain;
        }
        $data['mer_id'] =$data['id'];
        unset($data['id']);
        (new MerconfigEntity)->save($data);
    }
   /**商户信息提醒
    * $type = 1 短信提醒
    * $type = 2 邮箱提醒
    * $type = all 短信邮箱提醒
    */
    public static function InformationReminder($type='all'){
        
    }

    /**操作记录
     *
     */
    // public static function log($type='all'){
    //     print_R($type);die;
    // }


}
