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
        $this->view->render('driver/dashboard');
    }
}