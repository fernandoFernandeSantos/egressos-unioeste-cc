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
class Teste extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->library('table');
        $this->load->model('usuario', 'u');
        $this->load->model('egresso', 'e');
        $this->load->library('template');
    }

    public function index()
    {
//        
//        
//        
////        echo $this->u->existe('teste');
////        $data[0] = 'id_egresso';
////        $where = "nome = 'Adair'";
////        $result = $this->e->buscar($data,$where);
////        
////        $this->u->criar('deivide2','123456789',$result->row()->id_egresso);
////        
////        $query = $this->e->buscar(array('id_egresso'), array('nome' => 'Joao' , 'cidade' => 'Cascavel'));
////        
////        $id = $query->row()->id_egresso;
////        
////        
////        $this->e->deletar(array('id_egresso' => (int)$id));
//        //$this->e->deletar(array(1,2,3));
////        $values = array('nome' => 'Joao','cidade' => 'Cascavel');
////        
////        $query = $this->e->buscar(array('id_egresso'),array('nome' => 'Deivide'));
////        
////        //print_r($query->row()->id_egresso);
////        
////        //$where = array('id_egresso' => $query->row()->id_egresso);
////        
////        $where = 'id_egresso = '.$query->row()->id_egresso;
////        $this->e->alterar($values,$where);
////        $data['nome'] = 'Deivide';
////        $data['cidade'] = 'Toledo';
////        $data['ano_entrada'] = 2011;
////        
////        $this->e->criar($data);
////        $col = array('nome','ano_conclusao','cidade');
////        $where = array('nome' => 'Adair' , 'ano_conclusao' => 1998);
////        $this->e->buscar($col,$where);
//        $data = array('head' => '<link href="' . base_url("css/StandartStyles.css") . '" type="text/css" rel="stylesheet">
//        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
//        <meta charset="utf-8" />
//        <title>Egressos Unioeste - Ciência da Computação</title>',
//            'wrapper' => '<div id="header"><img src="' . base_url("images/Title.png") . '"></div>
//
//            <div id="navigation">
//                <div class="menu">' . anchor('',
//                    'Home', '') . '</div>' .
//            '<div class="menu">' . anchor('turma', 'Turma', '') . '</div>' . 
//            '<div class="menu">' . anchor('egressos', 'Egressos', '') . '</div>' . 
//            '<div class="menu">' . anchor('curso', 'Curso', '') . '</div>' . 
//            '</div>',
//            'left_menu' => 'algo la',
//            'content' => $this->template->BuscaEgressos(null),
//            'rodape' => current_url("css/StandartStyles.css"));
//        $this->parser->parse('TemplateCompleto', $data);
//        
    }

}

?>
