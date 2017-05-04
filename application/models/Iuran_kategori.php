<?php
class Iuran_kategori extends CI_Model {

        public $iuran_kategori_id;
        public $iuran_kategori_nama;
        public $iuran_kategori_interval;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('iuran_kategori');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where('iuran_kategori_id',$id);
            $query = $this->db->get('iuran_kategori');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $query = $this->db->get('iuran_kategori');
            $this->iuran_kategori_nama = $_POST['iuran_kategori_nama'];
            $this->iuran_kategori_interval = $_POST['iuran_kategori_interval'];
            $this->db->insert('iuran_kategori', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->iuran_kategori_id = $id;
            $this->db->where('iuran_kategori_id',$this->iuran_kategori_id);
            $this->db->delete('iuran_kategori');
            if($this->db->affected_rows()>0){ 
                return $this->iuran_kategori_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($iuran_kategori,$id)
        {
            $this->load->database();
            $this->iuran_kategori_id = $id;
            $this->iuran_kategori_nama = $iuran_kategori['iuran_kategori_nama'];
            $this->iuran_kategori_interval = $iuran_kategori['iuran_kategori_interval'];
			
			$this->db->where('iuran_kategori_id',$id);
            $this->db->update('iuran_kategori', $this);
			return $this->iuran_kategori_id;
        }

}