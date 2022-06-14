<?php 

class Train extends Model {

    public function __construct()
    {
        $table = 'train';
        parent::__construct($table);
    }

    public function gettrains(){
        return $this->find([]);
    }

}