<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of egresso
 *
 * @author marcelo-note
 */
class Egressos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('template');
        $this->load->model('egresso');
        $this->load->helper('array');
    }

    public function index() {

        $this->gerarPagina();
    }

    public function tratar() {
        $array = array();
        if($this->input->post('nome') == ''){
            $array[] = '-';
        }else{
            $array[] = $this->input->post('nome');
        }
        if($this->input->post('ano_ingresso') == ''){
            $array[] = '-';
        }else{
            $array[] = $this->input->post('ano_ingresso');
        }
        
        $array[]  = '/' . $this->input->post('ano_formacao');

        $param = '/'.implode('/', $array);
        
        redirect(site_url('Egressos/buscar' . $param));
    }

    public function buscar($nome = '-', $ano_ingresso = '-', $ano_conclusao = '') {

        $coluns[] = 'nome';
        $coluns[] = 'ano_entrada';
        $coluns[] = 'ano_conclusao';

        $array = array();
        if ($nome !== '-') {
            $array[] = "UPPER(nome) LIKE '%" . strtoupper($nome) . "%'";
        }
        if ($ano_ingresso !== '-') {
            $array[] = "ano_entrada = " . $ano_ingresso;
        }
        if ($ano_conclusao !== '') {
            $array[] = "ano_conclusao = " . $ano_conclusao;
        }

        $where = implode(' AND ', $array);

        $table = $this->egresso->buscar($coluns, $where, 'nome');

        $this->gerarPagina($table);
    }

    private function gerarPagina($table = NULL) {

        $this->template->setTitle('Busca de Egressos');
        $this->template->addContentVar('form_open', form_open('Egressos/tratar'));
        $this->template->addContentVar('form_close', form_close());
        $this->template->addContentVar('input_nome', form_input('nome'));

        $ano = 1993;
        $options = array('' => '');
        while ($ano < 2010) {
            $options[(string) $ano] = (string) $ano;
            $ano++;
        }

        $this->template->addContentVar('ano_ingresso_dropdown', form_dropdown('ano_ingresso', $options));

        unset($options);

        $options = array('' => '');
        $ano = 1998;
        while ($ano <= 2012) {
            $options[(string) $ano] = (string) $ano;
            $ano++;
        }

        $this->template->addContentVar('ano_formacao_dropdown', form_dropdown('ano_formacao', $options));

        $this->template->addContentVar('buscar_button', form_submit('buscar_button', 'Buscar'));

        if (is_string($table)) {
            $this->template->addContentVar('table', $table);
        } elseif ($table == NULL) {
            $this->template->addContentVar('table', '');
        } else {
            if ($table->num_rows() != 0) {
                $tmpl = array('table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable" align="center">');
                $this->table->set_template($tmpl);
                $table = $this->table->generate($table);
            } else {
                $table = '';
            }

            $this->template->addContentVar('table', $table);
        }

        $this->template->parse('egressos');
    }

}

?>
