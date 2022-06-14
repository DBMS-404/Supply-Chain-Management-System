<?php 

class StockKeeperHandler extends Controller{
    public function __construct($controller,$action)
    {
        parent::__construct($controller,$action);
        $this->load_model("User");
        $this->load_model("Stock_keeper");
    }

    public function indexAction() {
        //unsetSessionExcept();   
        $this->view->render('stock_keeper/dashboard');
    }
}