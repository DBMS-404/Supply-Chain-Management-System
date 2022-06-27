<?php 

    function dnd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }

    function sanitize($dirty){
        return htmlentities($dirty,ENT_QUOTES,'UTF-8'); 
    }

    function posted_values($post){
        $clean_ary = [];

        foreach($post as $key =>$value){
            $clean_ary[$key] = sanitize($value);
        }
        return $clean_ary;
    }

    function redirectToHandler($type){
        if (!isset($_SESSION['user_id'])){
            Router::redirect("Home");
        }
        $type = strtoupper($type);
        $handlers = [
                    "DR"=>"DriverHandler",
                    "DA"=>"AssistantHandler",
                    "SK"=>"StockKeeperHandler",
                    "MN"=>"ManagerHandler",
                    "SM"=>"StockManagerHandler"];
        $user_type = strtoupper(substr(User::currentLoggedInUser(), 0, 2));
        if ($type !== $user_type){
            Router::redirect($handlers[$user_type]);
        }
    }