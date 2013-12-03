<?php

class Controller_400 extends Controller {

    function __construct() {
        
    }
    
    public function Action_index() {
        $view = new View();
        $view->generate('400');
    }
}