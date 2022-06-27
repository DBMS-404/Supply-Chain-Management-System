<?php 

class Stock_keeper extends Model {

    public function __construct()
    {
        $table = 'stock_keeper';
        parent::__construct($table);
    }

    public function getCity(){

        $skObj = $this->find([
            "conditions"=>"user_id = ?",
            "bind" => [$_SESSION["user_id"]]
        ]);

        return $skObj[0]->city;
    }

    public function getAvailableTrucks(){

        $sql = "SELECT * FROM available_trucks WHERE city_id = ? ";
        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();

    }

    public function getAvailableDrivers($maximum_completion_time){

        $available_hours = 40 - $maximum_completion_time;
        $sql = "SELECT * FROM available_drivers WHERE city = ? AND weekly_worked_hours <= ?";
        $resultsQuery = $this->_db->query($sql,[$this->getCity(), $available_hours]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();

    }

    public function getAvailableAssistants($maximum_completion_time){

        $available_hours = 60 - $maximum_completion_time;
        $sql = "SELECT * FROM available_assistants WHERE city = ? AND weekly_worked_hours <= ?";
        $resultsQuery = $this->_db->query($sql,[$this->getCity(), $available_hours]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();

    }

    public function getRouteIdsForAssign(){
        $sql = "SELECT route_id, start_city_name, end_city_name, city FROM item_order 
                    INNER JOIN route_details using(route_id) WHERE city=? AND status = 'ctrain' AND 
                    route_id NOT IN(SELECT route_id FROM turns_to_dispatch)";

        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();
    }

    public function getTurnsToDispatch(){

        $sql = "SELECT turn_id, route_id, driver_name, assistant_name, truck_no, start_city_name, end_city_name 
                    FROM turns_to_dispatch INNER JOIN route_details using(route_id) WHERE city_id = ? ";
        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();

    }

    public function markAsRecieved($order_id, $train_id, $new_filled_capacity){

        $sql1 = "update item_order set status='ctrain' where order_id=?";
        $sql2 = "update train set filled_capacity=? where train_id=?";


        $this->_db->beginTransaction();

        try{
            $this->_db->query($sql1,[$order_id]);
            $this->_db->query($sql2,[$new_filled_capacity, $train_id]);
        }catch (Exception $e){
            $this->_db->rollBack();
        }

        $this->_db->commit();
    }

}