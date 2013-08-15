<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of template
 *
 * @author marcelo-note
 */
class Template
{

    private $CI;
    private $ContentFolder;
    private $ContentVars;
    private $GlobalVars;
    private $MenuVars;
    private $MenuFile;
    private $MenuLoggedFile;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->ContentVars = array();
        $this->GlobalVars = array();
        $this->MenuVars = array();
        $this->ContentFolder = 'TemplateContent';
        $this->MenuFile = 'TemplateLeftMenu';
        $this->MenuLoggedFile = 'TemplateLeftMenuLogged';
    }

    public function getMenuFile()
    {
        return $this->MenuFile;
    }

    public function getMenuLoggedFile()
    {
        return $this->MenuLoggedFile;
    }

    public function setContentFolder($folder)
    {
        $this->ContentFolder = $folder;
    }

    public function addContentVar($name, $value)
    {
        $this->ContentVars[$name] = $value;
    }

    public function addGlobalVars($name, $value)
    {
        $this->GlobalVars[$name] = $value;
    }

    public function addMenuVars($name, $value)
    {
        $this->MenuVars[$name] = $value;
    }

    public function getContentVar($name)
    {
        return $this->ContentVars[$name];
    }

    public function getGlobalVar($name)
    {
        return $this->GlobalVars[$name];
    }

    public function getMenuVar($name)
    {
        return $this->MenuVars[$name];
    }

    public function getContentFolder()
    {
        return $this->ContentFolder;
    }

    public function parse($file)
    {
        $this->addGlobalVars('head',
                '<link href="' . base_url("css/StandartStyles.css") . '" type="text/css" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta charset="utf-8" />');
        $this->addGlobalVars('title',
                'Egresoss Unioeste - Ciência da Computação');
        $this->addGlobalVars('header', img('images/Title.png'));
        $this->addGlobalVars('navigation',
                '<div class="menu">' . anchor('', 'Home', '') . '</div>' .
                '<div class="menu">' . anchor('turma', 'Turma', '') . '</div>' .
                '<div class="menu">' . anchor('egressos', 'Egressos', '') . '</div>' .
                '<div class="menu">' . anchor('curso', 'Curso', '') . '</div>');
        $this->addGlobalVars('left_menu', $this->parseMenu());
        $this->addGlobalVars('content', $this->parseContent($file));
        $this->addGlobalVars('rodape', current_url('css/StandartStyles.css'));
//        var_dump($this->GlobalVars);
        $this->CI->parser->parse('TemplateCompleto', $this->GlobalVars);
    }

    public function parseMenu()
    {
        if ($this->CI->session->userdata('logged') === TRUE)
        {
            $this->addMenuVars('nome', $this->CI->session->userdata('nome'));
            $this->addMenuVars('usuario',
                    $this->CI->session->userdata('usuario'));
            $this->addMenuVars('email', $this->CI->session->userdata('email'));
            $value = $this->CI->parser->parse($this->getMenuLoggedFile(),
                    $this->MenuVars, TRUE);
//            $this->addGlobalVars('left_menu', $value);
            return $this->CI->parser->parse($this->getMenuLoggedFile(),$this->MenuVars);
        } else
        {
            
            return $this->CI->parser->parse($this->getMenuFile(), array(), TRUE);
            
        }
        
    }

    public function parseContent($file)
    {
        return $this->CI->parser->parse($this->getContentFolder() . '/' . $file,
                $this->ContentVars, TRUE);

    }

}

?>
