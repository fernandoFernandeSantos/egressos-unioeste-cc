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
        $this->template->addContentVar('ano', $ano);
        $this->template->addContentVar('titulo_ano', '<div class="titulo">  Turma de ' . $ano . ': Prof. ' . $turma['professor_homenageado'] . '</div>');
        if ($result->num_rows() != 0) {
            $tmpl = array('table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable" align="center">');
            $this->table->set_template($tmpl);
            $this->table->set_heading("Nome");
            $res = $this->table->generate($result->result_array());
           // $res = $this->table->generate($result);
        }
//        print_r($turma);
        $this->gerarPagina($res, $turma);
    }

    public function gerarPagina($table = '', $turma = array('ano' => '', 'foto_turma' => '', 'professor_homenageado' => '')) {

        for ($i = 1998; $i <= date("Y"); $i++) {
            $options[$i] = $i;
        }

        $this->template->setTitle('Busca Por Turma');
        $this->template->addContentVar('form_open', form_open('Turma/tratar'));
        $this->template->addContentVar('form_close', form_close());
        $this->template->addContentVar('dropdown', form_dropdown('ano_turma', $options));
        $this->template->addContentVar('button', form_submit('buscar_button', 'Buscar'));
        $this->template->addContentVar('titulo_ano', '');

        $this->template->addContentVar('table', $table);
        if ($table !== '') {
            $this->template->addContentVar('break', br(2));
        }
        if ($turma['foto_turma'] !== '') {
//            echo $turma['foto_turma'];
            $data_img = array(
                'src' => 'images/turma/' . $turma['foto_turma'],
                'alt' => "foto",
                'height'=>'400',
                'width' => "500");
            $this->template->addContentVar('foto', img($data_img));
        } else {
            $this->template->addContentVar('foto', $turma['foto_turma']);
        }
//      $this->template->addContentVar('break', br(1));
        $this->template->addContentVar('break', '');
        $this->template->parse('Turma');
    }

}

?>
