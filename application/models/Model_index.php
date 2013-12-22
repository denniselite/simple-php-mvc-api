<?php

class Model_index extends Model {

    function __construct() {
        
    }
        public function getName() {
        return array('<br/>Я - API для Roadster!)'. ' '. date('d-m-Y, H:i:s'));
    }
}

