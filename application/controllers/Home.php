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
	public function index(){
        
        $this->load->model('user');
        $this->load->model('transaksi');
        $this->load->model('deposit');
        $this->load->model('iuran_user');
        $this->load->model('iuran');
        $this->load->model('iuran_jenis');
        $this->load->model('iuran_kategori');
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
			$data['data_iuran_user'][$i]->iuran_jenis_nama = $this->iuran_jenis->get($data['data_iuran_user'][$i]->iuran_jenis_id)[0]->iuran_jenis_nama;
			$data['data_iuran_user'][$i]->iuran_kategori_id = $this->iuran->get($data['data_iuran_user'][$i]->iuran_id)[0]->iuran_kategori_id;
			$data['data_iuran_user'][$i]->iuran_kategori_nama = $this->iuran_kategori->get($data['data_iuran_user'][$i]->iuran_kategori_id)[0]->iuran_kategori_nama;
			$data['data_iuran_user'][$i]->iuran_kekurangan = $this->transaksi->getUtang($data['data_iuran_user'][$i]->user_id,$data['data_iuran_user'][$i]->iuran_id);
		}
		//var_dump($data['iuran']);
		$this->load->view('dashboard',$data);
		//echo "haloo";
	}

	public function warga(){
		$this->load->model('user');
		$user_id = $this->session->user_id;
		$data['data_user'] = $this->user->get($user_id);
		//var_dump($data['data_user']);
		$this->load->view('warga',$data);
	}

	public function pemasukan(){
		$this->load->model('user');
		$this->load->model('transaksi');
		$user_id = $this->session->user_id;
		$data['data_user'] = $this->user->get($user_id);
		$data['data_transaksi'] = $this->transaksi->getByUser($user_id);
		//var_dump($data['data_transaksi']);
		$this->load->view('pemasukan',$data);
	}

	public function grafik(){
		$this->load->model('user');
		$this->load->model('transaksi');
		$user_id = $this->session->user_id;
		$data['data_user'] = $this->user->get($user_id);
		$data['data_transaksi'] = $this->transaksi->get_all();
		for($i=0;$i<sizeof($data['data_transaksi']);$i++){
			$data['data_transaksi'][$i]->transaksi_user = $this->user->get($data['data_transaksi'][$i]->user_id)[0]->user_displayname;
		}
		//var_dump($data['data_transaksi']);
		$this->load->view('grafik',$data);
	}
}
