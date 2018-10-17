<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Pesanbeli extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$peserta = $this->session->userdata("id");
			
			$datauser=$this->db->where("pesanbeli_id",$kode)->where("peserta_id",$peserta)->get("eksperimen_pesanbeli");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$peserta = $this->session->userdata("id");
			$this->load->database();
			$datauser=$this->db->where("pesanbeli_id",$kode)->where("peserta_id",$peserta)->get("eksperimen_barispesanbeli");
			return $datauser->result_array();
		}

		public function get_harga($kode){
			$this->load->database();
			return $this->db->where('barang_id',$kode)->get("eksperimen_barang")->row();
		}

		public function get_pesanan(){
			$this->load->library("session");
			$peserta = $this->session->userdata("id");

			$pesanan=$this->db->where("peserta_id",$peserta)
					->from("eksperimen_pesanbeli p")
					->join("eksperimen_kontak k","k.kontak_id=p.kontak_id")
					->get()
					->result();

			return $pesanan;
		}

		public function get_id(){
			$this->load->database();
			$this->load->library("session");
			$kode = 1000;

			$peserta = $this->session->userdata("id");

			$pesanan=$this->db
					->where("peserta_id",$peserta)
					->order_by("pesanbeli_id","desc")
					->limit(1)
					->get("eksperimen_pesanbeli");
			if($pesanan->num_rows() > 0) $kode = "1".substr($pesanan->row()->pesanbeli_id,-3);

			$kode++;
			$id = "P".substr($kode,-3);
			return $id;
		}
			
	public function tambah_pesanan(){
		//validasi
        $this->load->library('form_validation');
        $this->load->model("m_Serbaguna","ms");

        $this->form_validation->set_rules('id', 'id', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('vendor', 'id', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('tanggal', 'id', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('term', 'id', 'trim|required|max_length[30]');
		
		 if($this->form_validation->run() == FALSE){
			return array("gagal","Form tidak lengkap");
		}
		else{
			//gabung mang
			$id=$this->input->post("id");
			$vendor=$this->input->post("vendor");
			$tanggal=$this->input->post("tanggal");
			$term=$this->input->post("term");
			$peserta = $this->session->userdata("id");

			$case2_a1 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case2")->row()->case2_a1;
			if($case2_a1 == 1) return ["gagal","Anda sudah mengerjakan soal ini"];

			$barang=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");

			if($this->ms->cek_ada("eksperimen_pesanbeli",["pesanbeli_id"=>$id,"peserta_id"=>$peserta])==TRUE) return ["gagal","ID Sudah dipakai"];

			$cek=0;
			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;
				$cek++;
			}

			if ($cek == 0) return ["gagal","Barang belum diinput"];

			$data=array(
				"pesanbeli_id"=>$id,
				"pesanbeli_tanggal"=>$tanggal,
				"kontak_id"=>$vendor,
				"pesanbeli_status"=>0,
				"peserta_id"=>$peserta,
				"pesanbeli_term"=>$term
				);

			$this->db->insert("eksperimen_pesanbeli",$data);

			//poin 2-6
			$n2 = 0;
			$n3 = 0;
			$n4 = 0;
			$n5 = 0;
			$n6 = 0;

			if($vendor == 9) $n2 = 1; //PT Kain Katun
			if($tanggal == "2018-10-11") $n3 = 1; //tanggal
			if($term == "fob_destination_point") $n4 = 1; //FOB Destination

			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;

				$dbarang=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row();

				if($this->ms->cek_ada("eksperimen_barispesanbeli",array("barang_id"=>$barang[$i],"pesanbeli_id"=>$id,"peserta_id"=>$peserta))){
					$this->db->where("barang_id",$barang[$i])->where("pesanbeli_id",$id)->where("peserta_id",$peserta)->set("barispesanbeli_jumlah","barispesanbeli_jumlah+".$jumlah[$i],false)->set("barispesanbeli_subtotal","barispesanbeli_subtotal +".($jumlah[$i]*$dbarang->barang_hargajual),false)->update("eksperimen_barispesanbeli");
					continue;
				}

				$data=array(
						"pesanbeli_id"=>$id,
						"barang_id"=>$barang[$i],
						"barispesanbeli_jumlah"=>$jumlah[$i],
						"peserta_id"=>$peserta,
						"barispesanbeli_subtotal"=>$jumlah[$i]*$dbarang->barang_hargajual
					);

				$this->db->insert("eksperimen_barispesanbeli",$data);

				// katun batik dan 500 meter
				if($barang[$i] == 2) $n5 = 1;
				if($jumlah[$i] == 500) $n6 = 1;
			}

			$data = array(
				"case2_2" => $n2,
				"case2_3" => $n3,
				"case2_4" => $n4,
				"case2_5" => $n5,
				"case2_6" => $n6,
				"case2_a1" => 1,
			);

			$this->db->where("peserta_id",$peserta)->update("eksperimen_case2",$data);
			return array("berhasil","Pesanan berhasil diinput");
		}
	}
	
	public function delete_pesanan($kode){
		$peserta = $this->session->userdata("id");
		$id=$kode;
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("eksperimen_pesanbeli",["pesanbeli_id"=>$id,"peserta_id"=>$peserta])==TRUE){
			$this->db->where(["pesanbeli_id"=>$id,"peserta_id"=>$peserta])->delete("eksperimen_barispesanbeli");
			if($this->db->where("pesanbeli_id",$id)->where("peserta_id",$peserta)->delete("eksperimen_pesanbeli")){

				//poin 1
				if($id == "P005"){
					$this->db->where("peserta_id",$peserta)->set("case2_1",1)->update("eksperimen_case2");
				}
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