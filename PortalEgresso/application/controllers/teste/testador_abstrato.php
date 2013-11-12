<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testador_abstrato
 *
 * @author marcelo-note
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

abstract class testador_abstrato {
    protected $ci;

    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->library('unit_test');
    }

    public abstract function initialize();

    public abstract function run();

    public abstract function clear();
}

?>