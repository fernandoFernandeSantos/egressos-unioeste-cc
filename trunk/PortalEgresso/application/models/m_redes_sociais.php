<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_redes_sociais
 *
 * @author marcelo
 */
class M_redes_sociais extends CI_Model{
    
    private $rede_social_table;
    private $links_rede_social_table;
    private $schema;

    public function __construct($_schema = 'ptegresso', $_table = 'rede_social', $link_table = 'link_rede_social') {
        parent::__construct();
        $this->schema = $_schema;
        $this->rede_social_table = $_table;
        $this->links_rede_social_table = $link_table;
    }

    public function set_schema($_schema) {
        $this->schema = $_schema;
    }

    public function get_schema() {
        return $this->schema;
    }

    private function get_full_rede_social_table() {
        return $this->schema . '.' . $this->rede_social_table;
    }
    
    private function get_full_links_rede_social_table() {
        return $this->schema . '.' . $this->links_rede_social_table;
    }


    public function adicionar_rede_perfil($id_perfil,$id_rede_social,$link_rede_social){
        $query = $this->db->insert_string($this->get_full_links_rede_social_table(),array('id_perfil' => $id_perfil, 'id_rede_social' => $id_rede_social,'link_rede_social'=>$link_rede_social));
        return $this->db->query($query);
    }
    
    public function remover_rede_perfil($id_link_rede_social){
        $query = 'DELETE FROM '.$this->get_full_links_rede_social_table();
        $query .= " WHERE id_link_rede_social='$id_link_rede_social'";
        $this->db->query($query);
    }
    
    public function criar_rede($nome){
        $query = $this->db->insert_string($this->get_full_rede_social_table(), array('nome_rede_social' => $nome));
        $this->db->query($query);
        return $this->db->insert_id();
    }
    

    public function deletar_rede($where) {
        //delete from table where

        $query = 'DELETE FROM ' . $this->get_full_rede_social_table() . ' WHERE ';

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
    
    public function buscar_redes_perfil($id_perfil){
//        $query = 'SELECT id_link_rede_social,nome_rede_social, link_rede_social FROM '.$this->get_full_links_rede_social_table(). ' AS l';
//        $query .= ' JOIN '.$this->get_full_rede_social_table().' AS r ';
//        $query .= ' ON l.id_rede_social=r.id_rede_social';
//        $query .= " WHERE id_perfil='$id_perfil'";
      $query = 'SELECT id_link_rede_social,nome_rede_social,link_rede_social FROM (';
     $query .= "SELECT id_link_rede_social, id_rede_social, link_rede_social FROM ".$this->get_full_links_rede_social_table()."   WHERE id_perfil = '$id_perfil') AS l ";
     $query .= 'JOIN (SELECT id_rede_social, nome_rede_social FROM ' .$this->get_full_rede_social_table();
     $query .= ') AS r ON l.id_rede_social=r.id_rede_social';
//     return $query;
        return $this->db->query($query)->result_array();
    }
    
    public function buscar_redes_existentes(){
        return $this->buscar_redes(array('id_rede_social','nome_rede_social'), NULL, 'nome_rede_social')->result_array();
    }

    public function buscar_redes($colunas, $where = NULL, $order_by = '') {
        $query = 'SELECT ' . implode(', ', $colunas) . ' FROM ' . $this->get_full_rede_social_table();

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
            $order_by = ' ORDER BY ' . $order_by;
        }

        $query .= $where . ' ' . $order_by;
//        echo $query;
        return $this->db->query($query);
    }

    public function alterar_rede($values, $where) {
        if (is_array($where)) {
            foreach (array_keys($where) as $key) {
                $conditions[$key] = $key . ' = ' . $where[$key];
            }
            $where = implode(' and ', $conditions);
        } else {
            $where = ' WHERE ' . $where;
        }
        $query = $this->db->update_string($this->get_full_table(), $values,
                $where);
        return $this->db->query($query);
    }
}

?>
