<?php

Class Model_users extends Model{
    
    private $new_query;
    private $page_size = 20;
            function __construct() {
        
    }


    public function create_user(
            $email,
            $pass,
            $firstname,
            $secondname,
            $about,
            $partner,
            $approved) {
        $approved = FALSE;
        $time_reg = date('d-m-Y, H:i:s');
        $this->new_query =  mysql_query("SELECT * FROM users WHERE email = '$email'");
        $user_info = mysql_fetch_assoc($this->new_query);
        if ($user_info == ''){
            $this->new_query =  mysql_query("INSERT INTO users (" 
                    . "email,"
                    . "pass,"
                    . "firstname,"
                    . "secondname,"
                    . "about,"
                    . "partner,"
                    . "approved"
                    . ") "
                    . "VALUES ("
                    . "'$email',"
                    . "'$pass',"
                    . "'$firstname',"
                    . "'$secondname',"
                    . "'$about',"
                    . "'$partner',"
                    . "'$approved')"
                    );
                if ($this->new_query){
                    return Model::out_data(Model::create_sid($email));
                } else {
                    return Model::out_error('300');
                }
        } else{
                return Model::out_error('300');
        }
    }
    
    public function delete_user($uid,$sid) {
        if ($sid == '') return Model::out_error('301'); 
        if (Model::sid_check($uid,$sid)){
            $this->new_query =  mysql_query("SELECT * FROM users WHERE uid = '$uid'");
            $user_info = mysql_fetch_assoc($this->new_query);
            if ($user_info != ""){
                $this->new_query = mysql_query("DELETE FROM users WHERE uid = '$uid'");
                $this->new_query = mysql_query("DELETE FROM sessions WHERE uid = '$uid'");
                return Model::out_error('200');
            } else{
                return Model::out_error('300');
            }
        } else {
            return Model::out_error('301');
        }
    }
    
    public function get_profile($uid) {
        $this->new_query = mysql_query("SELECT uid, email, time_reg, id_vk, id_fb, firstname, secondname, avatar, about, partner, approved FROM users WHERE uid = '$uid'");
        $user_info = mysql_fetch_assoc($this->new_query);
        if ($user_info !=''){
            return Model::out_data($user_info);
        } else {
            return Model::out_error('401');
        }
    }
    
    public function get_users($page) {
        $count = $this->page_size*$page;
        $this->new_query = mysql_query("SELECT * FROM users ORDER BY uid DESC LIMIT ".$count.", 20");
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
    
    public function update_user(
            $email,
            $pass,
            $id_vk,
            $id_fb,
            $firstname,
            $secondname,
            $avatar,
            $about,
            $partner,
            $approved) {
        $this->new_query =  mysql_query("SELECT * FROM users WHERE email = '$email'");
        $user_info = mysql_fetch_assoc($this->new_query);
        if ($user_info == ''){
            $this->new_query =  mysql_query("INSERT INTO users ("
                    . "email,"
                    . "pass,"
                    . "id_vk,"
                    . "id_fb,"
                    . "firstname,"
                    . "secondname,"
                    . "avatar,"
                    . "about,"
                    . "partner,"
                    . "approved"
                    . ") "
                    . "VALUES ("
                    . "'$email',"
                    . "'$pass',"
                    . "'$id_vk',"
                    . "'$id_fb',"
                    . "'$firstname',"
                    . "'$secondname',"
                    . "'$avatar',"
                    . "'$about',"
                    . "'$partner',"
                    . "'$approved')"
                    );
                if ($this->new_query){
                    return Model::out_data(Model::create_sid($email));
                } else {
                    return Model::out_error('300');
                }
        } else{
                return Model::out_error('300');
        }
    }
    
}
