<?php
//用户管理
class AdmrightsController extends AdmBase
{
    public function init() {
        parent::init();
        $this->entity=new MerrightsEntity();
    }
}
