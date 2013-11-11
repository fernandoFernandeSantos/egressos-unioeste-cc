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
        
        $this->unit->run(array(1=>2,'algo'=>'algo'),array('algo'=>'algo', 1=>2),'hahaha fuking shit i hate this crap');
        $this->unit->run(array(1=>2,'algo'=>'algo'),array('algo'=>'algo', 1=>3),'hahaha fuking shit i hate this crap even more');
        $this->unit->run(array(1=>2,'algo'=>'algo'),array('algo'=>'algo', 1=>4),'hahaha fuking shit i hate this crap even more and more');
        
        echo $this->unit->report();
        
        
    }
}

?>
