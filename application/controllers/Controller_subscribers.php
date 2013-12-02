<?php

class Controller_subscribers extends Controller{

    function __construct() {
        
    }
    public function Action_subscribers(){
        $model = new Model_subscribers();
        Model::ConnectToDB();
        $view = new View();
        if ((Request::method() == "GET"))
        {
            $view->generate('subscribers',$model->getSubscribers());
        } else {
            $view->generate('subscribers','400 - Bad Request');
        }
    }
}

