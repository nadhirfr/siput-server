<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
//    untuk mengcek jumlah username dan password yang sesuai
    function login($username,$password) {
        $this->db->where('user_username', $username);
        $this->db->where('user_password', $password);
        $query =  $this->db->get('user');
        return $query->num_rows();
    }
    
//    untuk mengambil data hasil login
    function data_login($username,$password) {
        $this->db->where('user_username', $username);
        $this->db->where('user_password', $password);
        return $this->db->get('user')->row();
    }
}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */