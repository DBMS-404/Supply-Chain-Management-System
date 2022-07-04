<?php 

class Train extends Model {

    public function __construct()
    {
        $table = 'train';
        parent::__construct($table);
    }

    public function gettrains(){
        return $this->find([
            'conditions' => 'is_deleted=?',
            'bind'=>[0]
        ]);
    }

    public function update_capacity($id,$capacity){
        $sql = "update train set filled_capacity=? where train_id=?";
        $this->_db->query($sql,[$capacity,$id]);
    }

    public function deleteTrain($id){
        $sql = "update train set is_deleted=? where train_id=?";
        $this->_db->query($sql,[1,$id]);
    }

    public function updateTrain($train_id,$params){
        $sql = "update train set train_name=?,arrival_day=?,arrival_time=?,destination=?, capacity=?, filled_capacity=? where train_id=?";
        $this->_db->query($sql,[$params['train_name'],$params['arrival_day'],$params['arrival_time'],$params['destination'],$params['capacity'], $params['filled_capacity'], $train_id]);
    }

    public function getValues(){
        $values['train_id'] = $this->train_id;
        $values['train_name'] = $this->train_name;
        $values['arrival_day'] = $this->arrival_day;
        $values['arrival_time'] = $this->arrival_time;
        $values['destination'] = $this->destination;
        $values['capacity'] = $this->capacity;
        $values['filled_capacity']= $this->filled_capacity;
        return $values;
    }

    public function findbytrainId($id){
        $this->findFirst(['conditions' => 'train_id=? and is_deleted=?', 'bind' => [$id,0]]);
    }

    public function addTrain($params){
        $params['is_deleted'] = 0;
        $params['filled_capacity'] = 0;
        $this->assign($params);
        $this->save();
    }
}