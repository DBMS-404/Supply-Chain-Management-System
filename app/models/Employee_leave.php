<?php

/*
 * status -> state
 * 0 -> pending
 * 1 -> approved
 * 2 -> declined
 */

class Employee_leave extends Model {

    public function __construct()
    {
        $table = 'employee_leave';
        parent::__construct($table);
    }

    public function getLeavesByStatusAndCity($status, $city){
        $sql = "SELECT * FROM future_leaves_details WHERE status = ? AND city = ? ";

        $resultsQuery = $this->_db->query($sql,[$status, $city]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();

    }

    public function getLeaveById($id){
        $sql = "SELECT leave_id, first_name, last_name, date, city_name, leave_reason, mobile_no
                    FROM future_leaves_details WHERE leave_id = ?";

        $resultsQuery = $this->_db->query($sql,[$id]);

        if (!$resultsQuery) return null;

        return $resultsQuery->first();
    }

    public function changeStatus($id,$status){
        $sql = "update employee_leave set status=? where leave_id=?";
        $this->_db->query($sql,[$status,$id]);
    }

    public function saveLeave($params, $user_id){
        $params['user_id'] =$user_id;
        $params['status'] =0;
        $this->assign($params);
        $this->save(); 
    }
}