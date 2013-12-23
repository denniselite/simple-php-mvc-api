<?php

Class Model_auth extends Model{
    
    private $STH;
    
    function __construct() {
        
    }


    public function log_in($data) {
        $this->STH = $this->DBH->prepare("SELECT * FROM users WHERE email = ?");
        $this->STH->execute(array($data->email));
        $this->STH->setFetchMode(PDO::FETCH_OBJ);
        $user_info = $this->STH->fetch();
        if ($user_info->pass != $data->pass) {
            return $this->out_error('301');
        } else {
            return $this->out_data($this->create_sid($data->email, $data->device_token));
        }
    }
    
    public function log_out($data) {
        $this->STH = $this->DBH->prepare("SELECT * FROM users WHERE uid = ?");
        $this->STH->execute(array($data->uid));
        $this->STH->setFetchMode(PDO::FETCH_OBJ);
        $user_info = $this->STH->fetch();
        if ($user_info instanceof stdClass){
            $this->STH = $this->DBH->prepare("DELETE FROM sessions WHERE uid = ?");
            $this->STH->execute(array($data->uid));
            $this->STH = $this->DBH->prepare("UPDATE users SET device_token = 'NULL' WHERE uid = ?");
            $this->STH->execute(array($data->uid));
            return Model::out_error('200');
        } else{
            return Model::out_error('300');
            }
    }
    
}
