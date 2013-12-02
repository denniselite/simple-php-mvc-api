<?php

Class Request {
    
    function __construct() {
        
    }
    
    public function method() {
        $_PUT = array(); 
        if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $putdata = file_get_contents('php://input');
            return "PUT";
        }
        $_POST = array(); 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $putdata = file_get_contents('php://input');
            return "POST";
        }
        $_DELETE = array(); 
        if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            $putdata = file_get_contents('php://input');
            return "DELETE";
        }
        $_GET = array(); 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $putdata = file_get_contents('php://input');
            return "GET";
        }
    }
}

