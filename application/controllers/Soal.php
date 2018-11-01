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

	public function konfirmasiSelesai(){
		 $this->load->database();
		//load model
		$this->load->model('m_Navigasi');

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


		if($status == 3 && $urutan == 1) $hal = "konf1";
		if($status == 5 && $urutan == 1) $hal = "konf2";
		if($status == 3 && $urutan == 2) $hal = "konf2";
		if($status == 5 && $urutan == 2) $hal = "konf1";

		//mengatur urutan soal yang muncul, urutan 1 = soal 1 duluan dst
		if($status == 3 && $urutan == 1) $soal = "soal1";
		if($status == 5 && $urutan == 1) $soal = "soal2";
		if($status == 3 && $urutan == 2) $soal = "soal2";
		if($status == 5 && $urutan == 2) $soal = "soal1";

		//muatan data
		$data['hal']="hal/$hal";
		$data['nav']=$this->m_Navigasi->tarik($soal);
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

	}

	public function selesai($kode = ""){
		if($kode == "") redirect(base_url("soal"));
		if($kode != md5("case2") && $kode != md5("case1")) redirect(base_url("soal"));
		//load model
		$this->load->model('m_Navigasi');
		$this->load->database();
		
		//code
		$peserta = $this->db->where("peserta_id",$this->session->userdata("id"))->get("eksperimen_peserta");
		$peserta = $peserta->row();
		$urutan = $peserta->peserta_urutan;
		$status = $peserta->peserta_status;

		//mengatur soal berikutnya yang muncul sesuai urutan
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

			$this->db->where("peserta_id",$peserta->peserta_id)->set("case1_final","case1_1+case1_2+case1_3+case1_4+case1_5+case1_6+case1_7+case1_8+case1_9+case1_10+case1_11+case1_12+case1_13+case1_14+case1_15+case1_16+case1_17+case1_18+case1_19+case1_20",false)->update("eksperimen_case1");

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
			$this->db->where("peserta_id",$peserta->peserta_id)->set("peserta_status",6)->update("eksperimen_peserta");

	$this->db->where("peserta_id",$peserta->peserta_id)->set("case2_final","case2_1+case2_2+case2_3+case2_4+case2_5+case2_6+case2_7+case2_8+case2_9+case2_10+case2_11+case2_12+case2_13+case2_14+case2_15+case2_16+case2_17+case2_18+case2_19+case2_20",false)->update("eksperimen_case2");
			
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

				$this->db->where("peserta_id",$peserta->peserta_id)->set("case2_final","case2_1+case2_2+case2_3+case2_4+case2_5+case2_6+case2_7+case2_8+case2_9+case2_10+case2_11+case2_12+case2_13+case2_14+case2_15+case2_16+case2_17+case2_18+case2_19+case2_20",false)->update("eksperimen_case2");
			
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
			$this->db->where("peserta_id",$peserta->peserta_id)->set("peserta_status",6)->update("eksperimen_peserta");

			$this->db->where("peserta_id",$peserta->peserta_id)->set("case1_final","case1_1+case1_2+case1_3+case1_4+case1_5+case1_6+case1_7+case1_8+case1_9+case1_10+case1_11+case1_12+case1_13+case1_14+case1_15+case1_16+case1_17+case1_18+case1_19+case1_20",false)->update("eksperimen_case1");

			$this->db->where("peserta_id",$peserta->peserta_id)->set("case1_timefinish","now()",false)->update("eksperimen_case1");

			$this->session->set_userdata("status",6);
			redirect(base_url("kesulitan"));
		}
	}
}
?>
