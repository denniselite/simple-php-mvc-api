<?php

class Controller_subscribers extends Controller{

    function __construct() {
        
    }
    public function Action_subscribers(){
        $model = new Model_subscribers();
        $view = new View();
        $view->generate('subscribers',$model->getSubscribers());
    }
}

