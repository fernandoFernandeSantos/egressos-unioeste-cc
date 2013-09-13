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
	$this->load->helper('text');
    }

    public function index() {

	$this->gerarPagina();
    }

    public function upload_teste() {
	$config['upload_path'] = './images/egresso';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['file_name'] = 'haha';
	
	$this->load->library('upload',$config);
	
	if(! $this->upload->do_upload()){
	    $this->gerarPagina($this->upload->display_errors());
	}else{
	    $array = $this->upload->data();
	    $filename = $array['file_name'];
	    $this->gerarPagina(img('lalala/'.$filename));
	    
	}
	
    }
    
    public function gerarPagina($data = ''){
	$this->template->addContentVar('form_open_multipart',
		form_open_multipart('Teste/upload_teste'));
	$this->template->addContentVar('input_file',
		form_input(array('type' => 'file', 'name' => 'userfile', 'size' => 20)));
	$this->template->addContentVar('submit_upload', form_submit('upload', 'upload'));
	$this->template->addContentVar('form_close', form_close());

	$this->template->addContentVar('erro',$data);
//	echo 'asd';
	$this->template->parse('Teste');
    }

}

?>
