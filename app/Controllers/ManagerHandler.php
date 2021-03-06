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
        $this->load_model('Route');
        $this->load_model('City');
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
        $_SESSION['status'] = 'deleted';
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
                    $_SESSION['status'] = 'edited';
                    $_SESSION['train'] = $_POST['train_name'];
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
                $_SESSION['status'] = 'added';
                $_SESSION['train'] = $_POST['train_name'];
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

    public function generateReportAction($type='10'){
        //dnd($_POST);
        $validate=true;
        $validaton = new Validate();
        if($_POST){         

            $first_date=(isset($_POST['first_date']))?$_POST['first_date']:"";
            $second_date=(isset($_POST['second_date']))?$_POST['second_date']:"";
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
                case 4:

                    $time_period=(isset($_POST['time_period']))? $_POST['time_period']: 0;
                    switch($time_period){
                        case 0:
                            $first_date="";
                            $second_date="";
                            break;
                        case 1:
                            $first_date=date("Y")."-01-01";
                            $second_date=date("Y")."-03-31";
                            break;
                        case 2:
                            $first_date=date("Y")."-04-01";
                            $second_date=date("Y")."-06-30";
                            break;
                        case 3:
                            $first_date=date("Y")."-07-01";
                            $second_date=date("Y")."-09-30";
                            break;
                        case 4:
                            $first_date=date("Y")."-10-01";
                            $second_date=date("Y")."-12-31";
                            break;

                    }
                    $this->view->first_date = $first_date;
                    $this->view->second_date = $second_date;
                    $this->view->time_period = $time_period;
                    $route = (isset($_POST['route']))? $_POST['route']  :"0";
                    $city_id = (isset($_POST['city']))? explode('-',$_POST['city'])[0] : "0";
                    $city_name = (isset($_POST['city']))? explode('-',$_POST['city'])[1] : "All Cities";
                    //dnd($this->view->first_date.",".$this->view->second_date.",".$route.",".$city);
                    if($validate){
                        $this->view->orders = $this->Item_orderModel->getAllOrderDetails($first_date,$second_date,$route,$city_id);
                    }
                    //dnd($this->view->orders);
                    $this->view->route = ($route!='0')? $route  :"All Routes";
                    $this->view->city = $city_name;
                    $this->view->routes = $this->RouteModel->getAllRoutes();
                    $this->view->cities = $this->CityModel->getAllCities();
                    $this->view->render('manager/sales_report');
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
