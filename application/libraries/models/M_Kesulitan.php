<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Kesulitan extends CI_Model {	
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

        $n1 = 0;
        $n2 = 0;
        $n3 = 0;
        $n4 = 0;
        $n5 = 0;
        $id = $this->session->userdata("id");

        $this->form_validation->set_rules('k1', 'Kesulitan', 'trim|required|in_list[1,2,3,4,5,6,7]');
        $this->form_validation->set_rules('k2', 'Kesulitan', 'trim|required|in_list[1,2,3,4,5,6,7]');
        $this->form_validation->set_rules('k3', 'Kesulitan', 'trim|required|in_list[1,2,3,4,5,6,7]');
        $this->form_validation->set_rules('k4', 'Kesulitan', 'trim|required|in_list[1,2,3,4,5,6,7]');
        $this->form_validation->set_rules('k5', 'Kesulitan', 'trim|required|in_list[1,2,3,4,5,6,7]');

        if ($this->form_validation->run() == FALSE) return array("gagal","Mohon isi form dengan lengkap.");

        $n1 = $this->input->post("k1");
        $n2 = $this->input->post("k2");
        $n3 = $this->input->post("k3");
        $n4 = $this->input->post("k4");
        $n5 = $this->input->post("k5");
       
		$this->db->where("peserta_id",$id)->delete("eksperimen_kesulitan");

		$data = array(
			"kesulitan_1" => $n1,
			"kesulitan_2" => $n2,
			"kesulitan_3" => $n3,
			"kesulitan_4" => $n4,
			"kesulitan_5" => $n5,
			"peserta_id" => $id

		);

		$this->db->insert("eksperimen_kesulitan",$data);

		$this->db->where("peserta_id",$id)->set("peserta_status",7)->update("eksperimen_peserta");
		$this->session->set_userdata("status",7);
		return array("berhasil","Terima kasih, silahkan mengerjakan tahapan ini.");
		
	}
	
	
}
?>