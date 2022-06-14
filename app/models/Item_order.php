<?php 

class Item_order extends Model {

    public function __construct()
    {
        $table = 'item_order';
        parent::__construct($table);
    }

    public function getallOrders(){
        return $this->find([
            "order"=>"status desc"
        ]);
    }

    public function getorderofstatus($status){
        return $this->find([
            "condition"=>"status = ?",
            "bind" => $status
        ]);
    }

    public function changeStatus($id,$status){
        $sql = "update {$this->table} set status=? where order_id=?";
        $this->db->query($sql,[$status,$id]);
    }




}