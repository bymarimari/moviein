<?php

class Filmes_model extends CI_Model{
    
    
    
    public function listar(){
        return $this->db->get('filme')->result();
    }
    
    public function get($id){
        return $this->db->get_where('filme', array('id_filme' => $id))->row();
    }
    
     public function listar_assiste(){
    	$usuario = $this->session->userdata('usuario');
    	$usuario = $this->db->get_where('usuario', array('email' => $usuario['email']))->row();
    	$assistes = $this->db->get_where('assiste', array('id_usuario' => $usuario->id_usuario))->result();
    	
    	if (!empty($assistes)) {
	    	for($i = 0; $i < count($assistes); $i++) {
	    		$assistes[$i]->filme = $this->db->get_where('filme', array('id_filme' => $assistes[$i]->id_filme))->row();
	    	}
    	}
    	
    	return $assistes;
    }
    
    public function excluir_assiste($id){
        $filme = $this->get($id);
        $usuario = $this->session->userdata('usuario');
    	$usuario = $this->db->get_where('usuario', array('email' => $usuario['email']))->row();
        if (!empty($filme) && !empty($usuario)) {
           return $this->db->delete('assiste', array('id_filme' => $filme->id_filme, 'id_usuario' => $usuario->id_usuario));
        }
    }
    
}