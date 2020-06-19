<?php

class MerchantController extends AdmBase
{
    public $layout='admin';

    public function init() {
        
        parent::init();
        $this->entity=new MerchantEntity();
        
    }
    public function configsave(){
        $this->checkFormToken();
        $post=Req::post();
        $id=Filter::int(Req::post("id"));
        $status=Filter::int(Req::post("status"));
        if($status== 2){
            $extend=array();
            $valid=(new MerconfigEntity())->saveValidator($extend,$errmsg);
            if(!$valid){
                $post["errmsg"]=$errmsg;
                $this->redirect("info",true,$post);
            }
        }
        $review_time= date("Y-m-d H:i:s");
        $data =array('review_time'=>$review_time,'status'=>$status,'id'=>$id,'remark'=>$post['remark'],'admin_id'=>$this->manager["id"]);
        $success=$this->entity->save($data);
        if ($success) {
            if($status== 2){
                MerchantService::MerchantConfig($post);
            }
            MerchantService::InformationReminder(1,$post);
            echo "<script>parent.close_dialog(true);</script>";
        } else {
            $data["errmsg"]="保存失败，请重新再试！";
            $this->redirect("info",true,$data);
        }
       
    }
}
