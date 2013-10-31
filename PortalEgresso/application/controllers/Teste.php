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
class Teste extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('Template');
        $this->load->model('m_turma', 'turma');
        $this->load->model('m_especializacao', 'especializacao');
        $this->load->library('table');
    }

    public function index() {
        $especializacoes['Selecione'] = 'Selecione';
        foreach ($this->especializacao->buscar_especializacoes($this->session->userdata('id_perfil')) as $row) {
            $string = $row['inicio'] . '-' . $row['conclusao'] . ' | ' . $row['tipo'] . ' - ' . $row['area'] . ' | ' . $row['nome_instituicao'];
            $especializacoes[$row['id_especializacao']] = $string;
        }
        $this->template->addContentVar('teste', form_dropdown('remover_especializacao_dropdown', $especializacoes, 'Selecione'));
        $this->template->parse('Teste');
    }

}

?>
