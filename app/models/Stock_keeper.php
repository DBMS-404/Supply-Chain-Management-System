<?php 

class Driver extends Model {

    public function __construct()
    {
        $table = 'stock_keeper';
        parent::__construct($table);
    }

}