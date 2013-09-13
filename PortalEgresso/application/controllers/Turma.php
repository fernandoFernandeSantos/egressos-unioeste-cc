<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Turma extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Template');
        $this->load->model('m_turma', 'turma');
        $this->load->helper('array');
    }

    public function index() {
        $this->gerarPagina();
    }

    public function tratar() {
//        print_r($this->input->post());
        redirect(site_url('Turma/buscar/' . $this->input->post('ano_turma')));
    }

    public function buscar($ano) {

        $turma = $this->turma->buscar_turma($ano);

        $result = $this->turma->buscar_egressos($turma['id_turma']);


        $tmpl = array('table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable" align="center">');
        $this->table->set_template($tmpl);
        $res = $this->table->generate($result);
        print_r($turma);
        $this->gerarPagina($res, $turma);
    }

    public function gerarPagina($table = '', $turma = array('ano' => '', 'foto_turma' => '', 'professor_homenageado' => '')) {
        for ($i = 1998; $i <= 2012; $i++) {
            $options[$i] = $i;
        }

        $this->template->setTitle('Busca Por Turma');
        $this->template->addContentVar('form_open', form_open('Turma/tratar'));
        $this->template->addContentVar('form_close', form_close());
        $this->template->addContentVar('dropdown', form_dropdown('ano_turma', $options));
        $this->template->addContentVar('button', form_submit('buscar_button', 'Buscar'));

        $this->template->addContentVar('professor', $turma['professor_homenageado']);
        $this->template->addContentVar('table', $table);
        if ($table !== '') {
            $this->template->addContentVar('break', br(2));
        }
        if ($turma['foto_turma'] !== '') {
            $this->template->addContentVar('foto', img($turma['foto_turma']));
        } else {
            $this->template->addContentVar('foto', $turma['foto_turma']);
        }
//            $this->template->addContentVar('break', br(1));
        $this->template->addContentVar('break', '');
        $this->template->parse('Turma');
    }

}

?>