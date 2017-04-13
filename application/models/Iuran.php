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
            $this->iuran_id = $id;
            $this->db->where('iuran_id',$this->iuran_id);
            $this->db->delete('iuran');
            if($this->db->affected_rows()>0){ 
                return $this->iuran_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($iuran,$id)
        {
            $this->load->database();
            $this->iuran_id = $id;
            $this->iuran_nama = $iuran['iuran_nama'];
            $this->iuran_nominal = $iuran['iuran_nominal'];
			$this->iuran_jenis_id = $iuran['iuran_jenis_id'];
			$this->iuran_kategori_id = $iuran['iuran_kategori_id'];
			
			$this->db->where('iuran_id',$id);
            $this->db->update('iuran', $this);
			return $iuran_id;
        }

}