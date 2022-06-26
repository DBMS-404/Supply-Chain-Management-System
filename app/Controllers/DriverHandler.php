<?php 

class DriverHandler extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model('Driver');
    }

    public function indexAction() {
        //unsetSessionExcept();   
        $this->turnCompletionAction();

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