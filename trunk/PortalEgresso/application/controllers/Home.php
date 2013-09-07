<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author marcelo-note
 */
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('Template');
    }
    
    public function index(){
        $this->template->parse('home');
    }
}

?>
