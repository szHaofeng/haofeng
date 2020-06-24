<?php
class MeruserEntity extends BaseEntity
{
    protected $table="mer_users";
    protected $table_zh="商户账号";
    protected $alias="u";
    protected function buildModel(&$model,&$fields,&$join) {
        $model=new Model("$this->table as $this->alias");
        $fields="$this->alias.*,mer.merchant_name";
        $join=" left join mer_merchant as mer on $this->alias.mer_id=mer.id";
        return true;
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
            $extend["status"]=1;
            $validcode=CHash::random(8);
            $password=Common::generatePWord(Req::post("password"),$validcode);
            $extend["validcode"]=$validcode;
            $extend["password"]=$password;
        }
        return true;

    }

}
