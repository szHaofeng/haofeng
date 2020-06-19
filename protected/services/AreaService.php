<?php
class AreaService
{
	/**
	 *获得所有省份列表
	*/
	public static function getProvinces() {
		$model=new Model("adm_area");
		return $model->fields("id,name")->where("parent_id=0")->order("sort")->findAll();
	}

	/**
	 *获得所有省份列表
	*/
	public static function provinceMap() {
		$model=new Model("adm_area");
		$provinces=$model->fields("id,name")->where("parent_id=0")->order("sort")->findAll();
		$parse_area = array();
		foreach ($provinces as $key => $province) {
            $parse_area[$province['id']] = $province['name'];
        }
        return $parse_area;
	}

	/**
	 *解析地址，如会员地址，订单地址
	 *
	 *@param array $items:包含有province,city,county 字段的数据集合
	 *@return array:所有地址信息
	*/
	public static function areasParse($items,$one=false) {
		$area_ids = array();
		if ($one) {
			if (array_key_exists('province',$items) && $items['province']) {
            	$area_ids[$items['province']] = $items['province'];
            }
            if (array_key_exists('city',$items) && $items['city']) {
	            $area_ids[$items['city']] = $items['city'];
	        }
	        if (array_key_exists('county',$items) && $items['county']) {
	            $area_ids[$items['county']] = $items['county'];
	        }
		} else {
	        foreach ($items as $item) {
	            if (array_key_exists('province',$item) && $item['province']) {
	            	$area_ids[$item['province']] = $item['province'];
	            }
	            if (array_key_exists('city',$item) && $item['city']) {
		            $area_ids[$item['city']] = $item['city'];
		        }
		        if (array_key_exists('county',$item) && $item['county']) {
		            $area_ids[$item['county']] = $item['county'];
		        }
	        }
	    }
        $area_ids = implode(',', $area_ids);
        $areas = array();
        $model=new Model("adm_area");
        if($area_ids!='')$areas = $model->where("id in ($area_ids)")->findAll();
        $parse_area = array();
        foreach ($areas as $area) {
            $parse_area[$area['id']] = $area['name'];
        }
        return $parse_area;
	}
	/**
     *获得会员地址的省/市/县地址名称, city_picker 空间
     *
     *@param int $province
     *@param int $city
     *@param int $county
     *@return string;
    */
    public static function addressName($province,$city,$county,$format=' ') {
        if (!$province || !$city || !$county) return "";
        $provincename="";
           $cityname="";
           $countyname="";
        $model=new Model("adm_area");
        $areas=$model->where("id in ($province,$city,$county)")->findAll();
        foreach ($areas as $key => $area) {
         if ($area["id"]==$province) $provincename=$area["name"];
         if ($area["id"]==$city) $cityname=$area["name"];
         if ($area["id"]==$county) $countyname=$area["name"];
        }
        if ($provincename && $cityname && $countyname)
         return $addrNames = $provincename.$format. $cityname.$format.$countyname;
        else
         return "";
    }
 
}
