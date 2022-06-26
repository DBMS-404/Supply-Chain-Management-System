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
        $sql = "SELECT DISTINCT route_id FROM order_details WHERE city_id = ? AND status = 'dtrain' AND route_id NOT IN(SELECT route_id FROM turns_to_dispatch)";

        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();
    }

    public function getTurnsToDispatch(){

        $sql = "SELECT * FROM turns_to_dispatch WHERE city_id = ? ";
        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();

    }

}