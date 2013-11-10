<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Turmas
 *
 * @author Deivide
 */
class M_turma extends CI_Model {

    private $schema;
    private $turma_table;
    private $pertence_table;
    private $egresso_table;

    public function __construct($_schema = 'ptegresso', $_turma = 'turma', $_pertence = 'pertence', $_egresso = 'egresso') {
        parent::__construct();

        $this->schema = $_schema;
        $this->turma_table = $_turma;
        $this->pertence_table = $_pertence;
        $this->egresso_table = $_egresso;
    }

    public function get_schema() {
        return $this->schema;
    }

    public function get_turma_table() {
        return $this->turma_table;
    }

    public function get_pertence_table() {
        return $this->pertence_table;
    }

    public function get_egresso_table() {
        return $this->egresso_table;
    }

    public function set_schema($schema) {
        $this->schema = $schema;
    }

    public function set_turma_table($turma_table) {
        $this->turma_table = $turma_table;
    }

    public function set_pertence_table($pertence_table) {
        $this->pertence_table = $pertence_table;
    }

    public function set_egresso_table($egresso_table) {
        $this->egresso_table = $egresso_table;
    }

    public function get_full_turma_table() {
        return $this->schema . '.' . $this->get_turma_table();
        //return $this->get_turma_table();
    }

    public function get_full_pertence_table() {
        return $this->schema . '.' . $this->get_pertence_table();
        //return $this->get_pertence_table();
    }

    public function get_full_egresso_table() {
        return $this->get_schema() . '.' . $this->get_egresso_table();
        //return $this->get_egresso_table();
    }

    public function buscar_turma($ano) {

        $query = 'SELECT * FROM  ' . $this->get_full_turma_table() . ' WHERE ano = ' . $ano;
//        echo $query .'<br>';
        $result = $this->db->query($query);

        $result_array = $result->result_array();
        return $result_array[0];
    }

    public function contar_alunos($id) {
        $query = ' SELECT COUNT(nome) as numero FROM ( SELECT nome,id_egresso ';
        $query .= 'FROM ' . $this->get_full_egresso_table() . ' ) AS e';
        $query .=' JOIN ( SELECT id_egresso ';
        $query .= "FROM " . $this->get_full_pertence_table() . "  WHERE id_turma = '$id') ";
        $query .= 'AS p ON e.id_egresso = p.id_egresso';
        $result = $this->db->query($query)->result_array();
        return $result[0]['numero'];
    }

    public function buscar_egressos($id) {

//        $query = 'SELECT nome FROM '.$this->get_full_egresso_table() . ' AS e ';
//        $query .= 'JOIN '.$this->get_full_pertence_table() . ' AS p ';
//        $query .= 'ON e.id_egresso = p.id_egresso ';
//        $query .= 'WHERE p.id_turma = '.$id;
//        $query .= ' ORDER BY nome';
        
        $query = 'SELECT nome,id_perfil FROM (';
        
        $query .= ' SELECT nome,e.id_egresso FROM ( SELECT nome,id_egresso ';
        $query .= 'FROM ' . $this->get_full_egresso_table() . ' ) AS e';
        $query .=' JOIN ( SELECT id_egresso ';
        $query .= "FROM " . $this->get_full_pertence_table() . "  WHERE id_turma = '$id') ";
//        $query .= " ptegresso.perfil AS p ON e.id_egresso=p.id_egresso ";
        $query .= 'AS p ON e.id_egresso = p.id_egresso  ) AS ee';
        $query .= ' LEFT OUTER JOIN ptegresso.perfil AS pp ON ee.id_egresso=pp.id_egresso ORDER BY nome';
//        echo $query.'<br>';
//        return $query;
        $result_array = $this->db->query($query)->result_array();
        
        return $result_array;
//        return 1;
    }

}

?>
