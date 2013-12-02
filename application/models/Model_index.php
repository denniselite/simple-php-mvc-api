<?php

class Model_index extends Model {

    function __construct() {
        
    }
    public function ConnectToDBStatus() {
        return Model::ConnectToDB();
    }

        public function getName() {
        return array('<br/>'.Model::ConnectToDB().'<br/>Я - новый MVC Framework для Roadster!)');
    }
}

