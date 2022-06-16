<?php 

class Train_assignment extends Model {

    public function __construct()
    {
        $table = 'train_assignment';
        parent::__construct($table);
    }

    public function make_assignment($train_id,$order_id){
        $this->train_id = $train_id;
        $this->order_id = $order_id;
        date_default_timezone_set('Asia/Colombo');
        $this->assigned_date  = date("Y-m-d");
        $this->assigned_time = date('H:i:s');
        $this->save();
    }

}