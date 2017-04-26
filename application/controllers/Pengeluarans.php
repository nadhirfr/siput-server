<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Pengeluarans extends REST_Controller {

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
	/* public function index()
	{
        //$this->load->model('user');
        //$valid_logins = $this->user->getValidLogins();
		//echo "Hello world!";
	}
    
    public function login_post(){
        $this->load->model('user');
        $username = $this->post('username');
    }
    
    public function login_get(){
        $id = $this->get('id');
        $this->response($id, REST_Controller::HTTP_OK);
    } */
    
    public function index_get()
    {
        $this->load->model('pengeluaran');
        $pengeluarans = $this->pengeluaran->get_all();

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($pengeluarans)
            {
                // Set the response and exit
                $this->response($pengeluarans, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No pengeluaran were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        else {
            $id = (int) $id;

            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $pengeluaran = NULL;

            if (!empty($pengeluarans))
            {
                foreach ($pengeluarans as $key => $value)
                {
                    if (isset($value->pengeluaran_id) && $value->pengeluaran_id == $id)
                    {
                        $pengeluaran = $value;
                    }
                }
            }

            if (!empty($pengeluaran))
            {
                $this->set_response($pengeluaran, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => ' iuran user could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
    
	public function index_put(){
		$this->load->model('pengeluaran');
		
		if($this->input->get('id') != null){
			 $insert_id = $this->pengeluaran->update_entry($this->put(),$this->input->get('id'));
        $message = [
            'id' => $this->input->get('id'), 
            'pengeluaran_nama' => $this->put('pengeluaran_nama'),
            'pengeluaran_jenis_id' => $this->put('pengeluaran_jenis_id'),
            'pengeluaran_kategori_id' => $this->put('pengeluaran_kategori_id'),
			'pengeluaran_keterangan' => $this->put('pengeluaran_keterangan'),
            'message'=>'update pengeluaran'
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // HTTP ok response
		} else{
			$message = [
            'message' => 'Id pengeluaran null'
			];
			 $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
       
	}
	
    public function index_post()
    {
        $this->load->model('pengeluaran');
        $insert_id = $this->pengeluaran->insert_entry($_POST);
        // $this->some_model->update_user( ... );
        $message = [
           'id' => $insert_id, 
            'pengeluaran_nama' => $this->post('pengeluaran_nama'),
            'pengeluaran_jenis_id' => $this->post('pengeluaran_jenis_id'),
			'pengeluaran_keterangan' => $this->post('pengeluaran_keterangan'),
            'pengeluaran_kategori_id' => $this->post('pengeluaran_kategori_id'),
            'message' => 'added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
    
    public function index_delete()
    {
        $this->load->model('pengeluaran');
        $id = $this->input->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
			$message = [
                'id' => $id,
                'message' => 'error'
				];
            $this->response($message, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else{
            $status = $this->pengeluaran->delete_entry($id);
            // $this->some_model->delete_something($id);
            if($status){
                $message = [
                'id' => $id,
                'message' => 'Deleted the resource'
            ];
                $this->set_response($message, REST_Controller::HTTP_OK); //response ok
            } else{
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND);// NOT_FOUND (404) being the HTTP response code
            }
            
            
        }

    }
}