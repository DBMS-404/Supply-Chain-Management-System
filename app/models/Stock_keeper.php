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
        $sql = "SELECT item_order.order_id, item_order.address, item_order.weight 
                    FROM train_assignment LEFT JOIN item_order 
                    ON train_assignment.order_id = item_order.order_id 
                    LEFT JOIN train ON train.train_id = train_assignment.train_id
                    WHERE item_order.status = 'dtrain' AND train.destination = ?";

        $results = [];
        $resultsQuery = $this->_db->query($sql,[$this->getCity()]);
        if (!$resultsQuery) return $results;
        foreach ($resultsQuery as $result) {
            $obj = new $this->_modelName($this->_table);
            $obj->populateObjData($result);
            $results[] = $obj;
        }

        return $results;


    }


}