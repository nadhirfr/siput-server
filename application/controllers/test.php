<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * This controller can be accessed
 * for (all) non logged in users
 */
class Test extends MY_Controller { 
 
    public function logged_in_check()
    {
        if ($this->session->userdata("logged_in")) {
            redirect("dashboard");
        }
    }
 
    public function index()
    {  
        $this->logged_in_check();
       
        $this->load->library('form_validation');
        $this->form_validation->set_rules("username", "Username", "trim|required");
        $this->form_validation->set_rules("password", "Password", "trim|required");
        if ($this->form_validation->run() == true)
        {
            $this->load->model('auth_model', 'auth');  
            // check the username & password of user
            $status = $this->auth->validate();
            if ($status == ERR_INVALID_USERNAME) {
                $this->session->set_flashdata("error", "Username is invalid");
            }
            elseif ($status == ERR_INVALID_PASSWORD) {
                $this->session->set_flashdata("error", "Password is invalid");
            }
            else
            {
                // success
                // store the user data to session
                $this->session->set_userdata($this->auth->get_data());
                $this->session->set_userdata("logged_in", true);
                // redirect to dashboard
                redirect("dashboard");
            }
        }
       
        $this->load->view("auth");
    }
 
    public function lupa_password()
    {
        $this->load->view("lupa_password");
    }
 
    public function action_register()
    {
    $this->load->library('upload');
    $nmfile = "mall_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
    $config['upload_path'] = './folderfoto/'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
    // $config['max_size'] = '2048'; //maksimum besar file 2M
    // $config['max_width'] = '1288'; //lebar maksimum 1288 px
    // $config['max_height'] = '768'; //tinggi maksimu 768 px
    $config['file_name'] = $nmfile; //nama yang terupload nantinya
 
        $this->upload->initialize($config);
 
        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
                  'gambar_mall' =>$gbr['file_name'],
                  'username' =>$this->input->post('username'),
                  'password' =>sha1($this->input->post('password')),
                  'lat_mall' =>$this->input->post('lat_mall'),
                  'long_mall' =>$this->input->post('long_mall'),
                  'nama_mall' =>$this->input->post('nama_mall'),
                  'alamat_mall' =>$this->input->post('alamat_mall'),
                  'role' =>$this->input->post('role'),
 
                );
 
                $this->db->insert('t_mall', $data); //akses model untuk menyimpan ke database
                //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Upload gambar berhasil !!</div></div>");
                redirect('auth','refresh'); //jika berhasil maka akan ditampilkan view vupload
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Gagal upload gambar !!</div></div>");
                redirect('auth/register'); //jika gagal maka akan ditampilkan form upload
            }
        }
    }                  
 
    public function logout()
    {
        $this->session->unset_userdata("logged_in");
        $this->session->sess_destroy();
        redirect("auth");
    }
 
    public function forget()
    {
        $this->load->view('forget');
    }
 
}