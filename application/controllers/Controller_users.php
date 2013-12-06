<?php

class Controller_users extends Controller {
    
    
    private $request;
    private $method;
    private $data_method;
    private $model;
    private $view;
    private $post_data;
    
    function __construct() {
        parent::__construct();
        $this->model = new Model_users();
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
                    $this->create_user();
                } else
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
        return 
            $this->view->generate(
                    'users', 
                    $this->model->create_user(
                            $this->post_data['e-mail'], 
                            $this->post_data['pass']
                            )
                    );
            //$this->view->generate('users', $this->data_method);
    }
    
    private function delete_user($id){
        return
            $this->view->generate('users', $this->model->delete_user($id,$this->post_data['sid']));
    }
    
    private function get_profile($id){
        return
            $this->view->generate('users',$this->model->get_profile($id));
    }
    
    private function update_profile(){
        
    }
}

