<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pembayaranb extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_pembayaran()
	{
		$peserta = $this->session->userdata("id");
		$this->load->database();
		$this->db->order_by("pembtagihan_id","ASC");
		$this->db->where("peserta_id",$peserta);
		$datauser=$this->db->get("eksperimen_pembtagihan")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$peserta = $this->session->userdata("id");
		$this->db->where("peserta_id",$peserta);
		$datauser=$this->db
			->where("pembtagihan_id",$kode)
			->get("eksperimen_pembtagihan")
			;
		return $datauser->row_array();
	}
	
	public function get_id(){
			$this->load->database();
			$this->load->library("session");
			$kode = 1000;

			$peserta = $this->session->userdata("id");

			$pesanan=$this->db
					->where("peserta_id",$peserta)
					->order_by("pembtagihan_id","desc")
					->limit(1)
					->get("eksperimen_pembtagihan");
			if($pesanan->num_rows() > 0) $kode = "1".substr($pesanan->row()->tagihan_id,-3);

			$kode++;
			$id = "CD".substr($kode,-3);
			return $id;
		}
			
	public function tambah_pembayaran()
    {
		//validasi
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{
			$peserta = $this->session->userdata("id");
			

			$case2_a4 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case2")->row()->case2_a4;
			if($case2_a4 == 1) return ["gagal","Anda sudah mengerjakan soal ini"];

			//Nomor 15-18
			$n15 = 0;
			$n16 = 0;
			$n17 = 0;
			$n18 = 0;


			if($this->input->post("tanggal") == "2018-10-22") $n15 = 1;
			if($this->input->post("tagihan") == "PI004") $n16 = 1;
			if($this->input->post("bayar") == "37500000") $n17 = 1;
			if($this->input->post("via") == "tunai") $n18 = 1;

			$data=array(
			"pembtagihan_id"=>$this->input->post("id",true),
			"pembtagihan_tanggal"=>$this->input->post("tanggal",true),
			"pembtagihan_jumlah"=>$this->input->post("bayar",true),
			"pembtagihan_via"=>$this->input->post("via",true),
			"pembtagihan_ket"=>$this->input->post("ket",true),
			"peserta_id"=>$peserta,
			"tagihan_id"=>$this->input->post("tagihan",true)
			);
		
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ganda("eksperimen_pembtagihan",["pembtagihan_id"=>$data["pembtagihan_id"],"peserta_id"=>$peserta])==TRUE){
				if($this->db->insert("eksperimen_pembtagihan",$data)){

					$this->db->where("peserta_id",$peserta)->where("tagihan_id",$this->input->post("tagihan",true))->set("tagihan_status",1)->update("eksperimen_tagihan");
					$data = array(
						"case2_15" => $n15,
						"case2_16" => $n16,
						"case2_17" => $n17,
						"case2_18" => $n18,
						"case2_a4" => 1
					);


					$this->db->where("peserta_id",$peserta)->update("eksperimen_case2",$data);
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

	public function delete_pembayaran($kode)
    {
		//load data
		$id=$kode;
		$peserta = $this->session->userdata("id");

		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
		if($this->ms->cek_ada("eksperimen_pembtagihan",["pembtagihan_id"=>$id,"peserta_id"=>$peserta])==TRUE){
			if($this->db->where("peserta_id",$peserta)->where("pembtagihan_id",$id)->delete("eksperimen_pembtagihan")){
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