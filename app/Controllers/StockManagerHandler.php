<?php 

class StockManagerHandler extends Controller{


    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("Item_order");
        $this->load_model("Train");
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
        $this->view->trains = $this->TrainModel->gettrains();
        $this->view->render('stock_manager/train_assignment');
    }

    public function make_assignmentAction($order_id,$train_id){
        $this->Item_orderModel->findbyOrderId($order_id);
        $this->TrainModel->findByTrainId($train_id);
        $new_capacity = $this->TrainModel->filled_capacity + $this->Item_orderModel->weight;
        $this->TrainModel->update_capacity($this->TrainModel->train_id,$new_capacity);
        $this->Item_orderModel->changeStatus($order_id,"dtrain");
        $train_assignment = new Train_assignment();
        $train_assignment->make_assignment($train_id,$order_id);
        Router::redirect("StockManagerHandler/vieworders");

    }
}