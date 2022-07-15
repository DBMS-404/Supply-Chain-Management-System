<?php 

class Driver_assistant extends Model {

    public function __construct()
    {
        $table = 'driver_assistant';
        parent::__construct($table);
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
        $sql="select assistant_id, user.first_name, user.last_name, assistant_hours.tot_time
        from (select assistant_id, round(Hour(sum(TIMEDIFF(turn_end_time,turn_start_time))) + Minute(sum(TIMEDIFF(turn_end_time,turn_start_time)))/60,2) as tot_time
                     from turn
                     where turn_end_time is not null".$q.
                     " group by assistant_id
                     order by tot_time) as assistant_hours,user
        where user.user_id = assistant_hours.assistant_id;";
        if($this->_db->query($sql)){
            $resultsQuery = $this->_db->results();
        }


        return $resultsQuery;
    }

}