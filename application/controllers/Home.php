<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
function __construct(){
parent::__construct();
$this->load->library('session');
$this->load->database();
if((!isset($_SESSION['nama']))){
	redirect(base_url('login'));
}
}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        
        //$this->load->model('user');
        //var_dump( $this->user->getValidLogins());
		//echo "Hello world!";
	
		//$data['warga'] = $this->load->view('warga', NULL, TRUE);
		$this->load->view('dashboard');
		//echo "haloo";
	}

	public function warga(){
		$this->load->view('warga');
	}

	public function pemasukan(){
		$this->load->view('pemasukan');
	}

	public function grafik(){
		$this->load->view('grafik');
	}
}
