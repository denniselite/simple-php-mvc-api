<?php

Class Model_users extends Model{
    
    private $new_query;
    
    function __construct() {
        
    }
    
    public function create_user($email,$pass) {
        $this->new_query =  mysql_query("SELECT * FROM users WHERE email = '$email'");
        $user_info = mysql_fetch_assoc($this->new_query);
        if ($user_info == ''){
            $this->new_query =  mysql_query("INSERT INTO users (email,pass) VALUES ('$email','$pass')");
                if ($this->new_query){
                    return Model::out_error('200');
                } else {
                    return Model::out_error('300');
                }
        } else{
                return Model::out_error('300');
        }
    }
    
    public function delete_user($uid) {
        $this->new_query = mysql_query("DELETE FROM users WHERE uid = '$uid'");
        if ($this->new_query){
            return Model::out_error('200');
        } else {
            return Model::out_error('300');
        }
    }
    
    public function get_profile($uid) {
        $this->new_query = mysql_query("SELECT uid,email FROM users WHERE uid = '$uid'");
        $user_info = mysql_fetch_assoc($this->new_query);
        if ($user_info !=''){
            return Model::out_data($user_info);
        } else {
            return Model::out_error('401');
        }
    }
    
    public function get_all_users(){
        $count_all_assoc = mysql_fetch_assoc(mysql_query("SELECT count(1) cnt FROM users"));
	$n = $count_all_assoc['cnt'];
        if ($n>0){
	$data = array();
	for ($i=3; $i<($n+3) ; $i++) { 
            $users_assoc =  mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE uid = '$i'"));
            $user = array ('uid' => $users_assoc['uid'],
                       'e-mail' => $users_assoc['email']
            );
            array_push($data, $user);
	}
        return Model::out_data($data);
        }
        else {
            return Model::out_error('401');
        }
    }

    public function update_profile($uid) {
        
    }
    
}
