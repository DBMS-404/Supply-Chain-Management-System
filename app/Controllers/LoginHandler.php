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
                $this->view->errcreditionals = '<li> Wrong Creditionals </li>';
                $this->view->render('home/login');
                
            }
        } else {
            $this->view->render('home/login');
        }
    }

    public function logoutAction()
    {
        $user = User::currentLoggedInUser();
        if ($user->role === 'customer' || $user->role  === 'super_admin') {
            $this->UserModel->logout();
        } else {
            $this->PharmacyModel->logout();
        }

        Router::redirect('home/index');
    }
}
