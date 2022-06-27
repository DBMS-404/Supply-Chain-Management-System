<?php 

class Turn_order extends Model {

    public function __construct()
    {
        $table = 'turn_order';
        parent::__construct($table);
    }

    public function getDelOrdersIds($t_id){
        return $this->find([
            "conditions"=>"turn_id = ?",
            "bind" => [$t_id]
        ]);
    }

    public function getDelOrders($t_id){
        $ids = $this->getDelOrdersIds($t_id);
        $d_orders = [];
        foreach ($ids as $value) {
            $order = new Item_order();
            $order->findbyOrderId($value->order_id);
            $order->delivered_time = $value->delivered_time;
            $d_orders[] = $order;
        }
        return $d_orders;
    }

}