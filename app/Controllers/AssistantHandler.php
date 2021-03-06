<?php 

class AssistantHandler extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model('Driver_assistant');
        $this->load_model("Item_order");
        $this->load_model("Turn_order");
        $this->load_model("Turn");
        $this->load_model("Route");
        $this->load_model("Truck");
    }

    public function indexAction() {
        //unsetSessionExcept();   
        $this->view->turns = $this->TurnModel->findbyAssistantId(User::currentLoggedInUser());
        foreach ($this->view->turns as $key) {
            $key->route_map = $this->RouteModel->getRouteMap($key->route_id)->route_map;
            $key->truck_no = $this->TruckModel->getTruckNo($key->truck_id)->truck_no;
            $key->avg_time = $this->RouteModel->getRouteMap($key->route_id)->maximum_completion_time;
        }
        $this->view->render('driver_assistant/dashboard');
    }

    public function viewordersAction($t_id){
        $this->view->t_id = $t_id;
        $this->view->orders = $this->Item_orderModel->getDtruckOrders();
        $this->view->d_orders = $this->Turn_orderModel->getDelOrders($t_id); 
        $this->view->render('driver_assistant/shipped_orders');
    }

    public function completeOneOrderAction($t_id, $order_id){
        $this->Item_orderModel->changeStatus($order_id, "delivered");
        $this->view->orders = $this->Item_orderModel->getDtruckOrders();
        $this->view->t_id = $t_id;
        $this->view->alert = 'Success';
        $this->view->d_orders = $this->Turn_orderModel->getDelOrders($t_id);
        $this->view->render('driver_assistant/shipped_orders');
    }

    public function applyLeaveAction() {
        $this->view->render('driver_assistant/applyLeave');
    }

    public function sendLeaveAction() {
        $user_id = User::currentLoggedInUser();
        $employee_leave = new Employee_leave();
        $employee_leave->saveLeave($_POST, $user_id);

        $this->view->alert = 'Success';
        $this->view->render('driver_assistant/applyLeave');
    }

}