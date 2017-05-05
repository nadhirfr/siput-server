<?php
class Iuran_user extends CI_Model {

        public $iuran_user_id;
        public $iuran_user_status;
        public $user_id;
		public $iuran_id;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('iuran_user');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where('iuran_user_id',$id);
            $query = $this->db->get('iuran_user');
            return $query->result();
		}
    
		public function getByUserID($id){
			$this->load->database();
			$this->db->where('user_id',$id);
            $query = $this->db->get('iuran_user');
            return $query->result();
		}
		
		public function getBelumLunas($user_id){
			$this->load->database();
			$array = array('user_id' => $user_id, 'iuran_user_status' => 0);
			$this->db->where($array);
			//$this->db->where('user_id',$id);
            $query = $this->db->get('iuran_user');
            return $query->result();
		}

		
        public function insert_entry()
        {
            $this->load->database();
            $query = $this->db->get('iuran_user');
            $this->iuran_user_status = $_POST['iuran_user_status'];
            $this->user_id = $_POST['user_id'];
			$this->iuran_id = $_POST['iuran_id'];
            $this->db->insert('iuran_user', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->iuran_user_id = $id;
            $this->db->where('iuran_user_id',$this->iuran_user_id);
            $this->db->delete('iuran_user');
            if($this->db->affected_rows()>0){ 
                return $this->iuran_user_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($iuran_user,$id)
        {
            $this->load->database();
            $this->iuran_user_id = $id;
            $this->iuran_user_status = $iuran_user['iuran_user_status'];
            $this->user_id = $iuran_user['user_id'];
			$this->iuran_id = $iuran_user['iuran_id'];
			
			$this->db->where('iuran_user_id',$id);
            $this->db->update('iuran_user', $this);
			return $this->iuran_user_id;
        }

}