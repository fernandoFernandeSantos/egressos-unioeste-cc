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
        $this->load->model('M_usuario', 'u');
        $this->load->model('M_egresso', 'e');
        $this->load->model('M_perfil', 'p');
    }

    public function index() {
        if ($this->input->post('registrar')) {
            redirect(site_url('Usuario/Registrar'));
        } elseif ($this->input->post('login')) {
            echo 'logar';
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
//            echo "id_egresso = $id_egresso";
            $usuario = $this->u->buscar(array('id_usuario'), "id_egresso = $id_egresso");
            $id_usuario = $usuario->row()->id_usuario;
            $perfil_data = array('id_egresso' => $id_egresso, 'id_usuario' => $id_usuario);
            $this->p->criar($perfil_data);
        }
        $this->gerarPagina();
    }

    public function logar() {

        var_dump($this->input->post());
        var_dump($this->session->all_userdata());
        $usuario = $this->input->post('user');
        $senha = $this->input->post('senha');

        $id_user = $this->u->existe($usuario);
        echo $id_user;
        if ($id_user !== FALSE) {
            $check = $this->u->password_check($id_user, $senha);
            if ($check === TRUE) {
                $result = $this->u->buscar(array('email', 'id_egresso'), array('id_usuario' => $id_user));

                $row = $result->row();

                $user_nome = $this->e->buscar(array('nome'), array('id_egresso' => $row->id_egresso));

                $row_perfil = $this->p->buscar(array('id_perfil'), array('id_usuario' => $id_user))->row();

                $this->session->set_userdata('logged', TRUE);
                $this->session->set_userdata('nome', $user_nome->row()->nome);
                $this->session->set_userdata('id_usuario', $id_user);
                $this->session->set_userdata('id_egresso', $row->id_egresso);
                $this->session->set_userdata('id_perfil', $row_perfil->id_perfil);

                $this->session->set_userdata('email', $row->email);

                $this->session->set_userdata('usuario', $usuario);
//                echo 'logado';
                //$this->template->addMenuVars("p", "");
                redirect($this->input->post('hidden_current_url'));
            } else {
                $error = '<p style="color:red;">Senha ou Usuário Incorreto</p>';
                $this->template->addMenuVars("p", $error);
                $this->session->set_flashdata('erro_menu','cago geral');
//                $this->template->parse("home");
                redirect($this->input->post('hidden_current_url'));
            }
        } else {
            $error = '<p style="color:red;">Senha ou Usuário Incorreto</p>';
            $this->template->addMenuVars("p", $error);
            $this->session->set_flashdata('erro_menu','cago geral');
//            $this->template->parse("home");
            redirect($this->input->post('hidden_current_url'));
        }
    }

    public function sair() {
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('nome');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('usuario');
        $this->session->unset_userdata('id_usuario');
        $this->session->unset_userdata('id_egresso');
        $this->session->unset_userdata('id_perfil');
        redirect($this->input->post('hidden_current_url'));
    }

}

?>
