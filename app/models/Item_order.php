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

    public function getDtruckOrders(){
        $sql = "SELECT order_id,route_map FROM driver_assistant_order WHERE assistant_id=?";
        $this->_db->query($sql,[User::currentLoggedInUser()]);
        return $this->getOrdersByIds($this->_db->results());
    }
    
    public function getOrdersByIds($order_ids){
        $orders = [];
        foreach ($order_ids as $id) {
            $order = new Item_order();
            $order->findbyOrderId($id->order_id);
            $order->route_map = $id->route_map;
            $orders[] = $order;
        }
        return $orders;
    }

    public function getOrdersdDispatchedByTrainUsisngCityID($city_id){

        $sql = "SELECT * FROM train_dispatched_orders WHERE city_id = ?";

        $results = [];
        $resultsQuery = $this->_db->query($sql,[$city_id]);

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();
    }
    
}