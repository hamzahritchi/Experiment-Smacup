<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prosedur extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		$this->load->model("M_Partisipan");
		//$partisipasi = $this->M_Partisipan->partisipasi();
		//$uid = $this->session->userdata("id");
		//$this->db->where("peserta_id",$uid)->set("peserta_status",2)->update("eksperimen_peserta");
		//$this->session->set_userdata("status",2);
		//redirect(base_url('instruksi'));
		
		//muatan data
		$data['hal']="hal/prosedur";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
?>
