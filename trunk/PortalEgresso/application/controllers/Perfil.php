<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerfilAlterar
 *
 * @author Deivide
 */
class Perfil extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->library('template');
        
    }
    
    
    public function index(){
        
        $this->template->addContentVar('foto','');
        $this->template->addContentVar('button_alterar_foto','');
        $this->template->addContentVar('nome', form_input());
        $this->template->addContentVar('sexo', form_input());
        $this->template->addContentVar('rua', form_input());
        $this->template->addContentVar('cidade', form_input());
        $this->template->addContentVar('estado', form_input());
        $this->template->addContentVar('telefone', form_input());
        $this->template->addContentVar('cep', form_input());
        $this->template->addContentVar('ano_entrada', form_input());
        $this->template->addContentVar('ano_conclusao', form_input());
        $this->template->addContentVar('descricao', form_input());
        $this->template->addContentVar('lattes', form_input());
        $this->template->addContentVar('pagina_pessoal', form_input());
        
        $this->template->addContentVar('form_open', form_open('PerfilAlterar/tratar'));
        $this->template->addContentVar('form_close', form_close());
        
        $this->template->addContentVar('button_alterar', form_submit('button_alterar', 'Alterar'));
        
        $this->template->parse('Perfil-alterar');
        
    }
    
}

?>
