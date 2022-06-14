<?php 

class ManagerHandler extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
    }

    public function indexAction() {
        //unsetSessionExcept();   
        $this->view->render('manager/dashboard');
    }
}