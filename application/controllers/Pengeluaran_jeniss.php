<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Pengeluaran_jeniss extends REST_Controller {

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
        $this->load->model('pengeluaran_jenis');
        $pengeluaran_jeniss = $this->pengeluaran_jenis->get_all();

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($pengeluaran_jeniss)
            {
                // Set the response and exit
                $this->response($pengeluaran_jeniss, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No jenis pengeluaran were found'
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

            $pengeluaran_jenis = NULL;

            if (!empty($pengeluaran_jeniss))
            {
                foreach ($pengeluaran_jeniss as $key => $value)
                {
                    if (isset($value->pengeluaran_jenis_id) && $value->pengeluaran_jenis_id == $id)
                    {
                        $pengeluaran_jenis = $value;
                    }
                }
            }

            if (!empty($pengeluaran_jeniss))
            {
                $this->set_response($pengeluaran_jenis, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'jenis pengeluaran could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
    
	public function index_put(){
		$this->load->model('pengeluaran_jenis');
		
		if($this->get('pengeluaran_jenis_id') != null){
			 $insert_id = $this->pengeluaran_jenis->update_entry($this->put(),$this->get('id'));
        $message = [
            'pengeluaran_jenis_id' => $this->get('pengeluaran_jenis_id'), 
            'pengeluaran_nama' => $this->put('pengeluarannama'),
            'pengeluaran_keterangan' => $this->put('pengeluaran_keterangan'),
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // HTTP ok response
		} else{
			$message = [
            'message' => 'Id jenis pengeluaran null'
			];
			 $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
       
	}
	
    public function index_post()
    {
        $this->load->model('pengeluaran_jenis');
        $insert_id = $this->pengeluaran_jenis->insert_entry($_POST);
        // $this->some_model->update_user( ... );
        $message = [
            'iuran_jenis_id' => $insert_id, 
            'pengeluaran_nama' => $this->post('pengeluaran_nama'),
            'pengeluaran_keterangan' => $this->post('pengeluaran_keterangan'),
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
    
    public function index_delete()
    {
        $this->load->model('pengeluaran_jenis');
        $id = (int) $this->get('pengeluaran_jenis_id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else{
            $status = $this->pengeluaran_jenis->delete_entry($id);
            // $this->some_model->delete_something($id);
            if($status){
                $message = [
                'id' => $iuran_jenis_id,
                'message' => 'Deleted the resource'
            ];
                $this->set_response($message, REST_Controller::HTTP_OK); //response ok
            } else{
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No iuran jenis were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
            
            
        }

    }
}