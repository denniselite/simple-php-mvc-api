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
    protected $DBH;
    
    public function ConnectToDB(){
        $host = "localhost";
        $user = "root";
        $password = "Rodster2013";
        $db = "roadster";
        try{
            $this->DBH = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }   
//        @mysql_connect($host,$user,$password) or die (mysql_error());
//        @mysql_select_db($db) or die(mysql_error());
//        mysql_set_charset("utf8");
    }
    
    public function sid_check($sid){
        //$user_id_assoc = mysql_fetch_array(mysql_query("SELECT * FROM sessions WHERE sid = '$sid'"));
        $STH = $this->DBH->prepare("SELECT * FROM sessions WHERE sid = :sid");
        $data = array ('sid' => $sid);
        $STH->execute($data);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $uid = $STH->fetch();
        //var_dump($uid instanceof stdClass);
        if ($uid instanceof stdClass){
		return true;
	}
	else {
		return false;
	}
    }
    
    public function create_sid($email, $device_token){
        $STH = $this->DBH->prepare("SELECT * FROM users WHERE email = :email");
        $data = array ('email' => $email);
        $STH->execute($data);
        $STH->setFetchMode(PDO::FETCH_OBJ);
        $user = $STH->fetch();
//        $user_id_hash_assoc = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE email = '$email'"));
//        $uid = $user_id_hash_assoc['uid'];
//        $pass = $user_id_hash_assoc['pass'];
        $this->sid = $user->uid . time() . $user->pass;
        $this->sid = md5($this->sid);
        if ($user->device_token!=''){
            $STH = $this->DBH->prepare("UPDATE users SET device_token = :device_token WHERE email = :email");
            $data = array ('device_token' => $device_token, 'email' => $email);
            $STH->execute($data);
            //$request = mysql_query("UPDATE users SET device_token = '$device_token' WHERE email = '$email'");
        } 
        $STH = $this->DBH->prepare("INSERT INTO sessions (uid,sid) VALUES (:uid, :sid)");
        $data = array ('uid' => $user->uid, 'sid' => $this->sid);
        $STH->execute($data);
        //$request = mysql_query("INSERT INTO sessions (uid,sid) VALUES ('$uid','$this->sid')");
        $uid_sid = array('uid' => $user->uid, 'sid' => $this->sid);
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

