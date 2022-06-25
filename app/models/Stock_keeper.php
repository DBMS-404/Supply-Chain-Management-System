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

    public function getOrdersdDispatchedByTrain(){

        $sql = "SELECT * FROM train_dispatched_orders WHERE city_id = ?";

        $results = [];
        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();

    }


}