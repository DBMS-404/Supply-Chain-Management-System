<?php 

class AssistantHandler extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model('Driver_assistant');
        $this->load_model("Item_order");
    }

    public function indexAction() {
        //unsetSessionExcept();   
        $this->view->render('driver_assistant/dashboard');
    }

    public function viewordersAction(){
        $this->view->orders = $this->Item_orderModel->getDtruckOrders();
        $this->view->render('driver_assistant/shipped_orders');
    }

}