<?php

class Curiosidades_model extends CI_Model{
    private $nome;
    
    //$this->db->get_where('tabela', array('coluna' => $valor))->result();
    //result() = retorna varios, row() = retorna um
    
 
    public function listar(){
        return $this->db->get('curiosidade')->result();
        
    }
    
    public function get($id){
        return $this->db->get_where('curiosidade', array('id_curiosidade' => $id))->row();
    }
}