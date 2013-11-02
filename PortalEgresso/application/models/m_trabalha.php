<?php

class M_trabalha extends CI_Model {

    private $schema;
    private $trabalha_table;
    private $instituicoes_table;

    public function __construct($_schema = 'ptegresso', $_table = 'trabalha', $_instituicoes = 'instituicoes') {
        parent::__construct();
        $this->schema = $_schema;
        $this->trabalha_table = $_table;
        $this->instituicoes_table = $_instituicoes;
    }

    public function set_trabalha_table($_table) {
        $this->trabalha_table = $_table;
    }

    public function set_schema($_schema) {
        $this->schema = $_schema;
    }

    public function get_trabalha_table() {
        return $this->trabalha_table;
    }

    public function get_schema() {
        return $this->schema;
    }

    private function get_full_trabalha_table() {
        return $this->schema . '.' . $this->trabalha_table;
    }

    private function get_full_instituicao_table() {
        return $this->schema . '.' . $this->instituicoes_table;
    }

    public function adicionar_instituicao($nome, $tipo) {
        $query = $this->db->insert_string($this->get_full_instituicao_table(), array('nome_instituicao' => $nome, 'tipo_instituicao' => $tipo));
        $this->db->query($query);
        return $this->db->insert_id();
    }

    public function criar($data) {
        $query = $this->db->insert_string($this->get_full_trabalha_table(), $data);
        $this->db->query($query);
    }

    public function deletar_trabalha($where) {
        //delete from table where

        $query = 'DELETE FROM ' . $this->get_full_especializacao_table() . ' WHERE ';

        if (is_array($where)) {
            foreach (array_keys($where) as $key) {
                if (is_string($where[$key])) {
                    $condition[$key] = $key . ' = "' . $where[$key] . '"';
                } else {
                    $condition[$key] = $key . ' = ' . $where[$key];
                }
            }
            $query .= implode(' AND ', $condition);
        } else {
            $query .= $where;
        }

        $this->db->query($query);
    }

    public function buscar_instituicoes($tipo = null) {
        if ($tipo !== null) {
            $query = 'SELECT * FROM ' . $this->get_full_instituicao_table() . ' WHERE tipo_instituicao = \'' . $tipo . '\' ORDER BY nome_instituicao';
        } else {
            $query = 'SELECT * FROM ' . $this->get_full_instituicao_table() . ' ORDER BY nome_instituicao';
        }
        return $this->db->query($query)->result_array();
    }
    
    public function buscar_trabalha_em($id_perfil){
//        $query = 'SELECT i.id_instituicao,nome_instituicao FROM '.$this->get_full_trabalha_table() . ' AS t';
//        $query .=' JOIN '.$this->get_full_instituicao_table() . ' AS i ON t.id_instituicao=i.id_instituicao';
//        $query .= ' WHERE t.id_perfil = '.$id_perfil;
//        return $query;
       $query =  'SELECT i.id_instituicao, nome_instituicao FROM (SELECT id_instituicao,id_perfil ' ;
       $query .= ' FROM '.$this->get_full_trabalha_table() . " WHERE id_perfil='$id_perfil') AS t ";
       $query .=' JOIN (SELECT id_instituicao, nome_instituicao FROM '.$this->get_full_instituicao_table() . ') AS i ';
       $query .= ' ON t.id_instituicao=i.id_instituicao';
        return $this->db->query($query)->result_array();
    }

    public function buscar_trabalha($colunas, $where = NULL, $order_by = '') {
        $query = 'SELECT ' . implode(', ', $colunas) . ' FROM ' . $this->get_full_especializacao_table();

        if ($where !== NULL) {
            if (is_array($where)) {
                foreach (array_keys($where) as $key) {
                    if (is_string($where[$key])) {
                        $aux[$key] = $key . " = '" . $where[$key] . "'";
                    } else {
                        $aux[$key] = $key . " = " . $where[$key];
                    }
                }
                $where = implode(' AND ', $aux);
                $where = ' WHERE ' . $where;
            } else {
                if ($where != "") {
                    $where = ' WHERE ' . $where;
                }
            }
        }

        if ($order_by !== '') {
            $order_by = 'ORDER BY ' . $order_by;
        }

        $query .= $where . ' ' . $order_by;

        return $this->db->query($query);
    }

    public function alterar($values, $where) {
        if (is_array($where)) {
            foreach (array_keys($where) as $key) {
                $conditions[$key] = $key . ' = ' . $where[$key];
            }
            $where = implode(' and ', $conditions);
        }
        $query = $this->db->update_string($this->get_full_trabalha_table(), $values, $where);
        $this->db->query($query);
    }

}

?>
