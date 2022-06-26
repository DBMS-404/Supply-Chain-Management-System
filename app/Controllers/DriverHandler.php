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