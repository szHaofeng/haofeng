<?php

class AjaxController extends Controller
{
    public $layout='';
	public $model = null;

	public function init()
	{
		header("Content-type: text/html; charset=".$this->encoding);
		$this->model = new Model();
	}
    private function _AreaInit($id, $level = '0')
	{
		$result = $this->model->table('adm_area')->where("parent_id=".$id)->order('sort')->findAll();
		$list = array();
		if($result) {

			foreach($result as $key => $value) {
				$id = "o_".$value['id'];
				//$list["$id"]['i'] = $value['id'];
				//$list["$id"]['pid'] = $value['parent_id'];
				$list["$id"]['t'] = $value['name'];
				//$list["$id"]['level'] = $level;
				if($level<2)$list[$id]['c'] = $this->_AreaInit($value['id'], $level + 1);
			}
		}
		return $list;
	}
	public function areas()
	{
		$cache = CacheFactory::getInstance();
        $items = $cache->get("_AreaData");
        if($items == null)
        {
            $items = JSON::encode($this->_AreaInit(0));
            $cache->set("_AreaData",$items,315360000);
        }
        return $items;
	}
	public function area_data()
	{
		$result = $this->areas();
		echo ($result);
	}
   
   
}
