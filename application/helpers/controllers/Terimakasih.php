<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terimakasih extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
			if($this->session->userdata("status") != 7) redirect(base_url());
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		if($this->input->post()){
			$this->load->model('m_Terimakasih');

			$hasil = $this->m_Terimakasih->submit();
			$this->session->set_flashdata("hasil",$hasil);
			if($hasil[0] == "berhasil")
				redirect(base_url("selesai"));
			else
				redirect(base_url("terimakasih"));
		}

		//muatan data
		$data['hal']="hal/terimakasih";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
?>
