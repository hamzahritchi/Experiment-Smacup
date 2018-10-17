<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Penagihan extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("kwitansi_id",$kode)->get("eksperimen_kwitansi");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$peserta = $this->session->userdata("id");
			$this->db->where("peserta_id",$peserta);
			$datauser=$this->db->where("kwitansi_id",$kode)->get("eksperimen_bariskwitansi");
			return $datauser->result_array();
		}

		public function get_harga($kode){
			$this->load->database();
			$peserta = $this->session->userdata("id");
			$this->db->where("peserta_id",$peserta);
			return $this->db->where('barang_id',$kode)->get("eksperimen_barang")->row();
		}

		public function get_penagihan(){
			$this->load->library("session");

			$peserta = $this->session->userdata("id");
			$this->db->where("peserta_id",$peserta);
			$kwitansi=$this->db
					->from("eksperimen_kwitansi p")
					->join("eksperimen_kontak k","k.kontak_id=p.kontak_id")
					->get()
					->result();

			return $kwitansi;
		}
		public function get_id(){
			$this->load->database();
			$this->load->library("session");
			$kode = 1000;

			$peserta = $this->session->userdata("id");	


			$pesanan=$this->db
					->where("peserta_id",$peserta)
					->order_by("kwitansi_id","desc")
					->limit(1)
					->get("eksperimen_kwitansi");
			if($pesanan->num_rows() > 0) $kode = "1".substr($pesanan->row()->kwitansi_id,-3);

			$kode++;
			$id = "SI".substr($kode,-3);
			return $id;
		}

	public function tambah_penagihan()
    {
		//validasi
        $this->load->library('form_validation');
        $this->load->model("m_Serbaguna","ms");

        $this->form_validation->set_rules('id', 'id', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			//gabung mang
			$id=$this->input->post("id");
			$pengirim=$this->input->post("pengirim");
			$pemesan=$this->input->post("pemesan");
			$tanggal=$this->input->post("tanggal");
			$term=$this->input->post("term");
			$beban=$this->input->post("beban");
			$dp=$this->input->post("dp");
			$peserta = $this->session->userdata("id");

			$barang=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");

			$case1_a3 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case1")->row()->case1_a3;
				if($case1_a3 == 1) return ["gagal","Anda sudah mengerjakan soal ini"];


			if(empty($pengirim)){
				$pengirim=null;
			} else {
				if($this->ms->cek_ada("eksperimen_pengiriman",["pengiriman_id"=>$pengirim,"peserta_id"=>$peserta])==FALSE) return ["gagal","No Resi salah"];
			}

			if($this->ms->cek_ada("eksperimen_kwitansi",["kwitansi_id"=>$id,"peserta_id"=>$peserta])==TRUE) return ["gagal","No Kwitansi telah dipakai"];

			$cek=0;
			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;
				$cek++;
			}

			if($cek==0) return ["gagal","Isi kosong"];
			//poin 12-14
			$n12 = 0;
			$n13 = 0;
			$n14 = 0;

			if($pengirim == "BDO001") $n12 =1;
			if($tanggal == "2018-09-10") $n14 = 1;

			$data=array(
				"kwitansi_id"=>$id,
				"pengiriman_id"=>$pengirim,
				"kwitansi_tanggal"=>$tanggal,
				"kontak_id"=>$pemesan,
				"kwitansi_status"=>0,
				"kwitansi_dp"=>$dp,
				"kwitansi_beban"=>$beban,
				"kwitansi_term"=>$term,
				"peserta_id"=>$peserta
				);

			$this->db->insert("eksperimen_kwitansi",$data);

			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;

				$dbarang=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row();

				if($this->ms->cek_ada("eksperimen_bariskwitansi",array("barang_id"=>$barang[$i],"kwitansi_id"=>$id))){
					$this->db->where("barang_id",$barang[$i])->where(["kwitansi_id"=>$id,"peserta_id"=>$peserta])->set("bariskwitansi_jumlah","bariskwitansi_jumlah+".$jumlah[$i],false)->set("bariskwitansi_subtotal","bariskwitansi_subtotal +".($jumlah[$i]*$dbarang->hjualbarang),false)->update("eksperimen_bariskwitansi");
					continue;
				}

				$data=array(
						"kwitansi_id"=>$id,
						"barang_id"=>$barang[$i],
						"bariskwitansi_jumlah"=>$jumlah[$i],
						"bariskwitansi_subtotal"=>$jumlah[$i]*$dbarang->barang_hargajual,
						"peserta_id"=>$peserta
					);

				//Update status pengiriman
				$this->db->set("pengiriman_status",1)->where(["pengiriman_id"=>$pengirim,"peserta_id"=>$peserta])->update("eksperimen_pengiriman");
				$this->db->insert("eksperimen_bariskwitansi",$data);

				if($jumlah[$i] == 50) $n13=1;
			}

			$data = array(
				"case1_12" => $n12,
				"case1_13" => $n13,
				"case1_14" => $n14,
				"case1_a3" => 1,
			);

			$this->db->where("peserta_id",$peserta)->update("eksperimen_case1",$data);
			return "berhasil";
		}
	}

	public function delete_penagihan($kode){
		$id=$kode;
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("pesanan",["kwitansi_id"=>$id,"peserta_id"=>$peserta])==TRUE){
			
				$this->db->where(["kwitansi_id"=>$id,"peserta_id"=>$peserta])->delete("eksperimen_bariskwitansi");
			if($this->db->where(["kwitansi_id"=>$id,"peserta_id"=>$peserta])->delete("eksperimen_kwitansi")){
				return "berhasil";
			}
		else{
				return "gagal";
			}
		}
		else{
			return "gagal";
		}
	}
}
?>