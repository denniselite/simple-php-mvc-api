<?php

class Controller_auth extends Controller {
    
    
    private $request;
    private $method;
    private $data_method;
    private $model;
    private $view;
    private $post_data;
    
    function __construct() {
        parent::__construct();
        $this->model = new Model_auth();
        $this->model->ConnectToDB();
        $this->view = new View();
        $this->request = new Request();
        $this->method = $this->request->method();
        $this->data_method = $this->request->data();
        $this->post_data = json_decode($this->data_method, TRUE);
    }
    
    
    public function Action_index($id) {
            if ($id==""){
                if ($this->method == "POST"){
                    $this->log_in();
                } else
                if ($this->method == "DELETE"){
                    $this->log_out();
                } else {
                    Controller::out_error("402");
                    }
            } else {
                 if ($this->method == "DELETE"){
                    $this->log_out($id);
                }
            }
    }
    
    public function log_in(){
        return
            $this->view->generate('auth',
                    $this->model->log_in(
                            $this->post_data['e-mail'],
                            $this->post_data['pass']
                            )
                    );
    }
    
    public function log_out(){
        return
            $this->view->generate('auth',
                    $this->model->log_out(
                            $this->post_data['uid'],
                            $this->post_data['sid']
                            )
                    );
    }
}

