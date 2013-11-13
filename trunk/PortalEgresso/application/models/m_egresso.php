<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Egresso
 *
 * @author marcelo-note
 */
class M_egresso extends CI_Model {

    private $table;
    private $schema;

    public function __construct($_schema = 'ptegresso', $_table = 'egresso') {
        parent::__construct();
        $this->schema = $_schema;
        $this->table = $_table;
    }

    public function set_table($_table) {
        $this->table = $_table;
    }

    public function set_schema($_schema) {
        $this->schema = $_schema;
    }

    public function get_table() {
        return $this->table;
    }

    public function get_schema() {
        return $this->schema;
    }

    private function get_full_table() {
        return $this->schema . '.' . $this->table;
		//return $this->table;
    }

    public function criar($data) {
        $query = $this->db->insert_string($this->get_full_table(), $data);
        return $this->db->query($query);
    }

    public function deletar($where) {
        //delete from table where

        $query = 'DELETE FROM ' . $this->get_full_table() . ' WHERE ';

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
        
        return $this->db->query($query);
    }

    public function buscar($colunas, $where = NULL, $order_by = '') {
        $query = 'SELECT ' . implode(', ', $colunas) . ' FROM ' . $this->get_full_table(). ' AS e';
        $query .= ' LEFT JOIN ptegresso.perfil AS p ON e.id_egresso=p.id_egresso';

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
        $query = $this->db->update_string($this->get_full_table(), $values, $where);
        return $this->db->query($query);
    }

}

?>
