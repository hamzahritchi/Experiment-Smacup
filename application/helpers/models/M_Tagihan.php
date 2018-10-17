<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_tagihan extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("tagihan_id",$kode)->get("eksperimen_tagihan");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$datauser=$this->db->where("tagihan_id",$kode)->get("eksperimen_baristagihan");
			return $datauser->result_array();
		}

		public function get_harga($kode){
			$this->load->database();
			return $this->db->where('barang_id',$kode)->get("eksperimen_barang")->row();
		}

		public function get_tagihan(){
			$this->load->library("session");

			$tagihan=$this->db
					->from("eksperimen_tagihan p")
					->join("eksperimen_terimabarang k","k.terimabarang_id=p.terimabarang_id")
					->get()
					->result();

			return $tagihan;
		}

		public function get_id(){
			$this->load->database();
			$this->load->library("session");
			$kode = 1000;

			$peserta = $this->session->userdata("id");

			$pesanan=$this->db
					->where("peserta_id",$peserta)
					->order_by("tagihan_id","desc")
					->limit(1)
					->get("eksperimen_tagihan");
			if($pesanan->num_rows() > 0) $kode = "1".substr($pesanan->row()->tagihan_id,-3);

			$kode++;
			$id = "PI".substr($kode,-3);
			return $id;
		}
			
	public function tambah_tagihan()
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
			$terima=$this->input->post("terima");
			$tanggal=$this->input->post("tanggal");
			$beban=$this->input->post("beban");
			$term=$this->input->post("term");
			$peserta = $this->session->userdata("id");

			$barang=$this->input->post("namabarang");
			$jumlah=$this->input->post("jumlah");


			$case2_a3 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case2")->row()->case2_a1;
			if($case2_a3 == 1) return ["gagal","Anda sudah mengerjakan soal ini"];

			if($this->ms->cek_ada("eksperimen_tagihan",["tagihan_id"=>$id,"peserta_id"=>$peserta])==TRUE) return ["gagal","No Tagihan telah dipakai"];

			//poin 12-14
			$n12 = 0;
			$n13 = 0;
			$n14 = 0;

			if($terima == "JKT001") $n12 =1;
			if($tanggal == "2018-10-15") $n14 = 1;


			$data=array(
				"tagihan_id"=>$id,
				"tagihan_tanggal"=>$tanggal,
				"terimabarang_id"=>$terima,
				"tagihan_beban"=>$beban,
				"tagihan_term"=>$term,
				"peserta_id"=>$peserta,
				);

			$this->db->insert("eksperimen_tagihan",$data);

			for($i=0;$i<count($barang);$i++){
				if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;

				$dbarang=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row();

				if($this->ms->cek_ada("eksperimen_baristagihan",array("barang_id"=>$barang[$i],"tagihan_id"=>$id))){
					$this->db->where("barang_id",$barang[$i])->where("tagihan_id",$id)->where("peserta_id",$peserta)->set("baristagihan_jumlah","baristagihan_jumlah+".$jumlah[$i],false)->set("baristagihan_subtotal","baristagihan_subtotal +".($jumlah[$i]*$dbarang->hjualbarang),false)->update("eksperimen_baristagihan");
					continue;

					$n13 = 1;
				}

				$data=array(
						"tagihan_id"=>$id,
						"barang_id"=>$barang[$i],
						"peserta_id"=>$peserta,
						"baristagihan_jumlah"=>$jumlah[$i],
						"baristagihan_subtotal"=>$jumlah[$i]*$dbarang->barang_hargajual
					);

				$this->db->insert("eksperimen_baristagihan",$data);
				
			}

			$data = array(
				"case2_12" => $n12,
				"case2_13" => $n13,
				"case2_14" => $n14,
				"case2_a3" => 1,
			);

			$this->db->where("peserta_id",$peserta)->update("eksperimen_case2",$data);
			return "berhasil";
		}
	}

	public function delete_tagihan($kode){
		$peserta = $this->session->userdata("id");
		$id=$kode;
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("eksperimen_tagihan",["tagihan_id"=>$id,"peserta_id"=>$peserta])==TRUE){
			if($this->db->where("tagihan_id",$id)->where("peserta_id",$peserta)->delete("eksperimen_tagihan")){
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