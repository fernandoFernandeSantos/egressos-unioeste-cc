<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Whitebox extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('directory');

        require(APPPATH . 'controllers/teste/testador_abstrato.php');

        $diretorio = APPPATH . 'controllers/teste/testadores/';
        $arquivos = directory_map($diretorio);
        $array = array();


        foreach ($arquivos as $arq) {
            if (!is_array($arq)) {
                require($diretorio . $arq);
                $nome = substr($arq, 0, (strlen($arq) - 4));
                $CT = new $nome();
                $CT->inicialize();
                $CT->run();
                $CT->clear();
            }
        }

        echo $this->unit->report();
    }

}

?>
