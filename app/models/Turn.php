<?php

class Turn extends Model {

    public function __construct()
    {
        $table = 'turn';
        parent::__construct($table);
    }

    public function addTurn($route_id, $truck_id, $driver_id,$assistant_id){
        $this->driver_id = $driver_id;
        $this->assistant_id = $assistant_id;
        $this->route_id = $route_id;
        $this->truck_id = $truck_id;
        date_default_timezone_set('Asia/Colombo');
        $this->scheduled_date  = date("Y-m-d");
        $this->scheduled_time = date('H:i:s');
        $this->save();
    }

    public function dispatchTruck($turn_id, $route_id){
        date_default_timezone_set('Asia/Colombo');
        $turn_start_time  = date("Y-m-d H:i:s");

        $sql1 = "update turn set turn_start_time=? where turn_id=?";
        $sql2 = "update item_order set status='dtruck' where route_id=? AND status = 'ctrain'";


        $this->_db->beginTransaction();

        try{
            $this->_db->query($sql1,[$turn_start_time,$turn_id]);
            $this->_db->query($sql2,[$route_id]);
        }catch (Exception $e){
            $this->_db->rollBack();
        }

        $this->_db->commit();

    }

    public function findbyAssistantId($id){
        return $this->find(['conditions' => 'assistant_id=? AND turn_end_time IS NULL', 'bind' => [$id]]);
        
    }

}