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
class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('template');
        $this->load->model('Usuarios','u');
        $this->load->model('Egresso','e');
    }

    public function index() {

        if ($this->input->post('registrar')) {
            redirect(site_url('Usuario/Registrar'));
        } elseif ($this->input->post('logar')) {
            $this->logar();
        } else {
            show_404();
        }
    }

    public function gerarPagina() {

        $this->template->addContentVar('nome', form_input('usuario'));
        $this->template->addContentVar('cpf', form_input('cpf'));
        $this->template->addContentVar('email', form_input('email'));
        $this->template->addContentVar('senha', form_password('senha'));

        $this->template->addContentVar('form_open', form_open('Usuario/Registrar'));
        $this->template->addContentVar('form_close', form_close());
        $this->template->addContentVar('button_criar', form_submit('button_cadastrar', 'Cadastrar'));

        $this->template->parse('registrar');
    }

    public function registrar() {
        if ($this->input->post('button_cadastrar')) {

            $user = $this->input->post('usuario');
            $password = $this->input->post('senha');
            $email = $this->input->post('email');
            $cpf = $this->input->post('cpf');
            
            $result = $this->e->buscar(array('id_egresso'), "cpf = '" . $cpf . "'");

            $id_egresso = $result->row()->id_egresso;
            
            $this->u->criar($user, $password, $id_egresso, $email);
        }
        $this->gerarPagina();
    }
    
    private function logar(){
        
        $usuario = $this->input->post('user');
        $senha = $this->input->post('senha');
        
        $id_user = $this->u->existe($usuario);
        if($id_user !== FALSE){
            $check = $this->u->password_check($id_user,$senha);
            if($check === TRUE){
                $this->session->set_userdata('logged',TRUE);
                $result = $this->u->buscar(array('email','id_egresso'),array('id_usuario' => $id_user));
                
                $row = $result->row();
                
                $user_nome = $this->e->buscar(array('nome'),array('id_egresso' => $row->id_egresso));
                
                $this->session->set_userdata('nome',$user_nome);
                $this->session->set_userdata('email',$row->email);
                $this->session->set_userdata('usuario',$usuario);
            }
        }
        
        
    }

}

?>
