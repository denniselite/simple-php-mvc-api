<?php

class Route {

    function __construct() {
        
    }
    
    public static function Start(){
        $controller_name = 'index';
        $action_name = 'index';
        $model_name = 'index';
        $id = '';
        $action_parameters = array();
        
        $route_array = explode('/', $_SERVER['REQUEST_URI']);
        
        if (!empty($route_array[2])) {
            $controller_name = $route_array[2];
        }
        
        if (!empty($route_array[3])) {
            $id = $route_array[3];
        }
        $action_name = 'Action_'.$action_name;
        $model_name = 'Model_'.$controller_name;
        if ($controller_name == "errors"){
            header('Location: /v1/400');
            exit;
        }
        if ($controller_name == '400'){
            $controller_name = "Controller_errors";
            $model_name = "Model_errors";
            $id = "400";
        }
                else $controller_name = 'Controller_'.$controller_name;
        
        if (file_exists(Q_PATH.'/application/models/'.$model_name.'.php')) {
            include Q_PATH.'/application/models/'.$model_name.'.php';
        }
        
        if (file_exists(Q_PATH.'/application/controllers/'.$controller_name.'.php')) {
            include Q_PATH.'/application/controllers/'.$controller_name.'.php';
        }
        else {
            header('Location: /v1/400');
            exit;
        }
        
        $controller = new $controller_name();
        $controller->$action_name($id);
    }
    
}
