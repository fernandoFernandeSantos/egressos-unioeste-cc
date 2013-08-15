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

        $table = NULL;
        if ($this->input->post('buscar_button')) {
//            $post = $this->filter_array(elements(array('nome', 'ano_ingresso', 'ano_formacao'),
//                            $this->input->post(), NULL));
//            var_dump($this->input->post('nome'));

            
            $where = $this->filter_where_name($this->input->post('nome'));
            
            if($this->input->post('ano_ingresso') !== ""){
                if($where !== ''){
                    $where .= ' and ';
                }
                $where .= " ano_entrada = " . $this->input->post('ano_ingresso');
            }
//            var_dump($this->input->post('ano_conclusao'));
            if($this->input->post('ano_formacao') !== ""){
                if($where !== ''){
                    $where .= ' and ';
                }
                $where .= " ano_conclusao = " . $this->input->post('ano_formacao');
            }
            
//            echo $where;
            
            $select[] = 'nome';
            $select[] = 'nome_meio';
            $select[] = 'nome_final';
            $select[] = 'ano_entrada';
            $select[] = 'ano_conclusao';
            $select[] = 'email_comercial';
//            if($where != ""){
            $table = $this->egresso->buscar($select,$where,'nome');
//            }
            if ($table->num_rows() != 0)
            {
                $tmpl = array('table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable" align="center">');
                $this->table->set_template($tmpl);
                $table = $this->table->generate($table);
            }
        }
        


        $this->gerarPagina($table);
    }

    private function filter_array($array) {
        $result = array();
        foreach ($array as $i) {
            if ($i != '') {
                $result[] = $i;
            }
        }
        return $result;
    }

    private function filter_where_name($nome) {
        if($nome !== ""){
        $nome_array = explode(' ', $nome); //nome
        
            if (count($nome_array) === 1 && $nome_array[0] !== '') {
                $where = "(nome = '" . ucfirst(strtolower($nome_array[0])) . "' or ";
                if (strtolower($nome_array[0]) === 'da' || strtolower($nome_array[0]) === 'de' || strtolower($nome_array[0]) === 'do' || strtolower($nome_array[0]) === 'dos') {
                    $where .= " nome_meio = '" . strtolower($nome_array[0]) . "' or ";
                } else {
                    $where .= " nome_meio = '" . ucfirst(strtolower($nome_array[0])) . "' or ";
                }
                $where .= " nome_final = '" . ucfirst(strtolower($nome_array[0])) . "') ";
            } elseif (count($nome_array) === 2) {
                $where = " nome = '" . ucfirst($nome_array[0]) . "' and ";
                if (strtolower($nome_array[1]) !== 'da' || strtolower($nome_array[1]) !== 'de' || strtolower($nome_array[1]) !== 'do' || strtolower($nome_array[1]) === 'dos') {
                    $where .= " nome_meio = '" . ucfirst(strtolower($nome_array[1])) . "' or ";
                } else {
                    $where .= " nome_meio = '" . strtolower($nome_array[1]) . "' or ";
                }
                $where .= " nome_final = '" . ucfirst(strtolower($nome_array[1])) . "' ";
            } elseif (count($nome_array) > 2) {
                
                $nome_meio_array = '';
                for ($i = 1; $i < count($nome_array) - 1; $i++) {
                    if (strtolower($nome_array[$i]) !== 'da' || strtolower($nome_array[$i]) !== 'de' || strtolower($nome_array[$i]) !== 'do' || strtolower($nome_array[$i]) === 'dos') {
                        $nome_meio_array .= ' ' . ucfirst(strtolower($nome_array[$i]));
                    } else {
                        $nome_meio_array .= ' ' . strtolower($nome_array[$i]);
                    }
                }

                $where = " nome = '" . ucfirst(strtolower($nome_array[0])) . "' and ";
                $where .= " nome_meio = '" . $nome_meio_array . "' or ";
                $where .= " nome_final = '" . ucfirst(strtolower($nome_array[count($nome_array) - 1])) . "' ";
            }
            return $where;
        }else{
            return '';
        }
    }

    private function gerarPagina($table = NULL) {

        $this->template->addContentVar('form_open', form_open('Egressos'));
        $this->template->addContentVar('input_nome', form_input('nome'));

        $ano = 1993;
        $options = array('' => '');
        while ($ano < 2010) {
            $options[(string) $ano] = (string) $ano;
            $ano++;
        }

        $this->template->addContentVar('ano_ingresso_dropdown',
                form_dropdown('ano_ingresso', $options));

        unset($options);

        $options = array('' => '');
        $ano = 1998;
        while ($ano <= 2012) {
            $options[(string) $ano] = (string) $ano;
            $ano++;
        }

        $this->template->addContentVar('ano_formacao_dropdown',
                form_dropdown('ano_formacao', $options));

        $this->template->addContentVar('buscar_button',
                form_submit('buscar_button', 'Buscar'));

        if (is_string($table)) {
            $this->template->addContentVar('table', $table);
        } elseif ($table == NULL) {
            $this->template->addContentVar('table', '');
        } else {
            if ($table->num_rows() != 0)
            {
                $tmpl = array('table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="mytable" align="center">');
                $this->table->set_template($tmpl);
                $table= $this->table->generate($table);
            }else{
             $table = '';   
            }
            
            $this->template->addContentVar('table',$table);
        }

//        $this->template->addContentVar('form_close', form_close());

        $this->template->parse('egressos');
    }

}

?>
