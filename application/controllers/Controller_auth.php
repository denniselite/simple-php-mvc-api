<?php

class Controller_auth extends Controller {
    
    private $request;
    private $method;
    private $data_method;
    private $model;
    private $view;
    private $post_data;
    private $sid_status;
    
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
    
    private function check_data(){
        if (!$this->post_data){
            $this->out_error("302");
            exit;
        }
        if (!isset($this->post_data['sid'])){
            $this->out_error("302");
            exit;
        }
        if ($this->model->sid_check($this->post_data['sid'])){
            $this->sid_status = true;
        } else {
            $this->sid_status = false;
        }
    }
    
    public function Action_index($id) {
            if ($id==""){
                if ($this->method == "POST"){
                    $this->log_in();
                } else {
                    $this->out_error("402");
                    }
            } else {
                 if ($this->method == "DELETE"){
                    $this->log_out($id);
                } else {
                    $this->out_error("402");
                    }
            }
    }
    
    private function log_in(){
            return
            $this->view->generate('auth',
                    $this->model->log_in((object)$this->post_data)
//                            $this->post_data['email'],
//                            $this->post_data['pass'],
//                            $this->post_data['device_token']
//                             )
                    ); 
   }
    
    private function log_out($id){
        $this->check_data();
        $data = array ('uid' => $this->post_data['sid']);
        if ($this->sid_status){
        return
            $this->view->generate('auth',$this->model->log_out($data));
        } else {
            $this->out_error("301");
        }
    }
}

