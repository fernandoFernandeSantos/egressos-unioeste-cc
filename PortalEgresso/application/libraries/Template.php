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
        $this->MenuFile = 'TemplateRightMenu';
        $this->MenuLoggedFile = 'TemplateRightMenuLogged';
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

    
    public function parse($file) {
        $this->addGlobalVars('css', link_tag("css/StandartStyles.css"));
        $this->addGlobalVars('meta', '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta charset="utf-8" />');
        $this->addGlobalVars('title', $this->getTitle());
        $this->addGlobalVars('header', img('images/Title.png'));
        $this->addGlobalVars('navigation', $this->parseNavigation());
        $this->addGlobalVars('left_menu', $this->parseMenu());
        $this->addGlobalVars('content', $this->parseContent($file));
        $this->addGlobalVars('rodape', current_url());
        $this->addGlobalVars('js',  '<script language="javascript" src="'.  base_url('js/validation.js') .'"></script>' );
        $this->CI->parser->parse('TemplateCompleto', $this->GlobalVars);
    }
    
    public function parseNavigation(){
        if($this->CI->session->userdata('logged') === TRUE){
            return '<div class="menu">' . anchor('', 'Home', '') . '</div>' .
                '<div class="menu">' . anchor('turma', 'Turma', '') . '</div>' .
                '<div class="menu">' . anchor('egressos', 'Egressos', '') . '</div>';
        }else{
            return '<div class="menu">' . anchor('', 'Home', '') . '</div>' .
                '<div class="menu">' . anchor('turma', 'Turma', '') . '</div>' .
                '<div class="menu">' . anchor('egressos', 'Egressos', '') . '</div>';
        }
    }

    public function parseMenu() {
        $this->addMenuVars('hidden_current_url', form_hidden('hidden_current_url',  current_url()));
        if ($this->CI->session->userdata('logged') === TRUE) {
            $this->addMenuVars('form_open', form_open('Usuario'));
            $this->addMenuVars('button_editar', form_submit('editar','Editar'));
            $this->addMenuVars('form_close', form_close());
            $this->addMenuVars('nome', $this->CI->session->userdata('nome'));
            $this->addMenuVars('usuario', $this->CI->session->userdata('usuario'));
            $this->addMenuVars('email', $this->CI->session->userdata('email'));
            
            $this->addMenuVars('form_sair_open', form_open('Usuario/Sair'));
            $this->addMenuVars('button_sair', form_submit('sair', 'Sair'));
            
            return $this->CI->parser->parse($this->getMenuLoggedFile(), $this->MenuVars,TRUE);
        } else {//nao ta logado
            $this->addMenuVars('form_open', form_open('Usuario'));
            
            $this->addMenuVars('input_nome', form_input(array('name'=>'user','id'=>'user')));
            
            $this->addMenuVars('input_senha', form_password(array('name' => 'senha','id' => 'senha')));
            
            //ver com o anibal la as coisa do form chamar func
            $this->addMenuVars('button_login', form_submit('login','Logar'));
//            $this->addMenuVars('button_login', form_submit(array('name' => 'login','id' => 'logar','onclick' => 'loginValidation()','value' => 'Logar')));
            $this->addMenuVars('button_registro', form_submit('registrar','Registrar'));
            $this->addMenuVars('form_close', form_close());
            
            return $this->CI->parser->parse($this->getMenuFile(), $this->MenuVars, TRUE);
        }
    }

    public function parseContent($file) {
        return $this->CI->parser->parse($this->getContentFolder() . '/' . $file, $this->ContentVars, TRUE);
    }

}

?>
