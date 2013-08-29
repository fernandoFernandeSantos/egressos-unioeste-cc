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
        
        $this->load->library('template');
    }

    public function index()
    {
        echo $this->input->post('shit');
        $this->template->addContentVar('teste',form_open('teste'));
        $this->template->parse('teste');
        
    }

}

?>
