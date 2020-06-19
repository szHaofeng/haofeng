<?php
class MerconfigEntity extends BaseEntity
{
    protected $table="mer_config";
    protected $table_zh="商户配置";
    protected $alias="cf";
    protected function buildModel(&$model,&$fields,&$join) {
        $model=new Model("$this->table as $this->alias");
        $fields="$this->alias.*,mer.merchant_name,mer.province,mer.city,mer.county";
        $join=" left join mer_merchant as mer on $this->alias.mer_id=mer.id";
        return true;
    }
    //保存前验证
    public function saveValidator(&$extend,&$errmsg){
       
        $domain_prefix=Filter::sql(Req::post("domain_prefix"));
        if ($domain_prefix) {
        $where="(domain_prefix='$domain_prefix')";
            $m=$this->findWhere($where);
            if ($m) {
                $errmsg="域名已经被使用,请使用其他域名！";
                return false;
            }
        }
        return true;
    }

}
