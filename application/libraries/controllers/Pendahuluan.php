<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendahuluan extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
			$this->load->helper('cookie');
			$this->load->database();

			if($this->session->userdata("id")){
				$data = $this->db->where("peserta_id",$this->session->userdata("id"))->get("eksperimen_peserta");
				if($data->num_rows() < 1){
					$this->session->sess_destroy();
					redirect(base_url());
				}
				$user = $data->row();
				$status = $user->peserta_status;
				switch($status){
					case 1:
						redirect(base_url("karakteristik"));
					break;
					case 2:
					case 4:
						redirect(base_url("instruksi"));
					break;
					case 3:
					case 5:
						redirect(base_url("soal"));
					break;
					case 6:
						redirect(base_url("kesulitan"));
					break;
					case 7:
						redirect(base_url("terimakasih"));
					break;
					case 8:
						redirect(base_url("selesai"));
					break;
				}
			}elseif($this->input->cookie("token_eksperimen")){
				$token = $this->input->cookie("token_eksperimen");
				$peserta = $this->db->where("peserta_token",$token)->get("eksperimen_peserta");
				if($peserta->num_rows()<1){
					delete_cookie("token_eksperimen");
				}else{
					$peserta = $peserta->row();
					if($peserta->peserta_status == 7) redirect(base_url("kesulitan"));
					if($peserta->peserta_status == 8) redirect(base_url("selesai"));
				}
			}else{
				delete_cookie("token_eksperimen");
			}
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="hal/pendahuluan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
?>
