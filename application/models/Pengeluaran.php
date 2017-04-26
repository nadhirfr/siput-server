<?php
class Pengeluaran extends CI_Model {

        public $pengeluaran_id;
        public $pengeluaran_nama;
        public $pengeluaran_jenis_id;
		public $pengeluaran_keterangan;
		public $pengeluaran_kategori_id;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('pengeluaran');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('pengeluaran');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $query = $this->db->get('pengeluaran');
            $this->pengeluaran_nama = $_POST['pengeluaran_nama'];
            $this->pengeluaran_jenis_id = $_POST['pengeluaran_jenis_id'];
			$this->pengeluaran_keterangan = $_POST['pengeluaran_keterangan'];
			$this->pengeluaran_kategori_id = $_POST['pengeluaran_kategori_id'];
            $this->db->insert('pengeluaran', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->pengeluaran_id = $id;
            $this->db->where('pengeluaran_id',$this->pengeluaran_id);
            $this->db->delete('pengeluaran');
            if($this->db->affected_rows()>0){ 
                return $this->pengeluaran_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($pengeluaran,$id)
        {
            $this->load->database();
            $this->pengeluaran_id = $id;
            $this->pengeluaran_nama = $pengeluaran['pengeluaran_nama'];
            $this->pengeluaran_jenis_id = $pengeluaran['pengeluaran_jenis_id'];
			 $this->pengeluaran_keterangan = $pengeluaran['pengeluaran_keterangan'];
			$this->pengeluaran_kategori_id = $pengeluaran['pengeluaran_kategori_id'];
			
			$this->db->where('pengeluaran_id',$id);
            $this->db->update('pengeluaran', $this);
			return $this->pengeluaran_id;
        }

}