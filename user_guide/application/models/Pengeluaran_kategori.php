<?php
class Pengeluaran_kategori extends CI_Model {

        public $pengeluaran_kategori_id;
        public $pengeluaran_kategori_nama;
        public $pengeluaran_kategori_waktu;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('pengeluaran_kategori');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('pengeluaran_kategori');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $query = $this->db->get('pengeluaran_kategori');
            $this->pengeluaran_kategori_nama = $_POST['pengeluaran_kategori_nama'];
            $this->pengeluaran_kategori_waktu = $_POST['pengeluaran_kategori_waktu'];
            $this->db->insert('pengeluaran_kategori', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->pengeluaran_kategori_id = $id;
            $this->db->where('pengeluaran_kategori_id',$this->pengeluaran_kategori_id);
            $this->db->delete('pengeluaran_kategori');
            if($this->db->affected_rows()>0){ 
                return $this->pengeluaran_kategori_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($pengeluaran_kategori,$id)
        {
            $this->load->database();
            $this->pengeluaran_kategori_id = $id;
            $this->pengeluaran_kategori_nama = $pengeluaran_kategori['pengeluaran_kategori_nama'];
            $this->pengeluaran_kategori_waktu = $pengeluaran_kategori['pengeluaran_kategori_waktu'];
			
			$this->db->where('pengeluaran_kategori_id',$id);
            $this->db->update('pengeluaran_kategori', $this);
			return $this->pengeluaran_kategori_id;
        }

}