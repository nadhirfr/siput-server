<?php
class Iuran_jenis extends CI_Model {

        public $iuran_jenis_id;
        public $iuran_jenis_nama;
        public $iuran_jenis_keterangan;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('iuran_jenis');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('iuran_jenis');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $this->iuran_jenis_id = $_POST['iuran_jenis_id'];
            $this->iuran_jenis_nama = $_POST['iuran_jenis_nama'];
            $this->iuran_jenis_keterangan = $_POST['iuran_jenis_keterangan'];
            $this->db->insert('iuran_jenis', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->iuran_jenis_id = $id;
            $this->db->where('iuran_jenis',$this->iuran_jenis_id);
            $this->db->delete('iuran_jenis');
            if($this->db->affected_rows()>0){ 
                return $this->iuran_jenis_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($iuran_jenis,$id)
        {
            $this->load->database();
            $this->iuran_jenis_id = $id;
            $this->iuran_jenis_nama = $iuran_jenis['iuran_jenis_nama'];
            $this->iuran_jenis_keterangan = $iuran_jenis['iuran_jenis_keterangan'];
			
			$this->db->where('iuran_jenis_id',$id);
            $this->db->update('iuran_jenis', $this);
			return $iuran_jenis_id;
        }

}