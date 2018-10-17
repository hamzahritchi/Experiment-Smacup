<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Terimakasih extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function submit()
	{
		$this->load->database();
		$this->load->model("M_Partisipan");
		$this->load->model('m_Serbaguna','ms');
        $this->load->library('form_validation');

        $email = $this->input->post("email");
        $id = $this->session->userdata("id");

       if($email != ""){

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) return array("gagal","Format email salah.");
       }

		$this->db->where("peserta_id",$id)->set("peserta_status",8)->set("peserta_email",$email)->update("eksperimen_peserta");
		$this->session->set_userdata("status",8);
		return array("berhasil","Anda telah mengerjakan semua tahapan, silahkan meninggalkan website ini.");
		
	}
	
	
}
?>