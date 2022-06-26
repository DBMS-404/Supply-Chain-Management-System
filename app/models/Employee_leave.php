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

    public function getleavebystatusandcity($status, $city){
        $sql = "SELECT * FROM future_leaves_details WHERE status = ? AND city = ? ";

//        $sql = "SELECT * FROM employee_leave LEFT JOIN employee
//                    ON employee.user_id = employee_leave.user_id
//                    LEFT JOIN user ON user.user_id = employee_leave.user_id
//                    WHERE employee_leave.status = ? AND employee.city = ?
//                    AND employee_leave.date > CURRENT_DATE()
//                    ORDER BY employee_leave.date";

        $resultsQuery = $this->_db->query($sql,[$status, $city]);
        $results = [];

        if (!$resultsQuery) return $results;
        return $resultsQuery->results();

    }

    public function getleavebyid($id){
        $sql = "SELECT leave_id, first_name, last_name, date, city_name, leave_reason, mobile_no
                    FROM future_leaves_details WHERE leave_id = ?";

//        $sql = "SELECT employee_leave.leave_id AS leave_id, user.first_name AS firstName, user.last_name AS lastName, employee_leave.date AS leaveDate,
//                    city.name AS city, employee_leave.leave_reason AS reason, employee.mobile_no As mobile
//                    FROM employee_leave LEFT JOIN employee
//                    ON employee_leave.user_id = employee.user_id
//                    LEFT JOIN user
//                    ON user.user_id = employee_leave.user_id
//                    LEFT JOIN city
//                    ON employee.city = city.city_id
//                    WHERE employee_leave.leave_id = ?";

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