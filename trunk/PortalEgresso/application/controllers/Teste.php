<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of teste
 *
 * @author marcelo-note
 */
class Teste extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('Template');
        $this->load->model('m_egresso', 'e');
        $this->load->library('unit_test');
        $this->load->library('table');
    }

    public function index() {
        
        
        
        $this->db->trans_begin();
//        $result = $this->db->query("insert into ptegresso.egresso (nome, rg,cpf) VALUES ('algo','123123','123123')");
        $result = $this->e->criar(array('nome'=>'Codofredo','rg'=>'123456','cpf'=>'13213213','cidade'=>'cascavel'));//roda a criação de um egresso no banco
//        $this->db->trans_complete();
        $this->db->trans_rollback();
        $this->unit->run($result,true,'Teste');
                echo $result;
        $this->template->addContentVar('teste', $this->unit->report());
        $this->template->parse('Teste');
    }

}

?>
