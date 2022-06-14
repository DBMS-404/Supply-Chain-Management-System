<?php 

class AssistantHandler extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model('Driver_assistant');
    }

    public function indexAction() {
        //unsetSessionExcept();   
        $this->view->render('driver_assistant/dashboard');
    }
}