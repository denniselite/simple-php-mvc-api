<?php

Class Model_errors extends Model{
    
    function __construct() {
        
    }
    
    public function out_error($id_error){
        $this->status = $id_error;
        return Model::out_data(false);
    }
}

