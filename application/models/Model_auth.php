<?php

Class Model_auth extends Model{
    
    private $new_query;
    
    function __construct() {
        
    }


    public function log_in($email,$pass) {
        $this->new_query =  mysql_query("SELECT * FROM users WHERE email = '$email'");
        $user_info = mysql_fetch_assoc($this->new_query);
        if ($user_info['pass']!=$pass) {
            return Model::out_error('301');
        } else {
            return Model::out_data(Model::create_sid($email));
        }
    }
    
    public function log_out($uid,$sid) {
        if ($sid == '') return Model::out_error('301'); 
        if (Model::sid_check($uid,$sid)){
            $this->new_query =  mysql_query("SELECT * FROM users WHERE uid = '$uid'");
            $user_info = mysql_fetch_assoc($this->new_query);
            if ($user_info != ""){
                $this->new_query = mysql_query("DELETE FROM sessions WHERE uid = '$uid'");
                return Model::out_error('200');
            } else{
                return Model::out_error('300');
            }
        } else {
            return Model::out_error('301');
        }
    }
    
}
