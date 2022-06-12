<?php 

    class Home extends Controller{

        public function __construct($controller,$action)
        {
            parent::__construct($controller,$action);
        }

        public function indexAction(){
            echo "Home";
            die();
        }

    }