<?php 

class Item extends Model {

    public function __construct()
    {
        $table = 'item';
        parent::__construct($table);
    }

    public function findAllIteams(){
        return $this->find([]);
    }

    public function findbyitemId($id){
        $this->findFirst(['conditions' => 'item_id=?', 'bind' => [$id]]);
    }

    public function addItem($params){
        $this->assign($params);
        $this->save();
    }

    public function updateItem($id,$params){
        $sql = "update item set name=?,available_count=?,unit_price=? where item_id=?";
        $this->_db->query($sql,[$params['name'],$params['available_count'],$params['unit_price'],$id]);
    }

    public function getValues(){
        $values['item_id'] = $this->item_id;
        $values['name'] = $this->name;
        $values['available_count'] = $this->available_count;
        $values['unit_price'] = $this->unit_price;
        return $values;
    }

    public function delete($id){
        $sql = "delete from item where item_id=?";
        $this->_db->query($sql,[$id]);
    } 
}