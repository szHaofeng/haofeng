<?php
class IndustryService
{
    public static function roleMap(int $status) {
        if ($status==1) {
            $conditions=array("status"=>1);
        } elseif($status==2) {
            $conditions=array("ne_status"=>1);
        } else {
            $conditions=array('status'=>1);
        }
        
        $entity=new MerindustryEntity();
        $depts=$entity->queryAll($conditions,"name");
        $map=array();
        foreach ($depts as $key => $dept) {
            $map[$dept['id']]=$dept['name'];
        }
        return $map;
    }
    public static function IndustryName($id) {
        $doc=(new MerindustryEntity())->findWhere("id=".$id,'name'); 
        return $doc['name'];
    }
   
   
}
