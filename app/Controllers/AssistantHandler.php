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

    public function completeOneOrderAction($order_id){
        $this->Item_orderModel->changeStatus($order_id, "delivered");
        $this->view->orders = $this->Item_orderModel->getDtruckOrders();
        $this->view->render('driver_assistant/shipped_orders');
    }

    public function sendLeaveAction() {
        $user_id = User::currentLoggedInUser();
        $employee_leave = new Employee_leave();
        $employee_leave->saveLeave($_POST, $user_id);

        $this->view->alert = 'Success';
        $this->view->render('driver_assistant/applyLeave');
    }

}