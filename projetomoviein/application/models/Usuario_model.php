<?php

class Usuario_model extends CI_Model{
    private $nome;
    
    public function inserir($dados){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Nome','max_length[70]|alpha_numeric_spaces');
        $this->form_validation->set_rules('email','E-mail','max_length[70]');
        $this->form_validation->set_rules('senha','Senha','min_length[6]|max_length[15]');
        
        if($this->form_validation->run()){
            $this->UsuarioDAO->set($dados);
            if ($this->UsuarioDAO->salvar()){
                return array('tipo' => 'ok', 'mensagem' => 'Você agora faz parte do movie.in');
            } else {
                return array('tipo' => 'fail', 'mensagem' => 'Houve algum erro ao tentar criar cadastro...');
            }
        } else {
            return array('tipo' => 'fail', 'mensagem' => $this->form_validation->error_string('',''));
        }
    }
    public function get($id){
         $this->UsuarioDAO->find($id);
         return $this->UsuarioDAO->get();
    }
    
    public function autentica($email, $senha){
        $usuario = $this->db->get_where('usuario', array('email' => $email, 'senha' => $senha))->row();
        
        if (!empty($usuario)) {
            $tipo = 1;
            if($usuario->email == 'admin@admin.com'){
                $tipo = 2;
            }
            
            $usuario = array('nome' => $usuario->nome, 'email' => $usuario->email, 'tipo' => $tipo);
            
            $this->session->set_userdata('usuario', $usuario);
            return true;
        } else {
            return false;
        }
    }
}