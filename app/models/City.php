<?php 

class City extends Model {

    public function __construct()
    {
        $table = 'city';
        parent::__construct($table);
    }

    public function getAllCIties(){
        $this->_db->query("select city_id, name from city order by name;");
        return $this->_db->results();
    }
}