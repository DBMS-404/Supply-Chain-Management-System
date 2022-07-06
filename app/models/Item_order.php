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

    public function getcountofType($type){
        if ($type==='all'){
            return count($this->getallOrders());
        }
        return count($this->getorderofstatus($type));
    }

    public function getCustomerOrderDetailsAction($first_date, $second_date){
        $q="";$r="";$s="";
        if($first_date=="" and $second_date==""){
        }elseif($first_date=="" and $second_date!=""){
            $q =" item_order.date <= '".$second_date."'";
            $r=" where";
            $s=" and";
        }elseif($first_date!="" and $second_date==""){
            $q=" item_order.date >= '".$first_date."'";
            $r=" where";
            $s=" and";
        }else{
            $q=" item_order.date <= '".$second_date."'  and item_order.date >= '".$first_date."'";
            $r=" where";
            $s=" and";
        }

        $resultsQuery=[];
        $sql ="select user_id, first_name, last_name, count(user_id)  as order_count, sum(weight) as tot_weight
        from item_order left outer join user using(user_id)".$r.$q.
        " group by user_id
        order by order_count;";

        if($this->_db->query($sql)){
            $resultsQuery = $this->_db->results();
        }
        //dnd($resultsQuery);
        $statusQuery=[];
        foreach($resultsQuery as $user){
            $sql1="select status, count(status) as status_count
            from item_order
            where user_id='".$user->user_id."'".$s.$q.
            " group by status
            order by status_count desc;";
            //dnd($sql1);
            if($this->_db->query($sql1)){    
                //$temp=(array)$user;
                //dnd(array_push($temp,$this->_db->results()));
                array_push($statusQuery,$this->_db->results());
            }    
        }
        return [$resultsQuery,$statusQuery];
    }
    
}