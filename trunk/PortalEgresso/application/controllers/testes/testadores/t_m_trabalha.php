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
class t_m_trabalha extends testador_abstrato {

    private $id_perfis;

    function __construct() {
        parent::__construct();
    }

    public function initialize() {
        $this->ci->load->model('m_turma', 't');
        $this->id_turmas = array(-5, 0, 5); //testar para numeros positivos, nulos e negativos
        $this->anos = array(1000, 0, -1000, 2000); //testar para numeros positivos, negativos, nulos e noa pertencentes a base;
    }

    public function run() {

        $this->ci->db->trans_begin();

        
    }

    public function clear() {
        $this->ci->db->trans_rollback();
    }

}

?>