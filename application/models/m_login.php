<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_login extends CI_Model {

    function cek_login($table,$where){      
        return $this->db->get_where($table,$where);
        if($cek > 0){
            $data_session = array(
            'nama' => $username,
            'status' => "login"
            );

            $this->session->set_userdata($data_session);
            echo "berhasil";
            redirect(base_url("welcome"));
        }else{
            echo "Username dan password salah !";
        }
    }   

}
