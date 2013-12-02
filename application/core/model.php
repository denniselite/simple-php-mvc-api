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
        return "Соединение с базой данных успешно установлено";
    }
}

