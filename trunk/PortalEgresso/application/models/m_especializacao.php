<?php

class M_especializacao extends CI_Model {

    private $schema;
//    private $tem_especialziacao_table;
    private $especializacao_table;
    private $instituicoes_table;

    public function __construct($_schema = 'ptegresso', $_table = 'especializacao',$_instituicoes = 'instituicoes') {
        parent::__construct();
        $this->schema = $_schema;
        $this->especializacao_table = $_table;
        $this->instituicoes_table = $_instituicoes;
//        $this->tem_especialziacao_table = $_tem_especializacao;
    }
    
//    public function get_tem_especialziacao_table() {
//        return $this->tem_especialziacao_table;
//    }

    public function get_instituicoes_table() {
        return $this->instituicoes_table;
    }

//    public function set_tem_especialziacao_table($tem_especialziacao_table) {
//        $this->tem_especialziacao_table = $tem_especialziacao_table;
//    }

    public function set_instituicoes_table($instituicoes_table) {
        $this->instituicoes_table = $instituicoes_table;
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
    
//    private function get_full_tem_especializacao_table() {
//        return $this->schema . '.' . $this->tem_especialziacao_table;
//    }

    private function get_full_instituicao_table() {
        return $this->schema . '.' . $this->instituicoes_table;
    }

    public function adicionar_instituicao($nome, $tipo) {
        $query = $this->db->insert_string($this->get_full_instituicao_table(), array('nome_instituicao' => $nome, 'tipo_instituicao' => $tipo));
        $this->db->query($query);
        return $this->db->insert_id();
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

    public function buscar_instituicoes($tipo = null) {
        if ($tipo !== null) {
            $query = 'SELECT * FROM ' . $this->get_full_instituicao_table() . ' WHERE tipo_instituicao = \'' . $tipo . '\' ORDER BY nome_instituicao';
        } else {
            $query = 'SELECT * FROM ' . $this->get_full_instituicao_table() . ' ORDER BY nome_instituicao';
        }
        return $this->db->query($query);
    }

    public function buscar_id_instituicao($nome) {
        $query = 'SELECT id_instituicao FROM ' . $this->get_full_instituicao_table() . ' WHERE nome_instituicao = \'' . $nome . '\'';
        $result_array = $this->db->query($query)->result_array();
        return $result_array['id_instituicao'];
    }

    public function buscar_especializacoes($id_perfil) {
        $query = 'SELECT id_especializacao, tipo, area, inicio, conclusao, nome_instituicao FROM ';
        $query .= '(SELECT id_especializacao, tipo, area, inicio, conclusao , id_instituicao FROM ' . $this->get_full_especializacao_table() ;
        $query .=  " WHERE id_perfil = '$id_perfil' ) AS e JOIN ";
        $query .='  (SELECT id_instituicao , nome_instituicao FROM  ' . $this->get_full_instituicao_table() . ' ) AS i ';
        $query .= ' ON i.id_instituicao=e.id_instituicao';
//        $query =  ' SELECT id_especializacao, tipo, area, inicio, conclusao, nome_instituicao FROM ';
//        $query .=' (SELECT te.id_especializacao,tipo,area,id_instituicao,inicio,conclusao FROM  ';
//        $query .=' (SELECT * FROM ' . get_full_tem_especializacao_table() . " WHERE id_perfil = '$id_perfil') AS te ";
//        $query .=' JOIN ' . $this->get_full_especializacao_table() . ' AS e ON te.id_especializacao=e.id_especializacao) AS r JOIN ';
//        $query .=' (SELECT nome_instituicao, id_instituicao FROM ' . $this->get_full_instituicao_table() . '  ) AS i ON r.id_instituicao = i.id_instituicao';
        return $this->db->query($query)->result_array();
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
