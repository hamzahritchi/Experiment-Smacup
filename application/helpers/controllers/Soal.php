<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
			if(!in_array($this->session->userdata("status"),[3,5])) redirect(base_url());
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->database();
		
		//code
		//code
		$peserta = $this->db->where("peserta_id",$this->session->userdata("id"))->get("eksperimen_peserta");
		if($peserta->num_rows() < 1) redirect(base_url());
		$peserta = $peserta->row();
		$urutan = $peserta->peserta_urutan;
		$status = $peserta->peserta_status;
		$navigasi = $peserta->peserta_navigasi;
		$panduan = $peserta->peserta_panduan;
		$this->session->set_userdata("navigasi",$navigasi);
		$this->session->set_userdata("panduan",$panduan);

		if($status == 3 && $urutan == 1) $soal = "soal1";
		if($status == 5 && $urutan == 1) $soal = "soal2";
		if($status == 3 && $urutan == 2) $soal = "soal2";
		if($status == 5 && $urutan == 2) $soal = "soal1";

		$this->session->set_userdata("soal",$soal);

		//muatan data
		$data['hal']="hal/$soal";
		$data['nav']=$this->m_Navigasi->tarik($soal);
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function selesai(){
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
			//cek sudah selesai/belum
			/*
				$cek = $this->db->where("peserta_id")->get("eksperimen_pembayaran");
				if($cek->num_rows < 2){
					//gagal
				}

			*/
			$this->db->where("peserta_id",$peserta->peserta_id)->set("peserta_status",4)->update("eksperimen_peserta");

			$this->db->where("peserta_id",$peserta->peserta_id)->set("case1_timefinish","now()",false)->update("eksperimen_case1");

			$this->session->set_userdata("status",4);
			redirect(base_url("instruksi"));
		}
		
		if($status == 5 && $urutan ==1){
			//cek sudah selesai/belum
			/*
				$cek = $this->db->where("peserta_id")->get("eksperimen_pembtagihan);
				if($cek->num_rows < 3){
					//gagal
				}

			*/
			$this->db->where("peserta_id",$peserta->peserta_id)->set("peserta_status",7)->update("eksperimen_peserta");


			$this->db->where("peserta_id",$peserta->peserta_id)->set("case2_timefinish","now()",false)->update("eksperimen_case2");
			
			$this->session->set_userdata("status",6);
			redirect(base_url("kesulitan"));
		}

		if($status == 3 && $urutan ==2){
			//cek sudah selesai/belum
			/*
				$cek = $this->db->where("peserta_id")->get("eksperimen_pembayaran);
				if($cek->num_rows < 2){
					//gagal
				}

			*/
			$this->db->where("peserta_id",$peserta->peserta_id)->set("peserta_status",4)->update("eksperimen_peserta");

			$this->db->where("peserta_id",$peserta->peserta_id)->set("case2_timefinish","now()",false)->update("eksperimen_case2");

			$this->session->set_userdata("status",4);
			redirect(base_url("instruksi"));
		}
		
		if($status == 5 && $urutan ==2){
			//cek sudah selesai/belum
			/*
				$cek = $this->db->where("peserta_id")->get("eksperimen_pembtagihan);
				if($cek->num_rows < 3){
					//gagal
				}

			*/
			$this->db->where("peserta_id",$peserta->peserta_id)->set("peserta_status",7)->update("eksperimen_peserta");


			$this->db->where("peserta_id",$peserta->peserta_id)->set("case1_timefinish","now()",false)->update("eksperimen_case1");

			$this->session->set_userdata("status",6);
			redirect(base_url("kesulitan"));
		}
	}
}
?>
