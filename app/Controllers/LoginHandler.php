<?php

class LoginHandler extends Controller
{

    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model('User');
    }

    public function loginAction()
    {
        if ($_POST) {
            $this->UserModel->findByUserName($_POST['user_id']);
            if ($this->UserModel && password_verify(Input::get('password'), $this->UserModel->password)) {
                
                $this->UserModel->login();
                switch (strtoupper(substr($_POST['user_id'], 0, 2))) {
                    case "CR":
                        break;
                    case "DR": 
                        Router::redirect('DriverHandler');
                        break;
                    case "DA":
                        Router::redirect('AssistantHandler');
                        break;
                    case "SK":
                        Router::redirect('StockKeeperHandler');
                        break;
                    case "MN":
                        Router::redirect('ManagerHandler');
                        break;
                    case "SM":
                        Router::redirect('StockManagerHandler');
                        break;
                    default:
                        echo "Invalid Login!";
                }
                
            } else {
                $this->view->errcreditionals = 'Invalid UserID or Password !';
                $this->view->render('home/login');
                
            }
        } else {
            $this->view->render('home/login');
        }
    }

    public function logoutAction()
    {
        $user_id = User::currentLoggedInUser();
        $this->UserModel->findByUserName($user_id);
        $this->UserModel->logout();
        Router::redirect('home/index');
    }

    public function redirectToHandlerAction(){
        if (!isset($_SESSION['user_id'])){
            Router::redirect("Home");
        }
        $handlers = [
            "DR"=>"DriverHandler",
            "DA"=>"AssistantHandler",
            "SK"=>"StockKeeperHandler",
            "MN"=>"ManagerHandler",
            "SM"=>"StockManagerHandler"];
        $user_type = strtoupper(substr(User::currentLoggedInUser(), 0, 2));
        Router::redirect($handlers[$user_type]);

    }
}
