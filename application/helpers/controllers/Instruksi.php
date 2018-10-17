<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instruksi extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
			if(!in_array($this->session->userdata("status"),[2,4])) redirect(base_url());
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->database();
		
		//code
		$peserta = $this->db->where("peserta_id",$this->session->userdata("id"))->get("eksperimen_peserta");
		$peserta = $peserta->row();
		$urutan = $peserta->peserta_urutan;
		$status = $peserta->peserta_status;

		if($status == 2 && $urutan == 1) $instruksi = "instruksi1";
		if($status == 4 && $urutan == 1) $instruksi = "instruksi2";
		if($status == 2 && $urutan == 2) $instruksi = "instruksi2";
		if($status == 4 && $urutan == 2) $instruksi = "instruksi1";
		

		//muatan data
		$data['hal']="hal/".$instruksi;
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}


	public function berikutnya(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->database();
		
		//code
		$peserta = $this->db->where("peserta_id",$this->session->userdata("id"))->get("eksperimen_peserta");
		$peserta = $peserta->row();
		$urutan = $peserta->peserta_urutan;
		$status = $peserta->peserta_status;

		if($status == 2 && $urutan == 1) $status = "3";
		if($status == 4 && $urutan == 1) $status = "5";
		if($status == 2 && $urutan == 2) $status = "3";
		if($status == 4 && $urutan == 2) $status = "5";

		if($status == 3 && $urutan ==1){
			$this->db->set("peserta_id",$peserta->peserta_id)->insert("eksperimen_case1");
		}
		
		if($status == 5 && $urutan ==1){
			$this->db->set("peserta_id",$peserta->peserta_id)->insert("eksperimen_case2");
		}

		if($status == 3 && $urutan ==2){
			$this->db->set("peserta_id",$peserta->peserta_id)->insert("eksperimen_case2");
		}
		
		if($status == 5 && $urutan ==2){
			$this->db->set("peserta_id",$peserta->peserta_id)->insert("eksperimen_case1");
		}

		$this->db->set("peserta_status",$status)->where("peserta_id",$this->session->userdata("id"))->update("eksperimen_peserta");
		$this->session->set_userdata("status",$status);

		redirect(base_url("soal"));
	}

	public function isi1(){
		$peserta = $this->session->userdata("peserta_id");

		$data = array(
			"pesanan_id"=>"S001",
			"pesanan_tanggal" =>"2018-09-01",
			"kontak_id"=>1,
			"pesanan_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanan",$data);
		$data = array(
			"pesanan_id"=>"S002",
			"pesanan_tanggal" =>"2018-09-01",
			"kontak_id"=>1,
			"pesanan_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanan",$data);
		$data = array(
			"pesanan_id"=>"S003",
			"pesanan_tanggal" =>"2018-09-01",
			"kontak_id"=>1,
			"pesanan_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanan",$data);
	}

	public function isi2(){
		$data = array(
			"pesanbeli_id"=>"P001",
			"pesanbeli_tanggal" =>"2018-09-01",
			"kontak_id"=>1,
			"pesanbeli_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanbeli",$data);
		$data = array(
			"pesanbeli_id"=>"P002",
			"pesanbeli_tanggal" =>"2018-09-01",
			"kontak_id"=>1,
			"pesanbeli_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanbeli",$data);
		$data = array(
			"pesanbeli_id"=>"P003",
			"pesanbeli_tanggal" =>"2018-09-01",
			"kontak_id"=>1,
			"pesanbeli_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanbeli",$data);
		$data = array(
			"pesanbeli_id"=>"P004",
			"pesanbeli_tanggal" =>"2018-09-01",
			"kontak_id"=>1,
			"pesanbeli_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanbeli",$data);
		$data = array(
			"pesanbeli_id"=>"P005",
			"pesanbeli_tanggal" =>"2018-09-01",
			"kontak_id"=>1,
			"pesanbeli_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanbeli",$data);
	}
}
?>
