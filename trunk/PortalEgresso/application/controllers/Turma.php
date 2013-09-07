<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    class Turma extends CI_Controller{
        
        public function __construct() {
            parent::__construct();
            $this->load->library('Template');
            $this->load->model('M_turma','turma');
            $this->load->helper('array');
        }
        
        public function index(){
            
            for($i=1993;$i<=2012;$i++)
            {
                $options[]=$i;
            }
            
            $this->template->setTitle('Busca Por Turma');
            $this->template->addContentVar('form_open', form_open());
            $this->template->addContentVar('form_close', form_close());
            $this->template->addContentVar('dropdown', form_dropdown('ano_turma', $options));
            $this->template->addContentVar('button', form_submit('buscar_button', 'Buscar'));
            $this->template->addContentVar('foto','');
            $this->template->addContentVar('professor','');
            $this->template->addContentVar('table','');
//            $this->template->addContentVar('break', br(1));
            $this->template->addContentVar('break', '');
            $this->template->parse('turma');
            
        }
        
        
    }
?>
