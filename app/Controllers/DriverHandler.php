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
        $this->view->render('driver/applyLeave');


    }

    public function applyLeaveAction() {
        $this->view->render('driver/applyLeave');
    }

    public function turnCompletionAction() {
        $driver_id = User::currentLoggedInUser();
        $turn = new Turn();
        $results = $turn->getOngoingTurn($driver_id);
        if ($results === []) {
            $this->view->ongoingTurns = 0;
        }else{
            $this->view->ongoingTurns = $results;
        }
        $this->DriverModel = new Driver();
        $this->view->remainingOrders = $this->DriverModel->getRemainingOrders($driver_id);
        $this->view->render('driver/turnCompletion');
    }

    public function sendLeaveAction() {
        $user_id = User::currentLoggedInUser();
        $employee_leave = new Employee_leave();
        $employee_leave->saveLeave($_POST, $user_id);

        $this->view->alert = 'Success';
        $this->view->render('driver/applyLeave');
    }
}