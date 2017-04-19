<?php
class Session extends CI_Model {

        public $session_id;
        public $user_id;
		public $session_time;
		public $session_status;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('session');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('session');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
			$this->user_id = $_POST['user_id'];
			$this->session_time= $_POST['session_time'];
            $this->session_status = $_POST['session_status'];
            $this->db->insert('session', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->session_id = $id;
            $this->db->where('session',$this->session_id);
            $this->db->delete('session');
            if($this->db->affected_rows()>0){ 
                return $this->session_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($session,$id)
        {
            $this->load->database();
            $this->session_id = $id;
            $this->session_status = $session['session_status'];
            $this->user_id = $session['user_id'];
			$this->session_time = $session['session_time'];

			$this->db->where('session_id',$id);
            $this->db->update('session', $this);
			return $session_id;
        }

}