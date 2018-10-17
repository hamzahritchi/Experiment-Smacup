<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Pesanan extends CI_Model {
		public function get_detail($kode)
		{
			$peserta = $this->session->userdata("id");
			$this->load->database();
			$this->db->where("peserta_id",$peserta);
			$datauser=$this->db->where("pesanan_id",$kode)->get("eksperimen_pesanan");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$peserta = $this->session->userdata("id");
			$this->load->database();
			$this->db->where("peserta_id",$peserta);
			$datauser=$this->db->where("pesanan_id",$kode)->get("eksperimen_barispesanan");
			return $datauser->result_array();
		}

		public function get_harga($kode){
			$this->load->database();
			return $this->db->where('barang_id',$kode)->get("eksperimen_barang")->row();
		}

		public function get_pesanan(){
			$this->load->library("session");
			$peserta = $this->session->userdata("id");
			$this->db->where("peserta_id",$peserta);
			$pesanan=$this->db
					->from("eksperimen_pesanan p")
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
					->order_by("pesanan_id","desc")
					->limit(1)
					->get("eksperimen_pesanan");
			if($pesanan->num_rows() > 0) $kode = "1".substr($pesanan->row()->pesanan_id,-3);

			$kode++;
			$id = "S".substr($kode,-3);
			return $id;
		}

	public function tambah_pesanan()
    {
		//validasi
        $this->load->library('form_validation');
        $this->load->model("m_Serbaguna","ms");

        $this->form_validation->set_rules('id', 'id', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('pemesan', 'id', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('tanggal', 'id', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('term', 'id', 'trim|required|max_length[40]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			//gabung mang
			$id=$this->input->post("id");
			$pemesan=$this->input->post("pemesan");
			$tanggal=$this->input->post("tanggal");
			$term=$this->input->post("term");
			$dp=$this->input->post("dp");
			$peserta = $this->session->userdata("id");


			$case1_a1 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case1")->row()->case1_a1;
			if($case1_a1 == 1) return ["gagal","Anda sudah mengerjakan soal ini"];


			$barang=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");

			if($this->ms->cek_ada("eksperimen_pesanan",["pesanan_id"=>$id,"peserta_id"=>$peserta])==TRUE) return ["gagal","ID Pesanan telah dipakai"];

			$cek=0;
			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;
				$cek++;
			}

			if($cek==0) return ["gagal","Tidak ada isi"];

			//poin 2-6
			$n2 = 0;
			$n3 = 0;
			$n4 = 0;
			$n5 = 0;
			$n6 = 0;

			if($pemesan == "4") $n2 = 1; //PT Kain Katun
			if($tanggal == "2018-09-03") $n3 = 1; //tanggal
			if($term == "fob_shipping_point") $n4 = 1; //FOB Destination

			$data=array(
				"pesanan_id"=>$id,
				"pesanan_tanggal"=>$tanggal,
				"kontak_id"=>$pemesan,
				"pesanan_status"=>0,
				"pesanan_dp"=>$dp,
				"peserta_id"=>$peserta,
				"pesanan_term"=>$term
				);

			$this->db->insert("eksperimen_pesanan",$data);

			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;

				$dbarang=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row();

				if($this->ms->cek_ada("eksperimen_barispesanan",array("barang_id"=>$barang[$i],"pesanan_id"=>$id))){
					$this->db->where("barang_id",$barang[$i])->where(["pesanan_id"=>$id,"peserta_id"=>$peserta])->set("barispesanan_jumlah","barispesanan_jumlah+".$jumlah[$i],false)->set("barispesanan_subtotal","barispesanan_subtotal +".($jumlah[$i]*$dbarang->barang_hargajual),false)->update("eksperimen_barispesanan");
					continue;
				}
				if($barang[$i] == 6) $n5 = 1;
				if($jumlah[$i] == 50) $n6 = 1;
				$data=array(
						"pesanan_id"=>$id,
						"barang_id"=>$barang[$i],
						"barispesanan_jumlah"=>$jumlah[$i],
						"peserta_id"=>$peserta,
						"barispesanan_subtotal"=>$jumlah[$i]*$dbarang->barang_hargajual
					);

				$this->db->insert("eksperimen_barispesanan",$data);
			}


			$data = array(
				"case1_2" => $n2,
				"case1_3" => $n3,
				"case1_4" => $n4,
				"case1_5" => $n5,
				"case1_6" => $n6,
				"case1_a1" => 1,
			);

			$this->db->where("peserta_id",$peserta)->update("eksperimen_case1",$data);


			return array("berhasil","Pesanan berhasil diinput");
		}
	}
	
	public function delete_pesanan($kode){
		$id=$kode;
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		$peserta = $this->session->userdata("id");
		if($this->ms->cek_ada("eksperimen_pesanan",["pesanan_id"=>$id,"peserta_id"=>$peserta])==TRUE){
			$this->db->where(["pesanan_id"=>$id,"peserta_id"=>$peserta])->delete("eksperimen_barispesanan");
			if($this->db->where(["pesanan_id"=>$id,"peserta_id"=>$peserta])->delete("eksperimen_pesanan")){


				//poin 1
				if($id == "S003"){
					$this->db->where("peserta_id",$peserta)->set("case1_1",1)->update("eksperimen_case1");
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