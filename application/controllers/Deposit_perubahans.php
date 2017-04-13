<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Deposit_perubahans extends REST_Controller {

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
        $this->load->model('deposit_perubahan');
        $deposit_perubahans = $this->deposit_perubahan->get_all();

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($deposit_perubahans)
            {
                // Set the response and exit
                $this->response($deposit_perubahans, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No iuran were found'
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

            $deposit_perubahan = NULL;

            if (!empty($deposit_perubahans))
            {
                foreach ($deposit_perubahans as $key => $value)
                {
                    if (isset($value->deposit_perubahan_id) && $value->deposit_perubahan_id == $id)
                    {
                        $deposit_perubahan = $value;
                    }
                }
            }

            if (!empty($deposit_perubahans))
            {
                $this->set_response($deposit_perubahan, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'depposit perubahan could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
    
	public function index_put(){
		$this->load->model('deposit_perubahan');
		
		if($this->get('deposit_perubahan_id') != null){
			 $insert_id = $this->iuran->update_entry($this->put(),$this->get('id'));
        $message = [
            'deposit_perubahan_id' => $this->get('deposit_perubahan_id'), 
            'deposit_perubahan_date' => $this->put('deposit_perubahan_date'),
            'deposit_id' => $this->put('deposit_id'),
			'transaksi_id' => $this->put('transaksi_id'),
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // HTTP ok response
		} else{
			$message = [
            'message' => 'Id iuran null'
			];
			 $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
       
	}
	
    public function index_post()
    {
        $this->load->model('deposit_perubahan');
        $insert_id = $this->deposit_perubahan->insert_entry($_POST);
        // $this->some_model->update_user( ... );
        $message = [
            'deposit_perubahan_id' => $this->get('deposit_perubahan_id'), 
            'deposit_perubahan_date' => $this->put('deposit_perubahan_date'),
            'deposit_id' => $this->put('deposit_id'),
			'transaksi_id' => $this->put('transaksi_id'),
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
    
    public function index_delete()
    {
        $this->load->model('deposit_perubahan');
        $id = (int) $this->get('deposit_perubahan_id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else{
            $status = $this->deposit_perubahan->delete_entry($id);
            // $this->some_model->delete_something($id);
            if($status){
                $message = [
                'id' => $deposit_perubahan_id,
                'message' => 'Deleted the resource'
            ];
                $this->set_response($message, REST_Controller::HTTP_OK); //response ok
            } else{
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No deposit were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
            
            
        }

    }
}