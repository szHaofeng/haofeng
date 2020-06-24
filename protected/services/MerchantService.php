<?php
class MerchantService
{
    public static function roleMap() {
        $conditions=array('status'=>2);
        $entity=new MerchantEntity();
        $depts=$entity->queryAll($conditions,"merchant_name");
        $map=array();
        foreach ($depts as $key => $dept) {
            $map[$dept['id']]=$dept['merchant_name'];
        }
        return $map;
    }

    public static function updateHeadpic($id,$src) {
        $entity=new MerchantEntity();
        $data=array("head_pic"=>$src);
        return $entity->update($id,$data);
    }
    /**
    * 域名查询方法 function
    * 参数 check 查询
    * @return json
    */
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
        unset($data['status']);
        (new MerconfigEntity())->save($data);
        self::Merchantaccount($data['mer_id']);
        
    }
    //审核自动创建商户账号
    public static function Merchantaccount($id){
        $entity=(new MerchantEntity())->find($id);
        if($entity){
            $data['mer_id'] = $entity['id'];
            $data['name'] = $entity['mobile'];
            $data['email'] = $entity['email'];
            $data['mobile'] = $entity['mobile'];
            $data['created_type'] = 3;
            $data['created_byid'] = $entity['admin_id'];
            $data['is_admin'] = 1;
            $validcode=CHash::random(8);
            $password=Common::generatePWord("888888",$validcode);
            $data["validcode"]=$validcode;
            $data["password"]=$password;
            $uid =(new MeruserEntity)->save($data);
            if($uid){
                EnterpriseService::createAddress($uid);
            }
        }
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
