<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pembayaran extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_pembayaran()
	{
		$this->load->database();
			$peserta = $this->session->userdata("id");
			$this->db->where("peserta_id",$peserta);
		$this->db->order_by("pembayaran_id","ASC");
		$datauser=$this->db->get("eksperimen_pembayaran")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
			$peserta = $this->session->userdata("id");
			$this->db->where("peserta_id",$peserta);
		$datauser=$this->db
			->where("pembayaran_id",$kode)
			->get("eksperimen_pembayaran")
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
					->order_by("pembayaran_id","desc")
					->limit(1)
					->get("eksperimen_pembayaran");
			if($pesanan->num_rows() > 0) $kode = "1".substr($pesanan->row()->pembayaran_id,-3);

			$kode++;
			$id = "CR".substr($kode,-3);
			return $id;
		}

	public function tambah_pembayaran()
    {
		$this->load->database();
		$this->load->model('m_Serbaguna','ms');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[20]');
		
		 if($this->form_validation->run() == FALSE){
			return "gagal";
		}
		else{

			$kwitansi=$this->input->post("kwitansi",true);
			$peserta = $this->session->userdata("id");

			if(empty($kwitansi)){
				$kwitansi=null;
			} else {
				if($this->ms->cek_ada("eksperimen_kwitansi",["kwitansi_id"=>$kwitansi,"peserta_id"=>$peserta])==FALSE) return ["gagal","Kwitansi tidak ada"];
			}
			


			$case1_a4 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case1")->row()->case1_a4;
			if($case1_a4 == 1) return ["gagal","Anda sudah mengerjakan soal ini"];

			//Nomor 15-18
			$n15 = 0;
			$n16 = 0;
			$n17 = 0;
			$n18 = 0;


			if($this->input->post("tanggal") == "2018-09-15") $n15 = 1;
			if($this->input->post("kwitansi") == "SI003") $n16 = 1;
			if($this->input->post("bayar") == "25250000") $n17 = 1;
			if($this->input->post("via") == "bank") $n18 = 1;

			$data=array(
			"pembayaran_id"=>$this->input->post("id",true),
			"pembayaran_tanggal"=>$this->input->post("tanggal",true),
			"pembayaran_jumlah"=>$this->input->post("bayar",true),
			"pembayaran_via"=>$this->input->post("via",true),
			"pembayaran_ket"=>$this->input->post("ket",true),
			"kwitansi_id"=>$kwitansi,
			"peserta_id"=>$peserta
			);


			if($this->ms->cek_ganda("eksperimen_pembayaran",["pembayaran_id"=>$data["pembayaran_id"],"peserta_id"=>$peserta])==TRUE){
				if($this->db->insert("eksperimen_pembayaran",$data)){
					$this->db->where(["kwitansi_id"=>$kwitansi,"peserta_id"=>$peserta])->set("kwitansi_status",1)->update("eksperimen_kwitansi");
					$data = array(
						"case1_15" => $n15,
						"case1_16" => $n16,
						"case1_17" => $n17,
						"case1_18" => $n18,
						"case1_a4" => 1
					);

					$this->db->where("peserta_id",$peserta)->update("eksperimen_case1",$data);

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
		if($this->ms->cek_ada("eksperimen_pembayaran",["pembayaran_id"=>$id,"peserta_id"=>$peserta])==TRUE){
			if($this->db->where(["pembayaran_id"=>$id,"peserta_id"=>$peserta])->delete("eksperimen_pembayaran")){
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