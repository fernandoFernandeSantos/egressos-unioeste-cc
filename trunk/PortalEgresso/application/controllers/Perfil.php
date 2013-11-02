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

    private $tmpl;

    public function __construct() {
        parent::__construct();
        $this->load->model('m_perfil', 'perfil');
        $this->load->model('m_usuario', 'usuario');
        $this->load->model('m_egresso', 'egresso');
        $this->load->model('m_especializacao', 'especializacao');
        $this->load->model('m_trabalha', 'trabalha');
        $this->load->library('Template');
        $this->tmpl = array('table_open' => '<table width="100%" border="00">');
        $this->load->model('m_redes_sociais', 'rede_social');
        $this->load->helper('text');
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

        $select = array('*');
        $where = array('id_usuario' => $id);

        $result_perfil = $this->perfil->buscar($select, $where);
        $row_perfil = $result_perfil->row();

        $result_egresso = $this->egresso->buscar($select, ' id_egresso = ' . $row_perfil->id_egresso);
        $row_egresso = $result_egresso->row();

        //foto
        $this->template->addContentVar('form_multipart', form_open_multipart('Perfil/setPerfilImagem'));

        if (strpos($row_perfil->foto, 'http') !== FALSE) {
            $data_img = array('src' => $row_perfil->foto, 'alt' => 'foto', 'height' => '200', 'width' => '200');
            $this->template->addContentVar('foto', img($data_img));
        } else {
            $data_img = array('src' => 'images/egresso/' . $row_perfil->foto, 'alt' => 'foto', 'height' => '200', 'width' => '200');
            $this->template->addContentVar('foto', img($data_img));
        }

        $trabalha_em = $this->trabalha->buscar_trabalha_em($id);

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
        $this->template->addContentVar('area_atuacao', $row_perfil->area_atuacao);
        if (isset($trabalha_em[0]['nome_instituicao'])) {

            $this->template->addContentVar('trabalha', $trabalha_em[0]['nome_instituicao']);
        } else {
            $this->template->addContentVar('trabalha', "");
        }
        $this->template->addContentVar('email_publico', $row_perfil->email_publico);

        
        $this->table->set_heading('Nome', 'Link');
        $this->table->set_template($this->tmpl);
        $redes = array();
        foreach ($this->rede_social->buscar_redes_perfil($id) as $row) {
            $redes[$row['id_link_rede_social']]['1'] = $row['nome_rede_social'];
            $redes[$row['id_link_rede_social']]['2'] = anchor(prep_url($row['link_rede_social']));
        }
        $this->template->addContentVar('tabela_redes_sociais', $this->table->generate($redes));
        $this->table->clear();
        
        $this->table->set_heading('Tipo', 'Area', 'Inicio', 'Conclusao', 'Instituição');
        $tmpl = array('table_open' => '<table width="100%" border="00">');
        $this->table->set_template($tmpl);

        $esp_table = array();
        foreach ($this->especializacao->buscar_especializacoes($id) as $row) {
            $esp_table[] = array('Tipo' => $row['tipo'], 'Area' => $row['area'], 'Inicio' => $row['inicio'], 'Conclusao' => $row['conclusao'], 'Instituicao' => $row['nome_instituicao']);
        }

        $this->template->addContentVar('especializacoes', $this->table->generate($esp_table));


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

            $select = array('*');
            $where = array('id_usuario' => $this->session->userdata('id_usuario'));
            $result_perfil = $this->perfil->buscar($select, $where);
            $row_perfil = $result_perfil->row();

            $result_egresso = $this->egresso->buscar(array('*'), 'id_egresso = ' . $row_perfil->id_egresso);
            $row_egresso = $result_egresso->row();

            //foto
            $this->template->addContentVar('form_multipart', form_open_multipart('Perfil/setPerfilImagem'));

            if (strpos($row_perfil->foto, 'http') !== FALSE) {
                $data_img = array('src' => $row_perfil->foto, 'alt' => 'foto', 'height' => '200', 'width' => '200');
                $this->template->addContentVar('foto', img($data_img));
            } else {
                $data_img = array('src' => 'images/egresso/' . $row_perfil->foto, 'alt' => "foto", 'height' => "200", 'width' => "200");
                $this->template->addContentVar('foto', img($data_img));
            }

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
            $this->template->addContentVar('email_publico', form_input('email_publico', $row_perfil->email_publico));

            $data = array("name" => "form_alterar_trabalha", "onsubmit" => "return trabalhoValidation(this)");


            //redes sociais mostrar

            $this->table->set_heading('Nome', 'Link');
            $this->table->set_template($this->tmpl);
            $redes = array();
            foreach ($this->rede_social->buscar_redes_perfil($this->session->userdata('id_perfil')) as $row) {
                $redes[$row['id_link_rede_social']]['1'] = $row['nome_rede_social'];
                $redes[$row['id_link_rede_social']]['2'] = anchor(prep_url($row['link_rede_social']));
            }
            $this->template->addContentVar('tabela_redes_sociais', $this->table->generate($redes));
            $this->table->clear();

            //redes sociais adicionar

            $this->template->addContentVar('form_adicionar_rede_social', form_open('Perfil/adicionar_rede_social'));

            $redes_existentes['Selecione'] = 'Selecione';
            foreach ($this->rede_social->buscar_redes_existentes() as $row) {
                $redes_existentes[$row['id_rede_social']] = $row['nome_rede_social'];
            }
            $this->template->addContentVar('rede_social_dropdown', form_dropdown('rede_social_dropdown', $redes_existentes, 'Selecione'));
            $this->template->addContentVar('rede_social_input', form_input('rede_social_input'));
            $this->template->addContentVar('link_rede_social', form_input('link_rede_social'));
            $this->template->addContentVar('button_adicionar_rede_social', form_submit('button_adicionar_rede_social', 'Adicionar'));


            //redes sociais remover

            $this->template->addContentVar('form_remover_rede_social', form_open('Perfil/remover_rede_social'));

            $redes_perfil['Selecione'] = 'Selecione';
            foreach ($this->rede_social->buscar_redes_perfil($this->session->userdata('id_perfil')) as $row) {
                $redes_perfil[$row['id_link_rede_social']] = $row['nome_rede_social'] . ' - ' . character_limiter($row['link_rede_social'], 20);
            }
            $this->template->addContentVar('perfil_rede_social_dropdown', form_dropdown('perfil_rede_social_dropdown', $redes_perfil, 'Selecione'));
            $this->template->addContentVar('button_remover_rede_social', form_submit('button_remover_rede_social', 'Remover'));


            //trabalha
            $this->template->addContentVar('form_trabalha_open', form_open('Perfil/alterar_trabalha', $data));
            $empresas['Selecione'] = 'Selecione';
            $selected = 'Selecione';
            $trabalha_em = $this->trabalha->buscar_trabalha_em($this->session->userdata('id_perfil'));
            foreach ($this->trabalha->buscar_instituicoes() as $row) {
                if (isset($trabalha_em['id_instituicao']) && $row['id_instituicao'] == $trabalha_em['id_instituicao']) {
                    $selected = $row['id_instituicao'];
                }
                $empresas[$row['id_instituicao']] = $row['nome_instituicao'];
            }
            if (isset($trabalha_em[0]['nome_instituicao'])) {
                $this->template->addContentVar('trabalha', $trabalha_em[0]['nome_instituicao']);
            } else {
                $this->template->addContentVar('trabalha', "");
            }
            $this->template->addContentVar('trabalha_dropdown', form_dropdown('trabalha_dropdown', $empresas, $selected));
            $this->template->addContentVar('trabalha_em_input', form_input('trabalha_input'));
            $this->template->addContentVar('radiobutton', "Tipo: " . form_radio('tipo_instituicao', 'Empresa', TRUE) . 'Empresa ' . form_radio('tipo_instituicao', 'Universidade') . 'Universidade');
            $this->template->addContentVar('button_alterar_trabalho', form_submit('button_alterar_trabalho', 'Adicionar'));


            $this->table->set_heading('Tipo', 'Area', 'Inicio', 'Conclusao', 'Instituição');
            $this->table->set_template($this->tmpl);

            $esp_table = array();
            foreach ($this->especializacao->buscar_especializacoes($this->session->userdata('id_perfil')) as $row) {
                $esp_table[] = array('Tipo' => $row['tipo'], 'Area' => $row['area'], 'Inicio' => $row['inicio'], 'Conclusao' => $row['conclusao'], 'Instituicao' => $row['nome_instituicao']);
            }

            $this->template->addContentVar('especializacoes', $this->table->generate($esp_table));
            $this->table->clear();


            //especialização
            $data = array("name" => "form_adicionar_especializacao_open", "onsubmit" => " return especializacaoValidation(this)");
            $this->template->addContentVar('form_adicionar_especializacao_open', form_open('Perfil/adicionar_especializacao', $data));
            $this->template->addContentVar('tipo_especializacao', form_input('tipo_especializacao'));
            $this->template->addContentVar('area_especializacao', form_input('area_especializacao'));
            $this->template->addContentVar('instituicao_especializacao', form_input('instituicao_especializacao'));

            $instituicoes['Selecione'] = 'Selecione';
            foreach ($this->especializacao->buscar_instituicoes('Universidade')->result_array() as $row) {
                $instituicoes[$row['id_instituicao']] = $row['nome_instituicao'];
            }
            $this->template->addContentVar('instituicao_dropdown', form_dropdown('instituicao_dropdown', $instituicoes, 'Selecione'));
            $this->template->addContentVar('ano_inicio_especializacao', form_input('ano_inicio_especializacao'));
            $this->template->addContentVar('ano_conclusao_especializacao', form_input('ano_conclusao_especializacao'));
            $this->template->addContentVar('adicionar_especializacao', form_submit('adicionar_especializacao', 'Adicionar'));

            //remove especializacao
            $data = array("name" => "form_remover_especializacao_open", "onsubmit" => " return removerEspecializacao(this)");
            $this->template->addContentVar('form_remover_especializacao_open', form_open('Perfil/remover_especializacao', $data));

            $especializacoes['Selecione'] = 'Selecione';
            foreach ($this->especializacao->buscar_especializacoes($this->session->userdata('id_perfil')) as $row) {
                $string = $row['inicio'] . '-' . $row['conclusao'] . ' | ' . $row['tipo'] . ' - ' . $row['area'] . ' | ' . $row['nome_instituicao'];
                $especializacoes[$row['id_especializacao']] = $string;
            }

            $this->template->addContentVar('remover_especializacao_dropdown', form_dropdown('remover_especializacao_dropdown', $especializacoes, 'Selecione'));
            $this->template->addContentVar('remover_especializacao', form_submit('remover_especializacao', 'Remover'));

            //trabalha
            $this->template->addContentVar('email_publico', form_input('email_publico', $row_perfil->email_publico));

            $data = array("name" => "form_open_alterar", "onsubmit" => "return perfilValidation()");
            $this->template->addContentVar('form_open', form_open('Perfil/alterar', $data));
            $this->template->addContentVar('form_close', form_close());

            $this->template->addContentVar('button_alterar', form_submit('button_alterar', 'Alterar'));

            $this->template->parse('Perfil-alterar');
        }
    }

    public function adicionar_rede_social() {

        $id_rede = 0;
        if ($this->input->post('rede_social_dropdown') === 'Selecione' && $this->input->post('rede_social_input') != "") {
            $id_rede = (int) $this->rede_social->criar_rede($this->input->post('rede_social_input'));
        } elseif ($this->input->post('rede_social_dropdown') !== 'Selecione') {
            $id_rede = (int) $this->input->post('rede_social_dropdown');
        }

        if ($id_rede != 0) {
            $this->rede_social->adicionar_rede_perfil($this->session->userdata('id_perfil'), $id_rede, $this->input->post('link_rede_social'));
        }

        redirect(site_url('Perfil/editar'));
    }

    public function remover_rede_social() {

        if ($this->input->post('perfil_rede_social_dropdown') !== 'Selecione') {
            $this->rede_social->remover_rede_perfil($this->input->post('perfil_rede_social_dropdown'));
        }

        redirect(site_url('Perfil/editar'));
    }

    public function adicionar_especializacao() {
        $insert_array['tipo'] = $this->input->post('tipo_especializacao');
        $insert_array['area'] = $this->input->post('area_especializacao');
        $insert_array['inicio'] = $this->input->post('ano_inicio_especializacao');
        $insert_array['conclusao'] = $this->input->post('ano_conclusao_especializacao');
        $insert_array['id_perfil'] = $this->session->userdata('id_perfil');
        if ($this->input->post('tipo_especializacao') != "" || $this->input->post('area_especializacao') != "" ||
                $this->input->post('ano_inicio_especilizacao') != "" || $this->input->post('ano_conclusao_especializacao') != "") {
            if ($this->input->post('instituicao_dropdown') === 'Selecione' && $this->input->post('instituicao_especializacao') !== "") {
                $insert_array['id_instituicao'] = $this->especializacao->adicionar_instituicao($this->input->post('instituicao_especializacao'), 'Universidade');
                $this->especializacao->criar_especializacao($insert_array);
            } else {
                if ($this->input->post('instituicao_dropdown') === 'Selecione' && $this->input->post('instituicao_especializacao') === "") {
                    //do nothing
                } else {
                    $insert_array['id_instituicao'] = (int) $this->input->post('instituicao_dropdown');
                    $this->especializacao->criar_especializacao($insert_array);
                }
            }
        }
        redirect(site_url('Perfil/editar'));
    }

    public function remover_especializacao() {
        if ($this->input->post('remover_especializacao_dropdown') !== 'Selecione') {
            $this->especializacao->deletar_especializacao(array('id_especializacao' => (int) $this->input->post('remover_especializacao_dropdown')));
        }

        redirect(site_url('Perfil/editar'));
    }

    public function alterar_trabalha() {
        $where_trabalha = 'id_perfil = ' . $this->session->userdata('id_perfil');

        $id_instituicao = 0;
        if ($this->input->post('trabalha_dropdown') === 'Selecione' && $this->input->post('trabalha_input') !== '') {
            $id_instituicao = $this->trabalha->adicionar_instituicao($this->input->post('trabalha_input'), $this->input->post('tipo_instituicao'));
        } else {
            $id_instituicao = (int) $this->input->post('trabalha_dropdown');
        }
        if (count($this->trabalha->buscar_trabalha_em($this->session->userdata('id_perfil'))) == 0 && $id_instituicao != 0) {
            $this->trabalha->criar(array('id_instituicao' => $id_instituicao, 'id_perfil' => $this->session->userdata('id_perfil')));
        }

        if ($id_instituicao != 0) {
            $data_trabalha = array(
                'id_perfil' => $this->session->userdata('id_perfil'),
                'id_instituicao' => $id_instituicao
            );
            $this->trabalha->alterar($data_trabalha, $where_trabalha);
        }
        redirect(site_url('Perfil/editar'));
    }

    public function alterar() {

        $data_egresso = array(
            'nome' => $this->input->post('nome'),
            'sexo' => $this->input->post('sexo'),
            'rua' => $this->input->post('rua'),
            'cidade' => $this->input->post('cidade'),
            'estado' => $this->input->post('estado'),
            'cep' => $this->input->post('cep'));

        $data_perfil = array(
            'area_atuacao' => $this->input->post('area_atuacao'),
            'descricao' => $this->input->post('descricao'),
            'pagina_pessoal' => $this->input->post('pagina_pessoal'),
            'email_publico' => $this->input->post('email_publico'),
            'telefone' => $this->input->post('telefone'));

        $where_perfil = "id_usuario = " . $this->session->userdata('id_usuario');
        $where_egresso = "id_egresso = " . $this->session->userdata('id_egresso');
        echo $data_egresso['nome'];
        $this->perfil->alterar($data_perfil, $where_perfil);
        $this->egresso->alterar($data_egresso, $where_egresso);

        redirect(site_url('Perfil/ver/' . $this->session->userdata('id_usuario')));
    }

}

?>
