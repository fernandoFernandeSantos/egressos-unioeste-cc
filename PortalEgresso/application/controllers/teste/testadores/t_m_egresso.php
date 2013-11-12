<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of t_m_egresso
 *
 * @author marcelo-note
 */
class t_m_egresso extends testador_abstrato {

    function __construct() {
        parent::__construct();
    }

    function initialize() {
        $this->ci->load->model('m_egresso','e');
    }

    function run() {
        
    }
    
    function clear() {
        
    }
}

?>