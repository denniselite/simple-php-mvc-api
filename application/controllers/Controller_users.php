<?php

class Controller_users extends Controller {
    
    
    private $request;
    private $method;
    private $data_method;
    private $model;
    private $view;
    
    function __construct() {
        parent::__construct();
        $this->model = new Model_users();
        $this->model->ConnectToDB();
        $this->view = new View();
        $this->request = new Request();
        $this->method = $this->request->method();
        $this->data_method = $this->request->data();
    }
    
    public function Action_index($id) {
            if ($id==""){
                if ($this->method == "POST"){
                    $this->create_user();
                }
                if ($this->method == "GET"){
                    $this->get_all_users();
                } else {
                    Controller::out_error("402");
                    }
            } else{
                if ($this->method == "GET"){
                    $this->get_profile($id);
                }
                if ($this->method == "PUT"){
                    $this->update_profile();
                }
                if ($this->method == "DELETE"){
                    $this->delete_user($id);
                }
            }
    }
    
    private function get_all_users() {
        $this->view->generate('users', $this->model->get_all_users());
    }
    private function create_user(){
        $user_info = json_decode($this->data_method, TRUE);
        $e_mail = $user_info['e-mail']; 
        $pass = $user_info['pass'];
        return 
            $this->view->generate('users', $this->model->create_user($e_mail, $pass));
    }
    
    private function delete_user($id){
        return
            $this->view->generate('users', $this->model->delete_user($id));
    }
    
    private function get_profile($id){
        return
            $this->view->generate('users',$this->model->get_profile($id));
    }
    
    private function update_profile(){
        
    }
}

