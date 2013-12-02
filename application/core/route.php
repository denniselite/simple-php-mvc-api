<?php

class Route {

    function __construct() {
        
    }
    
    public static function Start(){
        $controller_name = 'index';
        $action_name = 'index';
        $model_name = 'index';
        $action_parameters = array();
        
        $route_array = explode('/', $_SERVER['REQUEST_URI']);
        
        if (!empty($route_array[1])) {
            $controller_name = $route_array[1];
        }
        
        if (!empty($route_array[2])) {
            $controller_name = $route_array[2];
        }
        $action_name = 'Action_'.$controller_name;
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        
        if (file_exists(Q_PATH.'/application/models/'.$model_name.'.php')) {
            include Q_PATH.'/application/models/'.$model_name.'.php';
        }
        
        if (file_exists(Q_PATH.'/application/controllers/'.$controller_name.'.php')) {
            include Q_PATH.'/application/controllers/'.$controller_name.'.php';
        }
        else {
            header('Location: /404');
            exit;
        }
        
        $controller = new $controller_name();
        $controller->$action_name();
    }

}
