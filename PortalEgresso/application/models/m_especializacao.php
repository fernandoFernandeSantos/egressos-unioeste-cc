<?php

class M_especializacao extends CI_Model {

    private $schema;
    private $especializacao_table;
    private $instituicoes_table;

    public function __construct($_schema = 'ptegresso', $_table = 'especializacao',$_instituicoes = 'instituicoes') {
        parent::__construct();
        $this->schema = $_schema;
        $this->especializacao_table = $_table;
        $this->instituicoes_table = $_instituicoes;
    }

    public function set_especializacao_table($_table) {
        $this->especializacao_table = $_table;
    }

    public function set_schema($_schema) {
        $this->schema = $_schema;
    }

    public function get_especializacao_table() {
        return $this->especializacao_table;
    }

    public function get_schema() {
        return $this->schema;
    }

    private function get_full_especializacao_table() {
        return $this->schema . '.' . $this->especializacao_table;
    }
    
    private function get_full_instituicao_table(){
        return $this->schema . '.' . $this->instituicoes_table;
    }
    
    public function adicionar_instituicao($nome){
        $query = $this->db->insert_string($this->get_full_especializacao_table(), array('nome_instituicao' => $nome));
        $this->db->query($query);
    }

    public function criar_especializacao($data) {
        $query = $this->db->insert_string($this->get_full_especializacao_table(), $data);
        $this->db->query($query);
    }
    
    public function deletar_instituicao($where) {
        //delete from table where

        $query = 'DELETE FROM ' . $this->get_full_instituicao_table() . ' WHERE ';

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

    public function deletar_especializacao($where) {
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

    public function buscar_instituicoes(){
        $query = 'SELECT * FROM ' . $this->get_full_instituicao_table() . ' ORDER BY nome_instituicao';
        return $this->db->query($query);
    }
    
    public function buscar_especializacao($colunas, $where = NULL, $order_by = '') {
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

    public function alterar_especializacao($values, $where) {
        if (is_array($where)) {
            foreach (array_keys($where) as $key) {
                $conditions[$key] = $key . ' = ' . $where[$key];
            }
            $where = implode(' and ', $conditions);
        }
        $query = $this->db->update_string($this->get_full_especializacao_table(), $values, $where);
        $this->db->query($query);
    }

}
?>
