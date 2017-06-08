<?php

class Filmes_model extends CI_Model{
    
    
    
    public function listar(){
        return $this->db->get('filme')->result();
    }
    
    public function get($id){
        return $this->db->get_where('filme', array('id_filme' => $id))->row();
    }
}