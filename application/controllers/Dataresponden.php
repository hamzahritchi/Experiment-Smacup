<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataresponden extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
			if($this->session->userdata("status")) redirect(base_url());
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		if($this->input->post()){
			//Membuka model dataresponden
			$this->load->model('m_DataResponden');

			$hasil = $this->m_DataResponden->submit();
			$this->session->set_flashdata("hasil",$hasil);
			if($hasil[0] == "berhasil")
				redirect(base_url("karakteristik"));
			else
				redirect(base_url("dataresponden"));
		}
		
		//muatan data
		$data['hal']="hal/dataresponden";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
?>
