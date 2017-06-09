<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MeusFilmes extends CI_Controller {
	public $public;
	
	public function __construct(){
		parent::__construct();
		$this->public = base_url().'public/';
	}
	
	public function index()
	{
		if ($this->session->has_userdata('usuario')) {
			$usuario = $this->session->userdata('usuario');
			
			if ($usuario['tipo'] == 1) {
				
				$dados = array();
				$dados['pagina'] = 'meusfilmes';
				
				$this->load->model('Filmes_model');
				$dados['assistes'] = $this->Filmes_model->listar_assiste();
				
				$this->load->view('base', $dados);
			
			} else {
				header('location: '.base_url());
			}
		} else {
			header('location: '.base_url());
		}
	}