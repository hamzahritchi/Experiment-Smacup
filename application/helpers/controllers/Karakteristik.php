<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karakteristik extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');			
			$this->load->database();

			if($this->session->userdata("status") != 1) redirect(base_url());
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		if($this->input->post()){
			$this->load->model('m_Karakteristik');

			$hasil = $this->m_Karakteristik->submit();
			$this->session->set_flashdata("hasil",$hasil);
			if($hasil[0] == "berhasil")
				redirect(base_url("instruksi"));
			else
				redirect(base_url("karakteristik"));
		}
		
		
		//muatan data
		$data['hal']="hal/karakteristik";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
?>
