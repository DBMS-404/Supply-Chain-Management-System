<?php 

class StockKeeperHandler extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model("Stock_keeper");
        $this->load_model("Item_order");
        $this->load_model("Employee_leave");
    }

    public function indexAction() {
        //unsetSessionExcept();   
        $this->view->render('stock_keeper/dashboard');
    }

    public function viewordersAction(){
        $this->view->orders = $this->Stock_keeperModel->getOrdersdDispatchedByTrain();
        $this->view->render('stock_keeper/orders');
    }

    public function viewleavesAction(){
        $this->view->leaves = $this->Employee_leaveModel->getleavebystatusandcity(0, $this->Stock_keeperModel->getCity() );
        $this->view->render('stock_keeper/leaves');
    }

    public function viewroutesAction(){
        $this->view->routes = $this->Item_orderModel->getRouteIdsForDispatch();
        $this->view->render('stock_keeper/routes');
    }

    public function markasrecievedAction($id){
        $this->Item_orderModel->changeStatus($id, 'ctrain');
        Router::redirect("StockKeeperHandler/vieworders");
    }

    public function viewleavedetailsAction($id){
        $this->view->leave = $this->Employee_leaveModel->getleavebyid($id);
        $this->view->render('stock_keeper/view_leave');

    }

    public function acceptleaveAction($id){
        $this->Employee_leaveModel->changeStatus($id,1);
        $this->viewleavesAction();
    }

    public function declineleaveAction($id){
        $this->Employee_leaveModel->changeStatus($id,2);
        $this->viewleavesAction();
    }

    public function assigntruckAction($id){
        $this->view->route_id = $id;
        $this->view->render("stock_keeper/assign_truck");
    }

    public function assignturnAction(){
        $this->view->render("stock_keeper/assign_truck");
    }
}