<?php
class Transaksi extends CI_Model {

        public $transaksi_id;
		public $transaksi_date;
		public $transaksi_nama;
		public $transaksi_nominal;
        public $user_id;
		public $transaksi_tipe;
		public $iuran_id;
		public $pengeluaran_id;
		

    
        public function get_all()
        {
            $this->load->database();
            $query = $this->db->get('transaksi');
            return $query->result();
        }
		
		public function get($id){
			$this->load->database();
			$this->db->where($id);
            $query = $this->db->get('transaksi');
            return $query->result();
		}
    
        public function insert_entry()
        {
            $this->load->database();
            $query = $this->db->get('transaksi');
            $this->transaksi_date = $_POST['transaksi_date'];
            $this->transaksi_nama= $_POST['transaksi_nama'];
			$this->transaksi_nominal= $_POST['transaksi_nominal'];
			$this->user_id = $_POST['user_id'];
			$this->transaksi_tipe = $_POST['transaksi_tipe'];
			$this->iuran_id= $_POST['iuran_id'];
			$this->pengeluaran_id = $_POST['pengeluaran_id'];
            $this->db->insert('transaksi', $this);
            $insert_id = $this->db->insert_id();
//            In case of multiple inserts you could use
//            $this->db->trans_start();
//            $this->db->trans_complete();
//            
                
            return $insert_id;
        }
    
        public function delete_entry($id){
            $this->load->database();
            $this->transaksi_id = $id;
            $this->db->where('transaksi_id',$this->transaksi_id);
            $this->db->delete('transaksi');
            if($this->db->affected_rows()>0){ 
                return $this->transaksi_id;
            }else{
               return false; 
            }
               
        }
    

        public function update_entry($transaksi,$id)
        {
            $this->load->database();
            $this->transaksi_id = $id;
            $this->transaksi_date = $transaksi['transaksi_date'];
            $this->transaksi_nama= $transaksi['transaksi_nama'];
			$this->transaksi_nominal= $transaksi['transaksi_nominal'];
			$this->user_id = $transaksi['user_id'];
			$this->transaksi_tipe = $transaksi['transaksi_tipe'];
			$this->iuran_id= $transaksi['iuran_id'];
			$this->pengeluaran_id = $transaksi['pengeluaran_id'];
			
			$this->db->where('transaksi_id',$id);
            $this->db->update('transaksi', $this);
			return $transaksi_id;
        }

}