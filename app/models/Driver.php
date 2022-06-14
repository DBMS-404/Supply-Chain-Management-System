<?php 

class Driver extends Model {

    public function __construct()
    {
        $table = 'driver';
        parent::__construct($table);
    }

}