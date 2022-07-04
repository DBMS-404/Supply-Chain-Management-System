<?php

class ManagerHandler extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model("User");
        $this->load_model("Train");
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

    public function generateReportAction(){
        $this->view->render('manager/generatereport');
    }
}
