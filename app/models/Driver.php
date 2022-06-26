<?php 

class Driver extends Model {

    public function __construct()
    {
        $table = 'driver';
        parent::__construct($table);
    }

    public function getRemainingOrders($driver_id){
        $sql = "SELECT COUNT(driver_id) AS CountDriver FROM driver_assistant_order WHERE driver_id = ? ";
        $resultsQuery = $this->_db->query($sql,[$driver_id]);
        $result = $resultsQuery->results();
        return $result[0]-> CountDriver;
    }

}