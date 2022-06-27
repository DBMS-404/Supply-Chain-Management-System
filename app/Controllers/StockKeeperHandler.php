<?php

class StockKeeperHandler extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model("Stock_keeper");
        $this->load_model("Item_order");
        $this->load_model("Employee_leave");
        $this->load_model("Turn");
        $this->load_model("Train");
        $this->load_model("Route");
    }

    public function indexAction() {
        //unsetSessionExcept();   
        $this->view->render('stock_keeper/dashboard');
    }

    public function viewordersAction(){
        $this->view->orders = $this->Item_orderModel->getOrdersdDispatchedByTrainUsisngCityID($this->Stock_keeperModel->getCity());
        $this->view->render('stock_keeper/orders');
    }

    public function viewleavesAction(){
        $this->view->leaves = $this->Employee_leaveModel->getleavebystatusandcity(0, $this->Stock_keeperModel->getCity() );
        $this->view->render('stock_keeper/leaves');
    }

    public function viewroutesAction(){
        $this->view->routesToAssign = $this->Stock_keeperModel->getRouteIdsForAssign();
        $this->view->routesToDispatch = $this->Stock_keeperModel->getTurnsToDispatch();
        $this->view->render('stock_keeper/routes');
    }

    public function markasrecievedAction($order_id, $train_id, $weight){
        $this->TrainModel->findByTrainId($train_id);
        $new_filled_capacity = $this->TrainModel->filled_capacity - $weight;
        $this->Stock_keeperModel->markAsRecieved($order_id, $train_id, $new_filled_capacity);
        Router::redirect("StockKeeperHandler/vieworders");
    }

    public function viewleavedetailsAction($id){
        $this->view->leave = $this->Employee_leaveModel->getleavebyid($id);
        $this->view->render('stock_keeper/view_leave');

    }

    public function acceptleaveAction($id){
        $this->Employee_leaveModel->changeStatus($id,1);
        Router::redirect("StockKeeperHandler/viewleaves");
    }

    public function declineleaveAction($id){
        $this->Employee_leaveModel->changeStatus($id,2);
        Router::redirect("StockKeeperHandler/viewleaves");
    }

    public function assigntruckAction($id){
        $maximum_completion_hours = $this->RouteModel->getMaximumCompletionTime($id);
        $this->view->route_id = $id;
        $this->view->available_trucks = $this->Stock_keeperModel->getAvailableTrucks();
        $this->view->available_drivers = $this->Stock_keeperModel->getAvailableDrivers($maximum_completion_hours);
        $this->view->available_assistants = $this->Stock_keeperModel->getAvailableAssistants($maximum_completion_hours);
        $this->view->render("stock_keeper/assign_truck");
    }

    public function assignturnAction($route_id = ""){
        $this->view->route_id = $route_id;
        $validaton = new Validate();


        if ($_POST){
            if(!isset($_POST['truck']) || !isset($_POST['driver']) || !isset($_POST['driver_assistant'])){
                $_SESSION['error'] = "Set all values and try again";
                Router::redirect("StockKeeperHandler/assigntruck/$route_id");
            }else{
                $this->TurnModel->addTurn($route_id, $_POST['truck'], $_POST['driver'], $_POST['driver_assistant']);
                Router::redirect("StockKeeperHandler/viewroutes");
            }
        }else {
            $_SESSION['error'] = "Set all values and try again";
            Router::redirect("StockKeeperHandler/assigntruck/$route_id");
        }
    }

    public function dispatchtruckAction($turn_id, $route_id){
        $this->TurnModel->dispatchTruck($turn_id, $route_id);
        Router::redirect("StockKeeperHandler/viewroutes");
    }
}