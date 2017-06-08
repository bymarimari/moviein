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
	public function inserir($dados, $imagem){
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('titulo', 'Título', 'max_length[70]');

		if ($this->form_validation->run()) {
		    
		    if (!empty($imagem)) {
		        $this->load->library('upload');
		        $config = array();
		        $config['upload_path'] = FCPATH.'public/img/curiosidades/';
    			$config['allowed_types'] = 'jpg|jpeg|png';
		        $config['file_name'] = time();
		        $config['file_ext_tolower'] = TRUE;
		        $this->upload->initialize($config);
		        
		        if ($this->upload->do_upload('imagem')) {
		            $imagem = $this->upload->data();
		            $dados['imagem'] = $imagem['file_name'];
		            
    				$this->load->library('image_moo');
    			    $this->image_moo->load($config['upload_path'].$dados['imagem'])->resize_crop(190,280)->set_jpeg_quality(100)->save_pa('', '', TRUE);
        		    $this->db->set($dados);
        		    
        		    if ($this->db->insert('curiosidade')) {
		                return array('tipo' => 'ok', 'mensagem' => 'Inserida com sucesso!');
        		    } else {
        		        return array('tipo' => 'fail', 'mensagem' => 'Houve um erro ao salvar os dados');
        		    }
		        } else {
		            return array('tipo' => 'fail', 'mensagem' => $this->upload->display_errors());
		        }
		    } else {
		        return array('tipo' => 'fail', 'mensagem' => 'É necessário o envio da imagem.');
		    }
		} else {
		    return array('tipo' => 'fail', 'mensagem' => $this->form_validation->error_string('',''));
		}
    }
    
    public function update($dados){
        
    }
    
    public function excluir($id){
        $curiosidade = $this->get($id);
        if (!empty($curiosidade)) {
            unlink(FCPATH.'public/img/curiosidades/'.$curiosidade->imagem);
            return $this->db->delete('curiosidade', array('id_curiosidade' => $curiosidade->id_curiosidade));
        }
    }
    
}