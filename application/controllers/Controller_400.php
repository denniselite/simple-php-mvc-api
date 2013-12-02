<?php

class Controller_400 extends Controller {

    function __construct() {
        
    }
    
    public function Action_400() {
        $view = new View();
        $view->generate('400');
    }
}