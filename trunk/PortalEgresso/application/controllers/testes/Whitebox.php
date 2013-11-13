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

        require(APPPATH . 'controllers/testes/testador_abstrato.php');

        $diretorio = APPPATH . 'controllers/testes/testadores/';
        $arquivos = directory_map($diretorio);

        echo '<html> <head><meta charset=\'UTF-8\'></head><body>';
        foreach ($arquivos as $arq) {
            if (!is_array($arq)) {
                require($diretorio . $arq);
                $nome = substr($arq, 0, (strlen($arq) - 4));
                echo "Test File: " . $arq;
                $CT = new $nome();
                $CT->initialize();
                $CT->run();
                $CT->clear();
            }
        }

        echo $this->unit->report();
        echo '</body></html>';
    }

}

?>
