<?php 

class StockManagerHandler extends Controller{


    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("Item_order");
        $this->load_model("Train");
        $this->load_model("Item");
    }

    public function indexAction() {
        Router::redirect("StockManagerHandler/viewinventory");
        $this->view->render('stock_manager/dashboard');
    }

    public function viewordersAction(){
        $statuses = ['all', 'new', 'dtrain', 'ctrain', 'dtruck', 'delivered'];
        foreach ($statuses as $value) {
            $this->view->counts[$value] = $this->Item_orderModel->getcountofType($value);
        }
        $this->view->orders = $this->Item_orderModel->getallOrders();
        $this->view->render('stock_manager/orders');
    }

    public function filterstatusAction(){
        $statuses = ['all', 'new', 'dtrain', 'ctrain', 'dtruck', 'delivered'];
        foreach ($statuses as $value) {
            $this->view->counts[$value] = $this->Item_orderModel->getcountofType($value);
        }
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
        $this->TrainModel->beginTransaction();
        try{
            $this->TrainModel->update_capacity($this->TrainModel->train_id,$new_capacity);
            $this->Item_orderModel->changeStatus($order_id,"dtrain");
            $train_assignment = new Train_assignment();
            $train_assignment->make_assignment($train_id,$order_id);
            $this->TrainModel->commit();
            $_SESSION['alert'] = true;
        }catch (Exception $exception){
            $this->TrainModel->rollBack();
            $_SESSION['alert'] = false;
        }
        Router::redirect("StockManagerHandler/vieworders");

    }

    public function viewinventoryAction(){
        $this->view->inventory = $this->ItemModel->findAllIteams();
        $this->view->render("stock_manager/inventory");
    }

    public function manageStockAction ($id = ""){
        $this->view->item_id = $id;
        $validaton = new Validate();
        if ($id != ""){
            //edit
            if ($_POST){
                $validaton->check($_POST,[
                    'available_count'=>[
                        'display' => "Quantity",
                        'is_numeric'=>true
                    ],
                    'unit_price'=>[
                        'display' => "Unit Price",
                        'is_numeric'=>true
                    ]
                    ]);
                if ($validaton->passed()){
                    $this->ItemModel->updateItem($id,$_POST);
                    Router::redirect("StockManagerHandler/viewinventory");
                }else {
                    $this->view->displayErrors = $validaton->displayErrors();
                    $this->ItemModel->findbyitemId($id);
                    $this->view->edit_values = $this->ItemModel->getValues();
                    $this->view->render("stock_manager/manage_item");
                }
            }else {
                $this->ItemModel->findbyitemId($id);
                $this->view->edit_values = $this->ItemModel->getValues();
                $this->view->render("stock_manager/manage_item");
            }
        }else {
            //add
            if ($_POST){
                $validaton->check($_POST,[
                    'available_count'=>[
                        'display' => "Quantity",
                        'is_numeric'=>true
                    ],
                    'unit_price'=>[
                        'display' => "Unit Price",
                        'is_numeric'=>true
                    ],
                    'name'=>[
                        'display'=>'Item Name',
                        'unique'=>'item'
                    ]
                    ]);
                if ($validaton->passed()){
                    $this->ItemModel->addItem($_POST);
                    Router::redirect("StockManagerHandler/viewinventory");
                }else {
                    $this->view->displayErrors = $validaton->displayErrors();
                    $this->view->render("stock_manager/manage_item");
                }
            }else {
                $this->view->render("stock_manager/manage_item");
            }
        }
    }

    public function deleteAction($id){
        $this->ItemModel->delete($id);
        Router::redirect("StockManagerHandler/viewinventory");
    }
}