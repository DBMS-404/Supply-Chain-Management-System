<?php 

class Item extends Model {

    public function __construct()
    {
        $table = 'item';
        parent::__construct($table);
    }

    public function findAllIteams(){
        return $this->find([
            'conditions' => 'is_deleted=?',
            'bind'=>[0]
        ]);
    }

    public function findbyitemId($id){
        $this->findFirst(['conditions' => 'item_id=? and is_deleted=?', 'bind' => [$id,0]]);
    }

    public function addItem($params){
        $params['deleted'] = 0;
        $this->assign($params);
        $this->save();
    }

    public function updateItem($id,$params){
        $sql = "update item set name=?,available_count=?,unit_price=?,is_deleted=? where item_id=?";
        $this->_db->query($sql,[$params['name'],$params['available_count'],$params['unit_price'],0,$id]);
    }

    public function getValues(){
        $values['item_id'] = $this->item_id;
        $values['name'] = $this->name;
        $values['available_count'] = $this->available_count;
        $values['unit_price'] = $this->unit_price;
        $values['is_deleted'] = $this->is_deleted;
        return $values;
    }

    public function delete($id){
        $sql = "update item set is_deleted=? where item_id=?";
        $this->_db->query($sql,[1,$id]);
    } 
}