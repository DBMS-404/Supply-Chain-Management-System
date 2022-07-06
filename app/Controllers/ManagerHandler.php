<?php

class ManagerHandler extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model("User");
        $this->load_model("Train");
        $this->load_model("Item");
        $this->load_model('Truck');
        $this->load_model('Driver');
        $this->load_model('Driver_assistant');
        $this->load_model('Item_order');
    }

    public function indexAction()
    {
        //unsetSessionExcept();
        $this->view->trains = $this->TrainModel->gettrains();   
        $this->view->render('manager/trainSchedule');
    }

    public function viewTrainScheduleAction()
    {
        $this->view->trains = $this->TrainModel->gettrains();
        $this->view->render("manager/trainSchedule");
    }

    public function deleteTrainAction($train_id)
    {
        $this->TrainModel->deleteTrain($train_id);
        Router::redirect("ManagerHandler/viewTrainSchedule");
    }

    public function editTrainAction($id)
    {
        $this->view->train_id = $id;
        $validaton = new Validate();
        if ($_POST){
            $validaton->check($_POST, [
                'capacity' => [
                    'display' => "Maximum Capacity",
                    'is_numeric' => true
                ],
                'train_name' =>[
                    'display' => "Train Name",
                    'unique_update' => 'train,'.$id
                ]

            ]);
            
            if ($validaton->passed()) {
                if($_POST['capacity'] < $_POST['filled_capacity']){
                    $this->view->displayErrors="<ul><li>Maximum capacity cannot be less than the filled capacity!</li></ul>";
                    $this->TrainModel->findbytrainId($id);
                    $this->view->edit_values = $this->TrainModel->getValues();
                    $this->view->render("manager/editTrain");
                }else{
                    $this->TrainModel->updateTrain($id, $_POST);
                    Router::redirect("ManagerHandler/viewTrainSchedule");    
                }
            }else {
                $this->view->displayErrors = $validaton->displayErrors();
                $this->TrainModel->findbytrainId($id);
                $this->view->edit_values = $this->TrainModel->getValues();
                $this->view->render("manager/editTrain");
            }
        }else {
            $this->TrainModel->findbytrainId($id);
            $this->view->edit_values = $this->TrainModel->getValues();
            $this->view->render("manager/editTrain");
        }
    }

    public function addTrainAction(){
        $validaton = new Validate();
        if ($_POST){
            $validaton->check($_POST, [
                'capacity' => [
                    'display' => "Maximum Capacity",
                    'is_numeric' => true
                ],
                'train_name' =>[
                    'display' => "Train Name",
                    'unique' => 'train'
                ]
            ]);
            
            if ($validaton->passed()) {
                $this->TrainModel->addTrain($_POST);
                Router::redirect("ManagerHandler/viewTrainSchedule");    
            }else {
                $this->view->displayErrors = $validaton->displayErrors();
                // $this->TrainModel->findbytrainId($id);
                // $this->view->edit_values = $this->TrainModel->getValues();
                $this->view->render("manager/addTrain");
            }
        }else {
            $this->view->render("manager/addTrain");
        }
    }

    public function generateReportAction($type='10', $flag="0"){
        //dnd($_POST);
        $validate=true;
        $validaton = new Validate();
        if($_POST){

            

            if($flag==="0"){
                $first_date="";
                $second_date="";
            }else{
                $first_date=$_POST['first_date'];
                $second_date=$_POST['second_date'];
                if($first_date!="" and $second_date!=""){
                    $validaton->check($_POST, [
                        'first_date' => [
                            'display' => "Entered Time Period",
                            'time_period' => $_POST['second_date']
                        ]
                    ]);
                    if(!$validaton->passed()){
                        $validate=false;
                        $this->view->displayErrors = $validaton->displayErrors();
                    }
                }
            }

            if($type=='10'){
                $type=$_POST['report_type'];
            }
            switch($type){
                case 1:
                    if($validate){
                        $this->view->items = $this->ItemModel->highestOrderedItems($first_date,$second_date);
                    }
                    $this->view->first_date = $first_date;
                    $this->view->second_date = $second_date;
                    //dnd($this->view->items);
                    $this->view->render('manager/itemsReport');
                    break;
                case 2:
                    if($validate){
                        $this->view->trucks = $this->TruckModel->getWorkingHours($first_date,$second_date);
                        $this->view->drivers = $this->DriverModel->getWorkingHours($first_date,$second_date);
                        $this->view->assistants = $this->Driver_assistantModel->getWorkingHours($first_date,$second_date);     
                    }
                    $this->view->first_date = $first_date;
                    $this->view->second_date = $second_date;                  
                    $this-> view->render('manager/workingHours');
                    break;
                case 3:
                    if($validate){
                        $this->view->details= $this->Item_orderModel->getCustomerOrderDetailsAction($first_date,$second_date);
                    }
                    $this->view->first_date = $first_date;
                    $this->view->second_date = $second_date;                  
                    $this->view->render('manager/customerOrderDetails');
                    break;
                default:
                    $this->view->render('manager/generateReport');
                    break;
            }
            
        }
        else{
            $this->view->render('manager/generateReport');
        }
    }
}
