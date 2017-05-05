<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Iuran_users extends REST_Controller {

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
        $this->load->model('iuran_user');
        $iuran_users = $this->iuran_user->get_all();

        $id = $this->get('id');
        $param = $this->get('param');
        $user_id = $this->get('user_id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($iuran_users)
            {
				if($param == 'getBelumLunas' and $user_id != null){
					$message = $this->iuran_user->getBelumLunas($user_id);
					$this->response($message, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
				} else{
					// Set the response and exit
					$this->response($iuran_users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
				}
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No iuran iuran_users were found'
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

            $iuran_user = NULL;

            if (!empty($iuran_users))
            {
                foreach ($iuran_users as $key => $value)
                {
                    if (isset($value->iuran_user_id) && $value->iuran_user_id == $id)
                    {
                        $iuran_user = $value;
                    }
                }
            }

            if (!empty($iuran_user))
            {
                $this->set_response($iuran_user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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
		$this->load->model('iuran_user');
		
		if($this->input->get('id') != null){
			 $insert_id = $this->iuran_user->update_entry($this->put(),$this->input->get('id'));
        $message = [
            'id' => $this->input->get('id'), 
            'iuran_user_status' => $this->put('iuran_user_status'),
            'user_id' => $this->put('user_id'),
            'iuran_id' => $this->put('iuran_id'),
            'message'=>'update iuran_perubahan'
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // HTTP ok response
		} else{
			$message = [
            'message' => 'Id iuran user null'
			];
			 $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
       
	}
	
    public function index_post()
    {
        $this->load->model('iuran_user');
        $insert_id = $this->iuran_user->insert_entry($_POST);
        // $this->some_model->update_user( ... );
        $message = [
           'id' => $insert_id, 
            'iuran_user_status' => $this->post('iuran_user_status'),
            'user_id' => $this->post('user_id'),
            'iuran_id' => $this->post('iuran_id'),
            'message' => 'added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
    
    public function index_delete()
    {
        $this->load->model('iuran_user');
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
            $status = $this->iuran_user->delete_entry($id);
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