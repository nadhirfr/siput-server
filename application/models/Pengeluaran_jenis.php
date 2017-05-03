<?php
class Pengeluaran_jenis extends CI_Model {

        public $pengeluaran_jenis_id;
        public $pengeluaran_nama;
        public $pengeluaran_keterangan;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('pengeluaran_jenis');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('pengeluaran_jenis');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
			$query = $this->db->get('pengeluaran_jenis');
            $this->pengeluaran_nama = $_POST['pengeluaran_nama'];
            $this->pengeluaran_keterangan = $_POST['pengeluaran_keterangan'];
            $this->db->insert('pengeluaran_jenis', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->pengeluaran_jenis_id = $id;
            $this->db->where('pengeluaran_jenis_id',$this->pengeluaran_jenis_id);
            $this->db->delete('pengeluaran_jenis');
            if($this->db->affected_rows()>0){ 
                return $this->pengeluaran_jenis_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($pengeluaran_jenis,$id)
        {
            $this->load->database();
            $this->pengeluaran_jenis_id = $id;
            $this->pengeluaran_nama = $pengeluaran_jenis['pengeluaran_nama'];
            $this->pengeluaran_keterangan = $pengeluaran_jenis['pengeluaran_keterangan'];
			
			$this->db->where('pengeluaran_jenis_id',$id);
            $this->db->update('pengeluaran_jenis', $this);
			return $this->pengeluaran_jenis_id;
        }

}