<?php

class Route extends Model {

    public function __construct()
    {
        $table = 'route';
        parent::__construct($table);
    }

    public function getMaximumCompletionTime($route_id){
        $skObj = $this->find([
            "conditions"=>"route_id = ?",
            "bind" => [$route_id]
        ]);

        return $skObj[0]->maximum_completion_time;
    }

    public function getRouteMap($id){
        $route = new Route();
        $route->findFirst(['conditions' => 'route_id=?', 'bind' => [$id]]);
        return $route;
    }

}