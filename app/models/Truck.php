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
        
        $sql= "select truck_id, truck_no, truck_city, sum(tot_time) as tot_time
        from total_hours".$q.
        " group by truck_id,truck_no,truck_city
        order by tot_time desc;";

        
        if($this->_db->query($sql)){
            $resultsQuery = $this->_db->results();
        }


        return $resultsQuery;
    }

}