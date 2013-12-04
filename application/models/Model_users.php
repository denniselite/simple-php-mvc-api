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
                    return Model::out_data(Model::create_sid($email));
                } else {
                    return Model::out_error('300');
                }
        } else{
                return Model::out_error('300');
        }
    }
    
    public function delete_user($uid) {
        $this->new_query =  mysql_query("SELECT * FROM users WHERE uid = '$uid'");
        $user_info = mysql_fetch_assoc($this->new_query);
        if ($user_info != ""){
            $this->new_query = mysql_query("DELETE FROM users WHERE uid = '$uid'");
            return Model::out_error('200');
        } else{
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
    
    public function get_all_users() {
        $this->new_query = mysql_query("SELECT * FROM users");
        $users = array ();
        while ($row = mysql_fetch_array($this->new_query)) {
            $user = array ('uid' => $row['uid'],
                       'e-mail' => $row['email']
                    );
                    array_push($users, $user);
        }
        if ($users !=''){
            return Model::out_data($users);
        } else {
            return Model::out_error('400');
        }
    }
    
    public function update_profile($uid) {
        
    }
    
}
