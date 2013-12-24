<?php

class Controller_errors extends Controller {

    private $view;
    private $model;
    
    function __construct() {
        $this->view = new View();
        $this->model = new Model_errors();
    }
    
    public function Action_index($id) {
        if ($id == '') $out_data = $this->model->out_error("400");
            else $out_data = $this->model->out_error($id);
        $this->view->generate('errors', $out_data);
    }
}