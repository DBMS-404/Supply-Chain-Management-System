<?php 

class Item_order extends Model {

    public function __construct()
    {
        $table = 'item_order';
        parent::__construct($table);
    }

    public function getallOrders(){
        return $this->find([
            "order"=>"status"
        ]);
    }

    public function getorderofstatus($status){
        return $this->find([
            "conditions"=>"status = ?",
            "bind" => [$status]
        ]);
    }

    public function changeStatus($id,$status){
        $sql = "update item_order set status=? where order_id=?";
        $this->_db->query($sql,[$status,$id]);
    }

    public function findbyOrderId($id){
        $this->findFirst(['conditions' => 'order_id=?', 'bind' => [$id]]);
    }
    
}