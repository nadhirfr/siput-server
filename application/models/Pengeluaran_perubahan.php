<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengeluaran_perubahan extends CI_Model {

        public $pengeluaran_perubahan_id;
        public $pengeluaran_perubahan_nominal;
        public $pengeluaran_perubahan_date;
        public $pengeluaran_id;
		
        public function __construct()
        {
            parent::__construct();
        }

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('pengeluaran_perubahan');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('pengeluaran_perubahan');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $this->pengeluaran_perubahan_id = $id;
            $this->pengeluaran_perubahan_nama = $_POST['pengeluaran_perubahan_nama'];
            $this->pengeluaran_perubahan_interval = $_POST['pengeluaran_perubahan_interval'];
            $this->db->insert('pengeluaran_perubahan', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->pengeluaran_perubahan_id = $id;
            $this->db->where('pengeluaran_perubahan',$this->pengeluaran_perubahan_id);
            $this->db->delete('pengeluaran_perubahan');
            if($this->db->affected_rows()>0){ 
                return $this->pengeluaran_perubahan_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($pengeluaran_perubahan,$id)
        {
            $this->load->database();
            $this->pengeluaran_perubahan_id = $id;
            $this->pengeluaran_perubahan_nominal = $pengeluaran_perubahan['pengeluaran_perubahan_nominal'];
            $this->pengeluaran_perubahan_date = $pengeluaran_perubahan['pengeluaran_perubahan_date'];
            $this->pengeluaran_id = $pengeluaran_perubahan['pengeluaran_id'];
			
			$this->db->where('pengeluaran_perubahan_id',$id);
            $this->db->update('pengeluaran_perubahan', $this);
			return $pengeluaran_perubahan_id;
        }

}