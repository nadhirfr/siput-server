<?php
class Deposit extends CI_Model {

        public $deposit_id;
        public $user_id;
        public $deposit_jumlah;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('deposit');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where('deposit_id',$id);
            $query = $this->db->get('deposit');
            return $query->result();
		}
		
		public function getByUserID($user_id){
			$this->load->database();
			$this->db->where('user_id',$user_id);
            $query = $this->db->get('deposit');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $query = $this->db->get('deposit');
            $this->deposit_jumlah = $_POST['deposit_jumlah'];
            $this->user_id = $_POST['user_id'];
            $this->db->insert('deposit', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->deposit_id = $id;
            $this->db->where('deposit_id',$this->deposit_id);
            $this->db->delete('deposit');
            if($this->db->affected_rows()>0){ 
                return $this->deposit_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($deposit,$id)
        {
            $this->load->database();
            $this->deposit_id = $id;
            $this->user_id = $deposit['user_id'];
            $this->deposit_jumlah = $deposit['deposit_jumlah'];
			
			$this->db->where('deposit_id',$id);
            $this->db->update('deposit', $this);
			return $this->deposit_id;
        }

}