<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BancoDeFilmes extends CI_Controller {
	public $public;
	
	public function __construct(){
		parent::__construct();
		$this->public = base_url().'public/';
	}
	
	public function index()
	{
		$dados = array();
		$dados['pagina'] = 'bancodefilmes';

		
		$this->load->model('Filmes_model');
		$dados['bancodefilmes'] = $this->Filmes_model->listar();
		
		$this->load->view('base', $dados);
	}
	
	public function get(){
		$id = $this->input->post('id', true);
		
		$this->load->model('Filmes_model');
		
		echo json_encode($this->Filmes_model->get($id));
	}
}