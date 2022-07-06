<?php 

class Driver extends Model {

    public function __construct()
    {
        $table = 'employee';
        parent::__construct($table);
    }
}