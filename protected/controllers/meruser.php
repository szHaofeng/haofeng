<?php

class MeruserController extends AdmBase
{
    public $layout='admin';

    public function init() {
        parent::init();
        $this->entity=new MeruserEntity();
        
    }
}
