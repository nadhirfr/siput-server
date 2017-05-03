<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
function __construct(){
parent::__construct();
$this->load->library('session');
$this->load->database();
if((!isset($_SESSION['user_id']))){
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
        
        $this->load->model('user');
        $this->load->model('transaksi');
        $this->load->model('deposit');
        $this->load->model('iuran_user');
        $this->load->model('iuran');
        //var_dump( $this->user->getValidLogins());
		//echo "Hello world!";
	
		//$data['warga'] = $this->load->view('warga', NULL, TRUE);
		// $data['user_id'] = $this->session->user_id;
		$user_id = $this->session->user_id;
		$data['data_user'] = $this->user->get($user_id);
		$data['total_user'] = $this->user->get_count();
		$data['total_pemasukan'] = $this->transaksi->getJumlahIuran();
		$data['total_pengeluaran'] = $this->transaksi->getJumlahPengeluaran();
		$data['deposit'] = $this->deposit->getByUserID($user_id);
		$data['data_iuran_user'] = $this->iuran_user->getByUserID($user_id);
		for($i=0;$i<sizeof($data['data_iuran_user']);$i++){
			$data['data_iuran_user'][$i]->iuran_nama = $this->iuran->get($data['data_iuran_user'][$i]->iuran_id)[0]->iuran_nama;
			$data['data_iuran_user'][$i]->iuran_nominal = $this->iuran->get($data['data_iuran_user'][$i]->iuran_id)[0]->iuran_nominal;
			$data['data_iuran_user'][$i]->iuran_jenis_id = $this->iuran->get($data['data_iuran_user'][$i]->iuran_id)[0]->iuran_jenis_id;
			$data['data_iuran_user'][$i]->iuran_kategori_id = $this->iuran->get($data['data_iuran_user'][$i]->iuran_id)[0]->iuran_kategori_id;
		}
		//var_dump($data['nama']);
		$this->load->view('dashboard',$data);
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
