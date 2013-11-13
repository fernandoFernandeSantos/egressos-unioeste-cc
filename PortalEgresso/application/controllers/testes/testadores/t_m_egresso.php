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

    private $id_egressos;
    private $nomes_egressos;
    private $anos;
    
    function __construct() {
        parent::__construct();
    }

    public function initialize() {
        $this->ci->load->model('m_egresso','e');
        $this->id_egressos = array(-5,0,5);//testar para numeros positivos, nulos e negativos
        $this->nomes_egressos = array('Adair','Adair Santa Catarina','asd','');//testar para nomes existentes na abse, impletos e nulos
        $this->anos = array(1000,0,-1000,2000);//testar para numeros positivos, negativos, nulos e noa pertencentes a base;
    }

    public function run() {
        
        $this->ci->db->trans_begin();
        $result = $this->ci->e->criar(array('nome'=>'Codofredo','rg'=>'123456','cpf'=>'13213213','cidade'=>'cascavel'));//roda a criação de um egresso no banco

        $this->ci->unit->set_test_items(array('test_name', 'result')); 
        $this->ci->unit->run($result,TRUE,'Teste de inserção de egresso');
        
        unset($result);
        foreach($this->id_egressos as $param){
            $result = $this->ci->e->deletar("id_egresso = $param");//testa a deleção de um egresso
            $this->ci->unit->run($result,TRUE,"Teste de deleção de egresso, parametro = $param");
        }
        
        unset($result);
        foreach($this->id_egressos as $param){
            $result = $this->ci->e->alterar(array('nome'=>'codofredo'),"id_egresso = $param");//testa a alteracao de um egresso
            $name = "Teste de alteracao de egresso, parametro = $param";
            $this->ci->unit->run($result,TRUE,$name);
        }
        
        foreach($this->nomes_egressos as $param){
            $result = $this->ci->e->buscar(array('nome'),"nome LIKE '%$param%'" );//testa a alteracao de um egresso
            $name = "Teste de busca de egresso por nome, parametro = $param";
            $this->ci->unit->run($result,'is_object',$name);
        }
        
        foreach($this->anos as $param){
            $result = $this->ci->e->buscar(array('nome'),"ano_entrada = $param" );//testa a alteracao de um egresso
            $name = "Teste de busca de egresso por ano, parametro = $param";
            $this->ci->unit->run($result,'is_object',$name);
        }
        
    }
    
    public function clear() {
        $this->ci->db->trans_rollback();
    }
}

?>