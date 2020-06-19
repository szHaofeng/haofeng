<?php
class MerchantEntity extends BaseEntity
{
    protected $table="mer_merchant";
    protected $table_zh="商户管理";
    protected $alias="mer";
    //状态样式
    public $lableMap = array(
        "0"=>"default",
        "1"=>"primary",
        "2"=>"success",
        "3"=>"warning",
        "4"=>"danger",
        "5"=>"primary"
    );

    //状态列表
    public $statusMap = array (
        "1"=>"待审核",
        "2"=>"正常",
        "3"=>"禁止",
    );
    public $feestatus = array (
        "1"=>"正常",
        "2"=>"欠费",
    );
    protected function parseRow($row) {
        $row=parent::parseRow($row);
        if(array_key_exists('fee_status',$row) && $row['fee_status']){
            $row["feestatusname"]=Common::statusMap($this->feestatus,$row["fee_status"]);
            $row["feelabel"]=Common::statusMap($this->lableMap,$row["feestatusname"],"success");
        }
        return $row;
    } 
    protected function buildModel(&$model,&$fields,&$join) {
        $model=new Model("$this->table as $this->alias");
        $fields="$this->alias.*,ind.name as industry_name";
        $join=" left join mer_industry as ind on $this->alias.industry_id=ind.id";
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
        return true;
    }

}
