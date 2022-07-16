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
        $params['is_deleted'] = 0;
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
    
    public function highestOrderedItems($first_date, $second_date){
        if($first_date=="" and $second_date==""){
            $q = "";
            $params=['delivered'];
        }elseif($first_date=="" and $second_date!=""){
            $q = " and item_order.date <= ?";
            $params=['delivered', $second_date];
        }elseif($first_date!="" and $second_date==""){
            $q=" and item_order.date >= ?";
            $params = ['delivered', $first_date];
        }else{
            $q=" and item_order.date <= ? and item_order.date >= ?";
            $params = ['delivered', $second_date, $first_date];
        }

        $sql= "select item_id, name, item_count, unit_price
        from(select item_id, count(item_id) as item_count
            from (select *
            from item_assignment
            where item_assignment.order_id in (select order_id
                                               from item_order where status= ?".$q.")) as item_assignment_new group by item_id) as item_count_table left outer join item using(item_id)
        order by item_count desc
        limit 5;";

        if($this->_db->query($sql,$params)){
            $resultsQuery = $this->_db->results();
        }


        return $resultsQuery;

        
    }
}