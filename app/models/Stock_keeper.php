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

        $sql = "SELECT distinct truck.* FROM truck WHERE city_id = ? AND truck_id 
                    NOT IN (SELECT DISTINCT truck_id FROM turns_in_progress)";
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
        $sql = "SELECT DISTINCT route_id, start_city_name, end_city_name, city FROM item_order 
                    INNER JOIN route_details using(route_id) WHERE city=? AND status = 'ctrain' AND 
                    route_id NOT IN(SELECT route_id FROM turns_to_dispatch)";

        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();
    }

    public function getTurnsToDispatch(){

        $sql = "SELECT turn_id, route_id, driver_name, assistant_name, truck_no, start_city_name, end_city_name, assistant_id 
                    FROM turns_to_dispatch INNER JOIN route_details using(route_id) WHERE city_id = ? ";
        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);
        $results = [];

        if (!$resultsQuery){
            return $results;
        }

        return $resultsQuery->results();
    }

    public function getAssistantsInProgress(){
        $sql = "SELECT assistant_id FROM turns_in_progress WHERE NOT(turn_start_time IS NULL)";
        $results = [];

        $resultsQuery = $this->_db->query($sql);

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

    public function getCountOfTrainOrders($train){
        if ($train==='all'){
            return count($this->getOrdersdDispatchedByTrainToCity());
        }
        return count($this->getOrdersdDispatchedByTrainToCityByTrain($train));
    }

    public function getOrdersdDispatchedByTrainToCity(){

        $sql = "SELECT * FROM train_dispatched_orders WHERE city_id = ?";

        $results = [];
        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();
    }

    public function getOrdersdDispatchedByTrainToCityByTrain($train_id){

        $sql = "SELECT * FROM train_dispatched_orders WHERE city_id = ? AND train_id=?";

        $results = [];
        $resultsQuery = $this->_db->query($sql,[$this->getCity(), $train_id]);

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();
    }

    public function addTurn($route_id, $truck_id, $driver_id,$assistant_id){
        date_default_timezone_set('Asia/Colombo');
        $scheduled_date  = date("Y-m-d");
        $scheduled_time = date('H:i:s');
        $sql1 = "INSERT INTO turn(driver_id, assistant_id, route_id, truck_id, scheduled_date, scheduled_time)
                    VALUES ('$driver_id', '$assistant_id', '$route_id', '$truck_id', '$scheduled_date', '$scheduled_time')";
        $sql2 = "UPDATE driver_assistant SET cons_turn_count = cons_turn_count + 1 WHERE user_id = '$assistant_id'";

        $this->_db->beginTransaction();

        try{
            $this->_db->query($sql1);
            $this->_db->query($sql2);
        }catch (Exception $e){
            $this->_db->rollBack();
        }

        $this->_db->commit();

    }

    public function cancelTurn($turn_id){
        $sql1 = "UPDATE driver_assistant SET cons_turn_count = cons_turn_count - 1 WHERE user_id IN(
                    SELECT assistant_id FROM turn WHERE turn_id=?)";
        $sql2 = "delete from turn where turn_id=?";
        $this->_db->beginTransaction();

        try{
            $this->_db->query($sql1,[$turn_id]);
            $this->_db->query($sql2,[$turn_id]);
        }catch (Exception $e){
            $this->_db->rollBack();
        }

        $this->_db->commit();

    }

}