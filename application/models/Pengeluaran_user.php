<?php
class Pengeluaran_user extends CI_Model {

        public $pengeluaran_user_id;
        public $pengeluaran_user_status;
        public $user_id;
		public $pengeluaran_id;
		public $transaksi_id;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('pengeluaran_user');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('pengeluaran_user');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
			 $query = $this->db->get('user');
            $this->pengeluaran_user_status = $_POST['pengeluaran_user_status'];
            $this->user_id = $_POST['user_id'];
			$this->pengeluaran_id = $_POST['pengeluaran_id'];
			$this->transaksi_id = $_POST['transaksi_id'];
            $this->db->insert('pengeluaran_user', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->pengeluaran_user_id = $id;
            $this->db->where('pengeluaran_user_id',$this->pengeluaran_user_id);
            $this->db->delete('pengeluaran_user');
            if($this->db->affected_rows()>0){ 
                return $this->pengeluaran_user_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($pengeluaran_user,$id)
        {
            $this->load->database();
            $this->pengeluaran_user_id = $id;
            $this->pengeluaran_user_status = $pengeluaran_user['pengeluaran_user_status'];
            $this->user_id = $pengeluaran_user['user_id'];
			$this->pengeluaran_id = $pengeluaran_user['pengeluaran_id'];
			$this->transaksi_id = $pengeluaran_user['transaksi_id'];
			
			$this->db->where('pengeluaran_user_id',$id);
            $this->db->update('pengeluaran_user', $this);
			return $this->pengeluaran_user_id;
        }

}