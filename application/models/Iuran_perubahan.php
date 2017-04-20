<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Iuran_perubahan extends CI_Model {

        public $iuran_perubahan_id;
        public $iuran_perubahan_nominal;
        public $iuran_perubahan_date;
        public $iuran_id;
		
        public function __construct()
        {
            parent::__construct();
        }

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('iuran_perubahan');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('iuran_perubahan');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $this->iuran_perubahan_id = $_POST['iuran_perubahan_id'];
            $this->iuran_perubahan_nama = $_POST['iuran_perubahan_nama'];
            $this->iuran_perubahan_interval = $_POST['iuran_perubahan_interval'];
            $this->db->insert('iuran_perubahan', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->iuran_perubahan_id = $id;
            $this->db->where('iuran_perubahan',$this->iuran_perubahan_id);
            $this->db->delete('iuran_perubahan');
            if($this->db->affected_rows()>0){ 
                return $this->iuran_perubahan_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($iuran_perubahan,$id)
        {
            $this->load->database();
            $this->iuran_perubahan_id = $id;
            $this->iuran_perubahan_nominal = $iuran_perubahan['iuran_perubahan_nominal'];
            $this->iuran_perubahan_date = $iuran_perubahan['iuran_perubahan_date'];
            $this->iuran_id = $iuran_perubahan['iuran_id'];
			
			$this->db->where('iuran_perubahan_id',$id);
            $this->db->update('iuran_perubahan', $this);
			return $iuran_perubahan_id;
        }

}