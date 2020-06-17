<?php

class MerregloginController extends Controller
{

   public function reg(){
        $this->checkFormToken();
        $verify=MobileCodeService::verify(Req::post("mobile"),Req::post("code"),$errmsg);
        $post=Req::post();
        if (!$verify) {
            $post["errmsg"]=$errmsg;
            $this->redirect("register",true,$post);
            die();
        }
        $entity=new MerchantEntity();
        $extend=array();
        $valid=$entity->saveValidator($extend,$errmsg);
        if ($valid) {
            $data=array_merge($post,$extend);
            $id=$entity->save($data);
            if ($id) {
                EnterpriseService::createAddress($id);
                $this->redirect("/enterprise/login/account/".Req::post("account"));
            } else {
                $post["errmsg"]="注册失败！，请重新再试！";
                $this->redirect("register",true,$post);
            }
        } else {
            $post["errmsg"]=$errmsg;
            $this->redirect("register",true,$post);
        }
   }

}
