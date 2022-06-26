<?php 

class Truck extends Model {

    public function __construct()
    {
        $table = 'truck';
        parent::__construct($table);
    }

    public function getTruckNo($id){
        $truck = new Truck();
        $truck->findFirst(['conditions' => 'truck_id=?', 'bind' => [$id]]);
        return $truck;
    }

}