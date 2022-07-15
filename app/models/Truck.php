<?php 

class Truck extends Model {

    public function __construct()
    {
        $table = 'truck';
        parent::__construct($table);
    }

    public function getTruckNo($id){
        $truck = new Truck();
        $truck->findFirst(['conditions' => 'truck_id=?', 'bind' => [$id]]);
        return $truck;
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
        
        $sql= "select truck_id, tot_time, truck.truck_no, city.name
        from((select truck_id, round(Hour(sum(TIMEDIFF(turn_end_time,turn_start_time))) + Minute(sum(TIMEDIFF(turn_end_time,turn_start_time)))/60,2) as tot_time
             from turn
             where turn_end_time is not null".$q.
             " group by truck_id
             order by tot_time) as truck_hours left outer join truck using(truck_id)) left outer join city using(city_id);";

        
        if($this->_db->query($sql)){
            $resultsQuery = $this->_db->results();
        }


        return $resultsQuery;
    }

}