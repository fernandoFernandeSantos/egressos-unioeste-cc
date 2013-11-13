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
class t_m_especializacao extends testador_abstrato {

    private $nomes_instituicoes_tipos;
    private $infos;

    function __construct() {
        parent::__construct();
    }

    public function initialize() {
        $this->ci->load->model('m_especializacao', 'esp');
        $this->infos = array(
            array('tipo' => 'Mestrado','area' => 'algo','inicio' => '1993','conclusao' => '1994','id_perfil' => 1,'id_instituicao' => 1),
            array('tipo' => 'Mestrado','area' => 'algo','inicio' => '1993','conclusao' => '1994','id_perfil' => 1,'id_instituicao' => 2),
            array('tipo' => 'Mestrado','area' => 'algo','inicio' => '1993','conclusao' => '1994','id_perfil' => 3,'id_instituicao' => 3),
            array('tipo' => 'Mestrado','area' => 'algo','inicio' => '1993','conclusao' => '1992','id_perfil' => 3,'id_instituicao' => 4)
        );
                
        $this->nomes_instituicoes_tipos = array("UNIOESTE" => "U" , "DATACOPER" => "E", "COPEL" => "E", "UNICANP" => "U"); 
    }

    public function run() {

//        $this->ci->db->trans_begin();
//
//        foreach ($this->infos as $param) {
//            $result = $this->ci->esp->criar_especializacao($param);
//            $this->ci->unit->run($result, 'is_bool', "Testa a criacao de uma especializacao, parametros = ".print_r($param,TRUE));
//        }
//        
//        foreach (array_keys($this->nomes_instituicoes_tipos) as $param) {
//            
//            $result = $this->ci->esp->adicionar_instituicao($param, $this->nomes_instituicoes_tipos[$param]);
//            $this->ci->unit->run($result, 'is_numeric', "Testa a adicao de uma instituicao, parametro1 = $param && parametro2 = ".$this->nomes_instituicoes_tipos[$param]);
//        }
//        
//        foreach ($this->infos as $param) {
//            $result = $this->ci->esp->deletar_instituicao('id_instituicao = '.$param['id_instituicao']);
//            $this->ci->unit->run($result, 'is_bool', "Testa a adicao de uma instituicao, parametro = ".$param['id_instituicao']);
//        }
        
//criar_especializacao($data);

// deletar_especializacao($where);
//
// buscar_instituicoes($tipo = null);
//buscar_id_instituicao($nome);
//
//buscar_especializacoes($id_perfil);
//
// buscar_especializacao($colunas, $where = NULL, $order_by = '');
//
//alterar_especializacao($values, $where);
    }

    public function clear() {
        $this->ci->db->trans_rollback();
    }

}

?>