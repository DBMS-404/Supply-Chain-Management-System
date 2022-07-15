<?php 

class Driver extends Model {

    public function __construct()
    {
        $table = 'driver';
        parent::__construct($table);
    }

    
    public function getOngoingTurn($driver_id){
        $sql = "SELECT * FROM turn WHERE turn_end_time is null and turn_start_time is not null and driver_id = ? ";
        $resultsQuery = $this->_db->query($sql,[$driver_id]);
        return $resultsQuery->results();
        
    }

    public function getRemainingOrders($driver_id){
        $sql = "SELECT COUNT(driver_id) AS CountDriver FROM driver_assistant_order WHERE driver_id = ? ";
        $resultsQuery = $this->_db->query($sql,[$driver_id]);
        $result = $resultsQuery->results();
        return $result[0]-> CountDriver;
    }

    public function getRouteMap ($route_id){
        $sql = "SELECT route_map FROM route  WHERE  route_id = ? ";
        $resultsQuery = $this->_db->query($sql,[$route_id]);
        $result = $resultsQuery->results();
        return $result[0]-> route_map;

    }

    public function recordTurnCompletion($turn_id){
        date_default_timezone_set('Asia/Colombo');
        $turn_end_time  = date("Y-m-d H:i:s");

        $sql1 = "UPDATE turn SET turn_end_time=? where turn_id=?";

        $this->_db->query($sql1,[$turn_end_time,$turn_id]);

    }

    public function getWorkingHours($first_date, $second_date){
        if($first_date=="" and $second_date==""){
            $q = "";
        }elseif($first_date=="" and $second_date!=""){
            $q = " and turn.scheduled_date <= '".$second_date."'";
        }elseif($first_date!="" and $second_date==""){
            $q=" and turn.scheduled_date >= '".$first_date."'";
        }else{
            $q=" and turn.scheduled_date <= '".$second_date."' and turn.scheduled_date >= '".$first_date."'";
        }
        $resultsQuery=[];
        $sql="select driver_id, user.first_name, user.last_name, driver_hours.tot_time
        from (select driver_id, round(Hour(sum(TIMEDIFF(turn_end_time,turn_start_time))) + Minute(sum(TIMEDIFF(turn_end_time,turn_start_time)))/60,2) as tot_time
        from turn
        where turn_end_time is not null".$q.
                     " group by driver_id
                     order by tot_time) as driver_hours,user
        where user.user_id = driver_hours.driver_id;";
        if($this->_db->query($sql)){
            $resultsQuery = $this->_db->results();
        }
        

        return $resultsQuery;
    }



}