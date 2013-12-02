<?php

class Model_subscribers extends Model{
    
    function __construct() {
        Model::ConnectToDB();
    }
    public function getSubscriber($id_subs){
        $subscribers_assoc =  mysql_fetch_assoc(mysql_query("SELECT * FROM subscribers WHERE id = '$id_subs'"));
        $data = array ('id' => $subscribers_assoc['id'],
                       'time' => $subscribers_assoc['time'],
                       'e-mail' => $subscribers_assoc['e-mail']
        );
        return Model::out_data($data);
    }
    public function getSubscribers(){
	$count_all_assoc = mysql_fetch_assoc(mysql_query("SELECT count(1) cnt FROM subscribers"));
	$n = $count_all_assoc['cnt'];
	$data = array();
	for ($i=1; $i<($n+1) ; $i++) { 
            $subscribers_assoc =  mysql_fetch_assoc(mysql_query("SELECT * FROM subscribers WHERE id = '$i'"));
            $subscriber = array ('id' => $subscribers_assoc['id'],
                       'time' => $subscribers_assoc['time'],
                       'e-mail' => $subscribers_assoc['e-mail']
            );
            array_push($data, $subscriber);
	}
        return Model::out_data($data);
    }
}

