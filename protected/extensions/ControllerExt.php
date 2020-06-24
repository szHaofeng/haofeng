<?php
//控制器扩展
class ControllerExt implements Extension
{
    public function before($obj=null)
    {
        $config = Config::getInstance();
        $site = $config->get('globals');
        $obj->assign('site_name',$site['site_name']);
        $obj->assign('site_logo_min',$site['site_logo_min']);
        $obj->assign('site_logo',$site['site_logo']);

        
    }
    public function after($obj=null)
    {
    }
}
