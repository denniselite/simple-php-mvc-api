<?php

class Model {

    function __construct() {
        include Q_PATH.'/application/models/Model_errors.php';
        include Q_PATH.'/application/controllers/Controller_errors.php';
    }
    
    public function out_error($id){
        $errors = new Controller_errors();
        $errors->Action_index($id);
    }
    
    public $status;
    private $sid;
    
    public function ConnectToDB(){
        $host = "localhost";
        $user = "root";
        $password = "Rodster2013";
        $db = "roadster";
        @mysql_connect($host,$user,$password) or die (mysql_error());
        @mysql_select_db($db) or die(mysql_error());
    }
    
    public function sid_check(){
        $user_id_assoc = mysql_fetch_array(mysql_query("SELECT user_id FROM sesions WHERE session_id = '$this->sid'"));
        if (!$user_id_assoc){
		return false;
	}
	else {
		return true;
	}
    }
    
    public function create_sid($email){
        $user_id_hash_assoc = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE email = '$email'"));
        $uid = $user_id_hash_assoc['uid'];
        $pass = $user_id_hash_assoc['pass'];
        $this->sid = $uid.time().$pass;
        $this->sid = md5($this->sid);
        $request = mysql_query("INSERT INTO sessions (uid,sid) VALUES ('$uid','$this->sid')");
        $uid_sid = array('uid' => $uid, 'sid' => $this->sid);
        return $uid_sid;
    }
    
    public function out_data($request_data){
  	if ($request_data !=""){
  		$json_out = array('status' => '200',
                                  'result' => $request_data);
  	} else{
  		$json_out = array('status' => $this->status);
  	}
  	return json_encode($json_out);
  }
}

