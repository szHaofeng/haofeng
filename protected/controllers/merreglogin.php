<?php

class MerregloginController extends Controller
{

   public function saveReg(){
        $this->checkFormToken();
        $post=Req::post();
        if($post['type']!=1){
            $verify=MobileCodeService::verify(Req::post("mobile"),Req::post("mobile_code"),$errmsg);
            if (!$verify) {
                $post["errmsg"]=$errmsg;
                $this->redirect("/index/register",true,$post);
                die();
               // $info=array("status"=>"false","msg"=>$errmsg);
               // echo JSON::encode($info);die;
            }
        }
        $entity=new MerchantEntity();
        $extend=array();
        $valid=$entity->saveValidator($extend,$errmsg);
        if ($valid) {
            $data=array_merge($post,$extend);
            $id=$entity->save($data);
            if ($id) {
                if($post['type']!=1){
                    // $info=array("status"=>"success","msg"=>"注册成功");
                    // echo JSON::encode($info);die;
					$post["errmsg"]="注册成功";
					$this->redirect("/index/login",true,$post);
                }
                echo "<script>parent.close_dialog(true);</script>";
            } else {
                if($post['type']!=1){
                    $post["errmsg"]="注册失败！，请重新再试！";
					$this->redirect("/index/register",true,$post);
                }
                $post["errmsg"]="注册失败！，请重新再试！";
                $this->redirect("/merchant/edit",true,$post);
            }
        } else {
            if($post['type']!=1){
                $info=array("status"=>"false","msg"=>$errmsg);
                echo JSON::encode($info);die;
            }
            $post["errmsg"]=$errmsg;
            $this->redirect("/merchant/edit",true,$post);
        }
   }

}
