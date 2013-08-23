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
            
//            var_dump($cpf);
            $result = $this->e->buscar(array('id_egresso'), "cpf = '" . $cpf . "'");

//            var_dump($result);
            $id_egresso = $result->row()->id_egresso;
//            var_dump($id_egresso);
            
            $this->u->criar($user, $password, $id_egresso, $email);
        }
        $this->gerarPagina();
    }

}

?>
