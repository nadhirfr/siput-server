<?php
class User extends CI_Model {

        public $user_id;
        public $user_username;
        public $user_password;
		public $user_displayname;
		public $user_tipe;

    
        public function get_all()
        {
            $this->load->database();
                $query = $this->db->get('user');
                return $query->result();
        }

		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('user');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $this->user_username = $_POST['username'];
            $this->user_displayname = $_POST['displayname'];
            $this->user_password = $_POST['password'];
            $this->user_tipe = $_POST['tipe'];
            $this->db->insert('user', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->user_id = $id;
            $this->db->where('user_id',$this->user_id);
            $this->db->delete('user');
            if($this->db->affected_rows()>0){ 
                return $this->user_id;
            }else{
               return false; 
            }
               
        }
        
        public function getValidLogins(){
            $this->load->database();
            $query = $this->db->get('user');
            $result = $query->result();
            $user = NULL;
             foreach($result as $key => $values){
                 $user[] = array($values->user_username => $values->user_password);
             }
            return $user;
        }

        public function update_entry($user, $id)
        {
			$this->load->database();
            $this->user_id = $id;
            $this->user_username = $user['username'];
            $this->user_displayname = $user['displayname'];
            $this->user_password = $user['password'];
            $this->user_tipe = $user['tipe'];
			
			$this->db->where('user_id',$id);
            $this->db->update('user', $this);
			return $this->user_id;
        }

}