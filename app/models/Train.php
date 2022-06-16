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

    public function findbytrainId($id){
        $this->findFirst(['conditions' => 'train_id=?', 'bind' => [$id]]);
    }

    public function update_capacity($id,$capacity){
        $sql = "update train set filled_capacity=? where train_id=?";
        $this->_db->query($sql,[$capacity,$id]);
    }

}