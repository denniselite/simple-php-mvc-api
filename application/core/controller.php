<?php

class Controller {

    function __construct() {
        include Q_PATH.'/application/models/Model_errors.php';
        include Q_PATH.'/application/controllers/Controller_errors.php';
    }
    
    public function out_error($id){
        $errors = new Controller_errors();
        $errors->Action_index($id);
    }

        public function Action_index() {
        $model = new Model_index();
        $view = new View();
        $view->generate('index',$model->getName());
    }
}
