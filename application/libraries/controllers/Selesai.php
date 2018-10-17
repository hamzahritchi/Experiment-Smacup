<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selesai extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
			$this->load->helper('cookie');
			$this->load->database();

			if($this->session->userdata("status")){
				if($this->session->userdata("status") != 8){
					redirect(base_url());
				}
			}elseif($this->input->cookie("token_eksperimen")){
				$token = $this->input->cookie("token_eksperimen");
				$peserta = $this->db->where("peserta_token",$token)->get("eksperimen_peserta");
				if($peserta->num_rows()<1) {
						delete_cookie("token_eksperimen");
						redirect(base_url());
					}else{
						$peserta = $peserta->row();
						if($peserta->peserta_status != 8){
							delete_cookie("token_eksperimen");
							redirect(base_url());
						}
					}
				}else{
				redirect(base_url());
			}
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="hal/selesai";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
?>
