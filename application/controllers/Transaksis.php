 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Transaksis extends REST_Controller {

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

    
    public function index_get()
    {
        $this->load->model('transaksi');
        $transaksis = $this->transaksi->get_all();
		

        $id = $this->get('id');
		$param = $this->get('param');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            
			if($param == 'jumlahTransaksi'){
					$message = $this->transaksi->getJumlahTransaksi();
					$this->response($message,REST_Controller::HTTP_OK);
				} elseif($param == 'jumlahIuran'){
					$message = $this->transaksi->getJumlahIuran();
					$this->response($message,REST_Controller::HTTP_OK);
				} elseif ($param == 'jumlahPengeluaran'){
					$message = $this->transaksi->getJumlahPengeluaran();
					$this->response($message,REST_Controller::HTTP_OK);
				} elseif($param == 'getUtang'){
					$user_id = $this->get('user_id');
					$iuran_id = $this->get('iuran_id');
					
					$message = $this->transaksi->getUtang($user_id, $iuran_id);
					$this->response($message,REST_Controller::HTTP_OK);
				} elseif($param == 'getTotalBayar'){
					$user_id = $this->get('user_id');
					$iuran_id = $this->get('iuran_id');
					
					$message = $this->transaksi->getTotalBayar($user_id, $iuran_id);
					
					$this->response($message,REST_Controller::HTTP_OK);
				} elseif($param == 'getTotalDibayar'){
					$user_id = $this->get('user_id');
					$iuran_id = $this->get('iuran_id');
					
					$message = $this->transaksi->getTotalDibayar($user_id, $iuran_id);
					
					$this->response($message,REST_Controller::HTTP_OK);
				} else{// Check if the users data store contains users (in case the database result returns NULL)
					if ($transaksis)
					{
							// Set the response and exit
							$this->response($transaksis, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
						
					}
					else
					{
						// Set the response and exit
						$this->response([
							'status' => FALSE,
							'message' => 'No transaksi were found'
						], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
					}
				}
        }

        // Find and return a single record for a particular user.
        else {
            $id = (int) $id;
			$iuran_id = $this->input->get('iuran_id');
			$user_id = $this->input->get('user_id');

            // Validate the id.
            if ($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $transaksi = NULL;

            if (!empty($iuran_id) && $param == 'transaksiPertama'){
				$transaksi = $this->transaksi->getTransaksiPertama($user_id,$iuran_id);
			}elseif(!empty($transaksis))
            {
                foreach ($transaksis as $key => $value)
                {
                    if (isset($value->transaksi_id) && $value->transaksi_id == $id)
                    {
                        $transaksi = $value;
                    }
                }
            }

            if (!empty($transaksi))
            {
                $this->set_response($transaksi, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => ' transaksi could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
    
	public function index_put(){
		$this->load->model('transaksi');
		
		if($this->input->get('id') != null){
			 $insert_id = $this->transaksi->update_entry($this->put(),$this->input->get('id'));
        $message = [
            'id' => $this->input->get('id'), 
            'transaksi_date' => $this->put('transaksi_date'),
            'transaksi_nama' => $this->put('transaksi_nama'),
			'transaksi_nominal' => $this->put('transaksi_nominal'),
			'user_id' => $this->put('user_id'),
			'transaksi_tipe' => $this->put('transaksi_tipe'),
			'iuran_id' => $this->put('iuran_id'),
			'pengeluaran_id' => $this->put('pengeluaran_id'),
            'message'=>'update transaksi'
        ];

        $this->set_response($message, REST_Controller::HTTP_OK); // HTTP ok response
		} else{
			$message = [
            'message' => 'transaksi null'
			];
			 $this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		}
       
	}
	
    public function index_post()
    {
        $this->load->model('transaksi');
		// var_dump($_POST);
        $insert_id = $this->transaksi->insert_entry($_POST);
        // $this->some_model->update_user( ... );
        $message = [
           'id' => $insert_id, 
            'transaksi_date' => $this->input->post('transaksi_date'),
            'transaksi_nama' => $this->post('transaksi_nama'),
			'transaksi_nominal' => $this->post('transaksi_nominal'),
			'user_id' => $this->post('user_id'),
			'transaksi_tipe' => $this->post('transaksi_tipe'),
			'iuran_id' => $this->post('iuran_id') == null ? '':$this->post('iuran_id'),
			'pengeluaran_id' => $this->post('pengeluaran_id') == null ? '':$this->post('pengeluaran_id'),
            'message' => 'added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    
	}
    
    public function index_delete()
    {
        $this->load->model('transaksi');
        $id =$this->input->get('id');

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
            $status = $this->transaksi->delete_entry($id);
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