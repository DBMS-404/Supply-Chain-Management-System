<?php 

class DriverHandler extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model('Driver');
        $this->load_model("Turn");
        $this->load_model("Route");
        $this->load_model("Truck");
    }

    public function indexAction() {
        //unsetSessionExcept();
        $this->view->turns = $this->TurnModel->findbyDriverId(User::currentLoggedInUser());
        foreach ($this->view->turns as $key) {
            $key->route_map = $this->RouteModel->getRouteMap($key->route_id)->route_map;
            $key->truck_no = $this->TruckModel->getTruckNo($key->truck_id)->truck_no;
            $key->avg_time = $this->RouteModel->getRouteMap($key->route_id)->maximum_completion_time;
        }
        $this->view->render('driver/dashboard');   

    }

    public function applyLeaveAction() {
        $this->view->render('driver/applyLeave');
    }

    public function turnCompletionAction() {
        $driver_id = User::currentLoggedInUser();
        $this->DriverModel = new Driver();

        $results = $this->DriverModel->getOngoingTurn($driver_id);

        $this->view->remainingOrders = $this->DriverModel->getRemainingOrders($driver_id);
        
        if ($results === []) {
            $this->view->ongoingTurns = 0;
        }else{
            $route_id = $results[0]->route_id;
            $this->view->route_map = $this->DriverModel->getRouteMap($route_id);
            $this->view->ongoingTurns = $results;
        }

        $this->view->render('driver/turnCompletion');
    }

    public function sendLeaveAction() {
        $user_id = User::currentLoggedInUser();
        $employee_leave = new Employee_leave();
        $employee_leave->saveLeave($_POST, $user_id);

        $this->view->alert = 'Success';
        $this->view->render('driver/applyLeave');
    }

    public function recordTurnCompletionAction($turn_id){
        $this->DriverModel = new Driver();

        $this->DriverModel->recordTurnCompletion($turn_id);

        $this->turnCompletionAction();

    }
}