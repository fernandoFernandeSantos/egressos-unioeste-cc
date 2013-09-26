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
class Perfil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_perfil', 'perfil');
        $this->load->model('m_usuario', 'usuario');
        $this->load->model('m_egresso', 'egresso');
        $this->load->library('Template');
    }

    public function index() {

        if ($this->session->userdata('logged')) {
//            redirect(site_url('Perfil/ver/' . $this->session->userdata('id')));
            redirect(site_url('Perfil/ver/1'));
        } else {
            redirect(site_url('Perfil/ver/1'));
        }
    }

    public function ver($id = 1) {

        //echo 'skldjflaksdjfklsadf';
        $select = array('*');
        $where = array('id_usuario' => $id);

        $result_perfil = $this->perfil->buscar($select, $where);
        $row_perfil = $result_perfil->row();

//        echo ' id_egresso = ' . $result_perfil->row()->id_egresso;
        $result_egresso = $this->egresso->buscar($select, ' id_egresso = ' . $row_perfil->id_egresso);
        $row_egresso = $result_egresso->row();

        //foto
        $this->template->addContentVar('form_multipart', form_open_multipart('Perfil/setPerfilImagem'));

        if (strpos($row_perfil->foto, 'http') !== FALSE) {
            $this->template->addContentVar('foto', img($row_perfil->foto));
        } else {
            $data_img = array('src' => 'images/egresso/' . $row_perfil->foto, 'alt' => "foto", 'height' => "200", 'width' => "200");
            $this->template->addContentVar('foto', img($data_img));
        }

//                
        $this->template->addContentVar('nome', $row_egresso->nome);
        $this->template->addContentVar('sexo', $row_egresso->sexo);
        $this->template->addContentVar('rua', $row_egresso->rua);
        $this->template->addContentVar('cidade', $row_egresso->cidade);
        $this->template->addContentVar('estado', $row_egresso->estado);
        $this->template->addContentVar('telefone', $row_perfil->telefone);
        $this->template->addContentVar('cep', $row_egresso->cep);
        $this->template->addContentVar('descricao', $row_perfil->descricao);
        $this->template->addContentVar('area_atuacao', $row_perfil->area_atuacao);
        $this->template->addContentVar('lattes', $row_perfil->link_lattes);
        $this->template->addContentVar('pagina_pessoal', $row_perfil->pagina_pessoal);
        $this->template->addContentVar('ano_entrada', $row_egresso->ano_entrada);
        $this->template->addContentVar('ano_conclusao', $row_egresso->ano_conclusao);
        $this->template->addContentVar('area_atuacao', $row_perfil->area_atuacao);
        $this->template->addContentVar('email_publico',$row_perfil->email_publico);





        $this->template->parse('Perfil-ver');
    }

    public function setPerfilImagem() {

        if ($this->input->post('link_imagem') !== '') {
            $values = array('foto' => $this->input->post('link_imagem'));

            $where = 'id_egresso = ' . $this->session->userdata('id_egresso');

            $this->perfil->alterar($values, $where);
        } else {

            $config['upload_path'] = './images/egresso/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = preg_replace('/\s/', '', $this->session->userdata('nome', ' '));
            $config['overwrite'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('upload_imagem')) {
                print_r($this->upload->display_errors());
            } else {
                $data = $this->upload->data();
                $values = array('foto' => $data['file_name']);

                $where = 'id_egresso = ' . $this->session->userdata('id_egresso');

                $this->perfil->alterar($values, $where);
            }
        }
        redirect(site_url('Perfil/editar'));
    }

    public function editar() {
        if ($this->session->userdata('logged') !== TRUE) {
            $this->template->parse('AcessoNegado');
        } else {
            if ($this->input->post('button_alterar')) {

                echo $this->input->post('nome');
                $edit_atributes = array($this->input->post('nome'));
            } else {
                $select = array('*');
                $where = array('id_usuario' => $this->session->userdata('id_usuario'));
                $result_perfil = $this->perfil->buscar($select, $where);
                $row_perfil = $result_perfil->row();

                $result_egresso = $this->egresso->buscar(array('*'), 'id_egresso = ' . $row_perfil->id_egresso);
                $row_egresso = $result_egresso->row();

                //foto
                $this->template->addContentVar('form_multipart', form_open_multipart('Perfil/setPerfilImagem'));

                if (strpos($row_perfil->foto, 'http') !== FALSE) {
                    $this->template->addContentVar('foto', img($row_perfil->foto));
                } else {
                    $data_img = array('src' => 'images/egresso/' . $row_perfil->foto, 'alt' => "foto", 'height' => "200", 'width' => "200");
                    $this->template->addContentVar('foto', img($data_img));
                }

//                $this->template->addContentVar('foto', $row_perfil->foto);
                $this->template->addContentVar('upload_imagem', form_input(array('name' => 'upload_imagem', 'type' => 'file')));
                $this->template->addContentVar('link_imagem', form_input('link_imagem'));
                $this->template->addContentVar('button_alterar_foto', form_submit('button_alterar_foto', 'Alterar Foto'));

                $this->template->addContentVar('nome', form_input('nome', $row_egresso->nome));
                $this->template->addContentVar('sexo', form_input('sexo', $row_egresso->sexo));
                $this->template->addContentVar('rua', form_input('rua', $row_egresso->rua));
                $this->template->addContentVar('cidade', form_input('cidade', $row_egresso->cidade));
                $this->template->addContentVar('estado', form_input('estado', $row_egresso->estado));
                $this->template->addContentVar('telefone', form_input('telefone', $row_perfil->telefone));
                $this->template->addContentVar('cep', form_input('cep', $row_egresso->cep));
                $this->template->addContentVar('descricao', form_textarea('descricao', $row_perfil->descricao));
                $this->template->addContentVar('area_atuacao', form_input('area_atuacao', $row_perfil->area_atuacao));
                $this->template->addContentVar('lattes', form_input('lattes', $row_perfil->link_lattes));
                $this->template->addContentVar('pagina_pessoal', form_input('pagina_pessoal', $row_perfil->pagina_pessoal));
                $this->template->addContentVar('area_atuacao', form_input('area_atuacao', $row_perfil->area_atuacao));
                $this->template->addContentVar('email_publico', form_input('email_publico', $row_perfil->email_publico));

                $this->template->addContentVar('form_open', form_open('Perfil/alterar'));
                $this->template->addContentVar('form_close', form_close());

                $this->template->addContentVar('button_alterar', form_submit('button_alterar', 'Alterar'));

                $this->template->parse('Perfil-alterar');
            }
        }
    }

    public function alterar() {

        $atributes_alterar = array('nome', 'sexo', 'rua', 'cidade', 'estado', 'telefone', 'cep', 'ano_entrada', 'lattes', 'pagina_pessoal', 'descricao');

        $data_egresso = array(
            'nome' => $this->input->post('nome'),
            'sexo' => $this->input->post('sexo'),
            'rua' => $this->input->post('rua'),
            'cidade' => $this->input->post('cidade'),
            'estado' => $this->input->post('estado'),
            'cep' => $this->input->post('cep'));

        $data_perfil = array(
            'area_atuacao'=>$this->input->post('area_atuacao'),
            'descricao'=>  $this->input->post('descricao'),
            'pagina_pessoal'=>$this->input->post('pagina_pessoal'),
            'email_publico'=>$this->input->post('email_publico'),
            'telefone' => $this->input->post('telefone'));
        
        $where_perfil = "id_usuario = " . $this->template->getCI()->session->userdata('id_usuario');
        //echo $where;
        //$str = $this->db->update_string('table_name', $data, $where);
        $where_egresso = "id_egresso = " . $this->template->getCI()->session->userdata('id_egresso');

        
        $this->perfil->alterar($data_perfil,$where_perfil);
        $this->egresso->alterar($data_egresso,$where_egresso);
        
        redirect(site_url('Perfil/ver/'.$this->template->getCI()->session->userdata('id_usuario')));
    }

}

?>
