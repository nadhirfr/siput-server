<?php
class Deposit_perubahan extends CI_Model {

        public $deposit_perubahan_id;
        public $deposit_perubahan_date;
        public $deposit_id;
		public $transaksi_id;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('deposit_perubahan');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('deposit_perubahan');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $query = $this->db->get('deposit_perubahan');
            $this->deposit_perubahan_date = $_POST['deposit_perubahan_date'];
			$this->deposit_id = $_POST['deposit_id'];
            $this->transaksi_id = $_POST['transaksi_id'];
            $this->db->insert('deposit_perubahan', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->deposit_perubahan_id = $id;
            $this->db->where('deposit_perubahan_id',$this->deposit_perubahan_id);
            $this->db->delete('deposit_perubahan');
            if($this->db->affected_rows()>0){ 
                return $this->deposit_perubahan_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($deposit_perubahan,$id)
        {
            $this->load->database();
            $this->deposit_perubahan_id = $id;
            $this->deposit_perubahan_date = $deposit_perubahan['deposit_perubahan_date'];
            $this->deposit_id = $deposit_perubahan['deposit_id'];
			$this->transaksi_id = $deposit_perubahan['transaksi_id'];
			
			$this->db->where('deposit_perubahan_id',$id);
            $this->db->update('deposit_perubahan', $this);
			return $deposit_perubahan_id;
        }

}