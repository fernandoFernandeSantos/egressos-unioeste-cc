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
class t_m_turma extends testador_abstrato {

    private $id_turmas;
    private $anos;

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

        foreach ($this->anos as $param) {
            $result = $this->ci->t->buscar_turma($param); //testa a bsuca de uma turma pelo ano
            if($param > 1993){
            $this->ci->unit->run($result, 'is_array', "Testa a busca de uma turma pelo ano, parametro = $param");
            }else{
                $this->ci->unit->run($result, '', "Testa a busca de uma turma pelo ano, parametro = $param");
            }
        }

        unset($result);
        foreach ($this->id_turmas as $param) {
            $result = $this->ci->t->contar_alunos($param); //testa a contagem de alunos de uma turma
            if ($param > 0) {
                $this->ci->unit->run($result, 'is_numeric', "Testa a contagem de alunos de uma turma, parametro = $param");
            } else {
                $this->ci->unit->run($result, null, "Testa a contagem de alunos de uma turma, parametro = $param");
            }
        }

        unset($result);
        foreach ($this->id_turmas as $param) {
            $result = $this->ci->t->buscar_egressos($param); //testa a bsuca de egressos de uma turma
            if ($param > 0) {
                $this->ci->unit->run($result, 'is_array', "Testa a busca de egressos de uma turma, parametro = $param");
            } else {
                $this->ci->unit->run($result, null, "Testa a busca de egressos de uma turma, parametro = $param");
            }
        }
    }

    public function clear() {
        $this->ci->db->trans_rollback();
    }

}

?>