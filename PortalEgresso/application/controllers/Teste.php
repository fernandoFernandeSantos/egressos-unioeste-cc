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
        $this->load->model('m_turma', 'turma');
        $this->load->model('m_especializacao', 'especializacao');
        $this->load->library('table');
    }

    public function index() {
        
        $this->template->addContentVar('teste', form_radio('as','something').'Something');
        $this->template->parse('Teste');
    }

}

?>
