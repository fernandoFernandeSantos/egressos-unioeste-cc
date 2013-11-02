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
        $this->load->model('m_turma', 'r');
        $this->load->library('table');
    }

    public function index() {
        $id= 1;
        $this->template->addContentVar('teste', $this->r->contar_alunos(2));
        $this->template->parse('Teste');
    }

}

?>
