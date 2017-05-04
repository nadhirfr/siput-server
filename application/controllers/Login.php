 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	//function __construct(){
	//parent::__construct();
	//$this->load->library('session');
	//$this->load->database();

	//$this->load->model('Mlogin');
	//}

	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');
 
	}

	public function index()
	{
		//$data['title'] = "This is Login";
		$this->load->view('vlogin');
	}

	public function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'user_username' => $username,
			'user_password' => $password
			);
		$result = $this->m_login->cek_login("user",$where)->result();
		$cek = $this->m_login->cek_login("user",$where)->num_rows();
		if($cek > 0){
 
			$data_session = array(
				'user_id' => $result[0]->user_id,
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 			//echo "berhasil";
 			//var_dump($result[0]->user_id) ;
 			//var_dump($cek);
			redirect(base_url("home"));
 
		}else{
			$this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <p>Maaf username atau password salah</p>
                </div>');
                redirect(base_url('login'));    
			//echo "Username dan password salah !";
		}
	}
 
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}

