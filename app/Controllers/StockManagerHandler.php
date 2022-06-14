<?php 

class StockManagerHandler extends Controller{


    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("Item_order");
        $this->load_model("train");
    }

    public function indexAction() {
        $this->view->render('stock_manager/dashboard');
    }

    public function viewordersAction(){
        $this->view->orders = $this->Item_orderModel->getallOrders();
        $this->view->render('stock_manager/orders');
    }

    public function filterstatusAction(){
        if ($_POST['filter-status'] === 'all'){
            $this->view->orders = $this->Item_orderModel->getallOrders();
            $this->view->render('stock_manager/orders');
        }else {
            $this->view->filter = $_POST['filter-status'];
            $this->view->orders = $this->Item_orderModel->getorderofstatus($_POST['filter-status']);
            $this->view->render('stock_manager/orders');
        }
    }

    public function changeStatusAction($id){
        $this->Item_orderModel->changeStatus($id,$_POST['status']);
        Router::redirect("StockManagerHandler/vieworders");
    }

    public function assignto_trainAction($order_id){
        $this->Item_orderModel->findbyOrderId($order_id);
        $this->view->order = $this->Item_orderModel;
        $this->view->trains = $this->trainModel->gettrains();
        $this->view->render('stock_manager/train_assignment');
    }
}