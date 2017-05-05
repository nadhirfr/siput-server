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
		
		public function getJumlahTransaksiPerBulan($id,$tipe){
			$this->load->database();
			$jumlah = 0;
			$array = array('MONTH(transaksi_date)' => $id, 'YEAR(transaksi_date)' => date("Y"));
			$this->db->where($array);
            $query = $this->db->get('transaksi');
            $hasil =  $query->result();
			foreach($hasil as $key => $value){
				if($value->transaksi_tipe == $tipe){
					$jumlah = $jumlah + $value->transaksi_nominal;
				} elseif($tipe == null){
					$jumlah = $jumlah + $value->transaksi_nominal;
				}
			}
			
			return $jumlah;
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
			$this->iuran_id= $_POST['iuran_id'] == 'null' ? null : $_POST['iuran_id'];
			$this->pengeluaran_id = $_POST['pengeluaran_id'] == 'null' ? null : $_POST['pengeluaran_id'];
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
		
		public function getJumlahTransaksi(){
			$this->load->database();
			return $this->db->query("SELECT sum(transaksi_nominal) as Jumlah FROM transaksi")->result();
		}
		
		public function getUtang($user_id,$iuran_id){
			$total_bayar = $this->getTotalBayar($user_id,$iuran_id);
			$total_dibayar = $this->getTotalDibayar($user_id,$iuran_id);
			return $total_bayar-$total_dibayar;
			
		}
		
		public function getTotalDibayar($user_id,$iuran_id){
			$this->load->database();
			$total = 0;
			$listTransaksi = $this->get_all();
			
			foreach($listTransaksi as $key => $value){
					if($value->user_id == $user_id
                    && $value->iuran_id == $iuran_id){
						$total = $total + $value->transaksi_nominal;
					}
				}
				
				return $total;
			/* var_dump($this->getTransaksiPertama($user_id,$iuran_id)[0]->transaksi_date); */
			
			//return $iuran;
			
		}
		
		public function getTotalBayar($user_id,$iuran_id){
			$this->load->database();
			$total = 0;
			$this->db->where('iuran_id',$iuran_id);
			$iuran = $this->db->get('iuran')->result();
			
			$this->db->where('iuran_kategori_id',$iuran[0]->iuran_kategori_id);
			$iuran_kategori = $this->db->get('iuran_kategori')->result();
			$iuran[0]->iuran_kategori_interval = $iuran_kategori[0]->iuran_kategori_interval == null ? 0 : $iuran_kategori[0]->iuran_kategori_interval;
			$interval = $iuran[0]->iuran_kategori_interval;
			//var_dump($interval);
			if($interval == 30){
				$d1 = new DateTime('now');
				$d2 = new DateTime($this->getTransaksiPertama($user_id,$iuran_id)[0]->transaksi_date);
				// @link http://www.php.net/manual/en/class.dateinterval.php
				$interval = $d2->diff($d1);
				$beda_bulan = $interval->m + 12*$interval->y;
				$total_bayar = (int)($beda_bulan != null ? $iuran[0]->iuran_nominal * $beda_bulan : $iuran[0]->iuran_nominal);
				
				return $total_bayar;
			} elseif($interval == 7){
				$d1 = new DateTime('now');
				$d2 = new DateTime($this->getTransaksiPertama($user_id,$iuran_id)[0]->transaksi_date);
				$interval = $d1->diff($d2);
				$beda_minggu = (int)(($interval->days)/7);
				
				$total_bayar = (int)($beda_minggu != null ? $iuran[0]->iuran_nominal * $beda_minggu : $iuran[0]->iuran_nominal);
				
				return $total_bayar;
			} else{
				$total_bayar = (int)($iuran[0]->iuran_nominal);
			
				return $total_bayar;
			}
			
			/* var_dump($this->getTransaksiPertama($user_id,$iuran_id)[0]->transaksi_date); */
			
			//return $iuran;
			
		}
		
		public function getJumlahIuran(){
			$this->load->database();
			return $this->db->query("SELECT sum(transaksi_nominal) as Jumlah FROM transaksi WHERE transaksi_tipe='iuran';")->result();
		}
		
		public function getJumlahPengeluaran(){
			$this->load->database();
			return $this->db->query("SELECT sum(transaksi_nominal) as Jumlah FROM transaksi WHERE transaksi_tipe='pengeluaran';")->result();
		}
    
		public function getTransaksiPertama($user_id,$iuran_id){
			$this->load->database();
			return $this->db->query("SELECT * FROM transaksi WHERE transaksi_date IN (SELECT MIN(transaksi_date) 
									FROM transaksi WHERE user_id=".$user_id." AND iuran_id=".$iuran_id.") 
									AND user_id=".$user_id." AND iuran_id=".$iuran_id.";")->result();
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
			return $this->transaksi_id;
        }

}