<?php
class Iuran extends CI_Model {

        public $iuran_id;
        public $iuran_nama;
        public $iuran_nominal;
		public $iuran_jenis_id;
		public $iuran_kategori_id;

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('iuran');
            return $query->result();
        }

    
        public function insert_entry()
        {
            $this->load->database();
            $this->iuran_nama = $_POST['nama'];
            $this->iuran_nominal = $_POST['nominal'];
            $this->iuran_jenis_id = $_POST['jenis'];
            $this->iuran_kategori_id = $_POST['kategori'];
            $this->db->insert('iuran', $this);
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

        public function update_entry()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('entries', $this, array('id' => $_POST['id']));
        }

}