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
        $sql="select assistant_id, assistant_name, sum(tot_time) as tot_time
        from total_hours".$q.
        " group by assistant_id,assistant_name
        order by tot_time desc;";
        if($this->_db->query($sql)){
            $resultsQuery = $this->_db->results();
        }


        return $resultsQuery;
    }

}