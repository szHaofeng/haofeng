<?php
class MerchantEntity extends BaseEntity
{
    protected $table="mer_merchant";
    protected $table_zh="商户管理";
    //状态样式
    public $lableMap = array(
        "0"=>"default",
        "1"=>"primary",
        "2"=>"warning",
        "3"=>"success",
        "4"=>"danger",
        "5"=>"primary"
    );

    //状态列表
    public $statusMap = array (
        "1"=>"待审核",
        "2"=>"正常",
        "3"=>"禁止",
    );
    
    protected function parseRow($row) {

        $row=parent::parseRow($row);

        if (array_key_exists("is_grantofetp", $row) && $row['is_grantofetp']) 
            $row['grantofetp']='是';
        else
            $row['grantofetp']=' 否';
        if (array_key_exists("is_grantofgov", $row) && $row['is_grantofgov']) 
            $row['grantofgov']='是';
        else
            $row['grantofgov']=' 否';

        return $row;
        
    } 

    //保存前验证
    public function saveValidator(&$extend,&$errmsg){
        $id=Filter::int(Req::post("id"));
        $mobile=Filter::sql(Req::post("mobile"));
        if ($mobile) {
        $where="(id<>$id) and (mobile='$mobile')";
            $m=$this->findWhere($where);
            if ($m) {
                $errmsg="手机号码已经被使用,请使用其他号码！";
                return false;
            }
        }

        if (!$id) {
            $where="name='".Filter::sql(Req::post("name"))."'";
            $m=$this->findWhere($where);
            if ($m) {
                $errmsg="账户已经被注册,请使用其他账号！";
                return false;
            }
            $name=Filter::sql(Req::post("name"));
            $extend["name"]=$name;
            //$extend["full_name"]=$name;
            $extend["status"]=1;
            $validcode=CHash::random(8);
            $password=Common::generatePWord(Req::post("password"),$validcode);
            $extend["validcode"]=$validcode;
            $extend["password"]=$password;
        }
        return true;
    }

}
