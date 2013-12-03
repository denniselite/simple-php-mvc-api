<?php

Class boot {
    function __construct() {
        
    }
   public function start(){
       $route_array = explode('/', $_SERVER['REQUEST_URI']);
       $api_version = "v1";
       if (!empty($route_array[1])) {
            $api_version = $route_array[1];
        }
       if ($api_version == "v1"){
            include_once Q_PATH.'/application/system/classes/request.php';
            include_once Q_PATH.'/application/system/classes/route.php';
            Route::Start();
       }else {
            header('Location: /v1/400');
            exit;
        }
       
   }
   
}