<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author marcelo-note
 */
class Usuario extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->library('template');
        $this->load->model('Usuarios');
        $this->load->helper('array');
        
    }
    
    public function index(){
        
        $this->template->addContentVar('nome',  form_input());
        $this->template->addContentVar('cpf',  form_input());
        $this->template->addContentVar('email',  form_input());
        $this->template->addContentVar('senha', form_password(''));
       
        $this->template->addContentVar('form_open',form_open('Termina'));
        $this->template->addContentVar('form_close',  form_close());
        $this->template->addContentVar('button_criar', form_submit('button_criar', 'Criar'));
        
        $this->template->parse('registrar');
        
        
    }
}

?>
