<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curiosidades extends CI_Controller {
	public $public;
	
	public function __construct(){
		parent::__construct();
		$this->public = base_url().'public/';
	}
	
	public function index()
	{
		$dados = array();
		$dados['pagina'] = 'curiosidades';
		
		$this->load->model('Curiosidades_model');
		$dados['curiosidades'] = $this->Curiosidades_model->listar();
		
		
		$this->load->view('base', $dados);
	}
        }