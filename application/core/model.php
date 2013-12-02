<?php

class Model {

    function __construct() {
        
    }
    public function ConnectToDB(){
        $host = "localhost";
        $user = "root";
        $password = "Rodster2013";
        $db = "roadster";
        @mysql_connect($host,$user,$password) or die (mysql_error());
        @mysql_select_db($db) or die(mysql_error());
    }
    public function out_data($request_data){
  	if ($request_data){
  		$json_out = array('status' => 0, 'result' => $request_data);
  	} else{
  		$json_out = array('status' => 1);
  	}
  	return json_encode($json_out);
  }
}

