<?php

class Controller_404 extends Controller {

    function __construct() {
        
    }
    
    public function Action_404() {
        $view = new View();
        $view->generate('404');
    }
}