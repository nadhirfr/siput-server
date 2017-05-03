<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->database();
        if((!isset($_SESSION['nama']))){
            redirect(base_url('login'));
        }}

    public function tampil()
    {
        echo "string";
        $data = $this->user->get_user($_SESSION['nama']);
        $this->load->view('profil', $data);
    }

   

    public function _rules() 
    {
	$this->form_validation->set_rules('user_username', 'user username', 'trim|required');
	$this->form_validation->set_rules('user_displayname', 'user displayname', 'trim|required');
	$this->form_validation->set_rules('user_password', 'user password', 'trim|required');
	$this->form_validation->set_rules('user_tipe', 'user tipe', 'trim|required');

	$this->form_validation->set_rules('user_id', 'user_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-02 18:54:56 */
/* http://harviacode.com */