<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Whitebox extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('m_usuario','u');
        $this->load->library('unit_test');
    }

    
    public function index(){
        
        $test = 1+1;
        $expected_result = 2;
        $test_name = 'Test';
        echo $this->unit->run($test,$expected_result,$test_name);
        
        
    }
}

?>
