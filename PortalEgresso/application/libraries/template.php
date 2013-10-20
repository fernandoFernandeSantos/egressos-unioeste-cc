<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of template
 *
 * @author marcelo-note
 */
class Template {

    private $CI;
    private $ContentFolder;
    private $ContentVars;
    private $GlobalVars;
    private $MenuVars;
    private $MenuFile;
    private $MenuLoggedFile;
    private $title;

    public function __construct() {
        $this->CI = & get_instance();
        $this->ContentVars = array();
        $this->GlobalVars = array();
        $this->MenuVars = array();
        $this->ContentFolder = 'TemplateContent';
        $this->MenuFile = 'TemplateMenu';
        $this->MenuLoggedFile = 'TemplateMenuLogged';
        $this->title = 'Egressos Unioeste';
    }

    public function getMenuFile() {
        return $this->MenuFile;
    }

    public function getMenuLoggedFile() {
        return $this->MenuLoggedFile;
    }

    public function setContentFolder($folder) {
        $this->ContentFolder = $folder;
    }

    public function addContentVar($name, $value) {
        $this->ContentVars[$name] = $value;
    }

    public function addGlobalVars($name, $value) {
        $this->GlobalVars[$name] = $value;
    }

    public function addMenuVars($name, $value) {
        $this->MenuVars[$name] = $value;
    }

    public function getContentVar($name) {
        return $this->ContentVars[$name];
    }

    public function getGlobalVar($name) {
        return $this->GlobalVars[$name];
    }

    public function getMenuVar($name) {
        return $this->MenuVars[$name];
    }

    public function getContentFolder() {
        return $this->ContentFolder;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getCI(){
        return $this->CI;
    }
    public function parse($file) {
        $this->addGlobalVars('css', link_tag("css/StandartStyles.css"));
        $this->addGlobalVars('meta', '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta charset="utf-8" />');
        $this->addGlobalVars('title', $this->getTitle());
        $this->addGlobalVars('header', img('images/logo.png').img('images/logocc.png'));
        $this->addGlobalVars('navigation', $this->parseNavigation());
        $this->addGlobalVars('menu', $this->parseMenu());
        $this->addGlobalVars('content', $this->parseContent($file));
        $this->addGlobalVars('rodape', img('images/logo_petcomp.jpg'));
        $this->addGlobalVars('js',  '<script language="javascript" src="'.  base_url('js/validation.js') .'"></script>' );
        $this->CI->parser->parse('TemplateCompleto', $this->GlobalVars);
    }
    
    public function parseNavigation(){
		$html = '<ul>';
        if($this->CI->session->userdata('logged') === TRUE){
            $html .=  '<li>' . anchor('', 'Home', '') . '</li>' .
                '<li>' . anchor('Turma', 'Turma', '') . '</li>' .
                '<li>' . anchor('Egressos', 'Egressos', '') . '</li>';
        }else{
            $html .=  '<li>' . anchor('', 'Home', '') . '</li>' .
                '<li>' . anchor('Turma', 'Turma', '') . '</li>' .
                '<li>' . anchor('Egressos', 'Egressos', '') . '</li>';
        }
		
		return $html.'</ul>';
    }

    public function parseMenu() {
        $this->addMenuVars('hidden_current_url', form_hidden('hidden_current_url',  current_url()));
        if ($this->CI->session->userdata('logged') === TRUE) {
			
            $this->addMenuVars('form_open', form_open('Perfil/editar'));
            $this->addMenuVars('button_editar', form_submit('editar','Editar'));
            $this->addMenuVars('form_close', form_close());
			
            $this->addMenuVars('nome', $this->CI->session->userdata('nome'));
            $this->addMenuVars('usuario', $this->CI->session->userdata('usuario'));
            $this->addMenuVars('email', $this->CI->session->userdata('email'));
            
            $this->addMenuVars('form_sair_open', form_open('Usuario/Sair'));
            $this->addMenuVars('button_sair', form_submit('sair', 'Sair'));
            $this->addMenuVars('form_open_visualizar', form_open('Perfil/ver/'.$this->CI->session->userdata('id_usuario')));
            $this->addMenuVars('button_visualizar', form_submit('visualizar_perfil','Visualizar Perfil'));
            $this->addMenuVars('form_close1', form_close());
            $this->addMenuVars('form_close2', form_close());
            return $this->CI->parser->parse($this->getMenuLoggedFile(), $this->MenuVars,TRUE);
        } else {//nao ta logado
            $form_data=array('name'=>'form_validation','onsubmit'=>'return loginValidation(this)');
            
            $this->addMenuVars('form_open', form_open('Usuario/logar',$form_data));
            
            $this->addMenuVars('input_nome', form_input(array('name'=>'user','id'=>'user')));
            
            $this->addMenuVars('input_senha', form_password(array('name' => 'senha','id' => 'senha')));
            
            //ver com o anibal la as coisa do form chamar func
            $this->addMenuVars('button_login', form_submit('login','Logar'));
            $this->addMenuVars('form_close', form_close());
            
            $this->addMenuVars('button_registro', form_button(array('name' => 'registrar' , 'content' => 'Registrar','onClick' => "window.location.href='". site_url('Usuario/registrar')."'")));
            
            return $this->CI->parser->parse($this->getMenuFile(), $this->MenuVars, TRUE);
        }
    }

    public function parseContent($file) {
        return $this->CI->parser->parse($this->getContentFolder() . '/' . ucfirst($file), $this->ContentVars, TRUE);
    }

}

?>
