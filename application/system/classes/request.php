<?php

Class Request {
    
    function __construct() {
        
    }
    
    public $data;
    
    public function data(){
        return $this->data;
    }
    
    public function method() {
        if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $this->data = file_get_contents('php://input');
            return "PUT";
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->data = file_get_contents('php://input');
            $this->data = pack("A*",$this->data);
            return "POST";
        }
        if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            $this->deldata = file_get_contents('php://input');
            return "DELETE";
        }
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $this->data = file_get_contents('php://input');
            return "GET";
        }
    }
}

