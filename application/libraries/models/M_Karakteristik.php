<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Karakteristik extends CI_Model {	
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

        $n1 = 1;
        $n2 = 0;
        $n3 = 0;
        $n4 = 0;
        $text = "";
        $laman = 0;
        $id = $this->session->userdata("id");

        $this->form_validation->set_rules('pengalaman', 'Pengalaman', 'trim|required|in_list[1,2]');

        if ($this->form_validation->run() == FALSE) return array("gagal","Mohon isi form dengan lengkap.");

        $pengalaman = $this->input->post("pengalaman");


        if($pengalaman == 1){
        	$this->form_validation->set_rules('software[]', 'Software', 'trim|required|in_list[1,2,3,4,5]');
        	$this->form_validation->set_rules('lama', 'Lama', 'trim|required|in_list[1,2]');
        	if ($this->form_validation->run() == FALSE) return array("gagal","Mohon isi form dengan lengkap.");

        	$software = $this->input->post("software");
        	$lama = $this->input->post("lama");

        	$software = array_unique($software);
        	$softTex = array();

        	foreach($software as $s){
        		switch($s){
        			case 1:
        			$softTex[] = "Accurate";
        			break;
        			case 2:
        			$softTex[] = "Zahir";
        			break;
        			case 3:
        			$softTex[] = "MYOB";
        			break;
        			case 4:
        			$softTex[] = "SAP";
        			break;
        			case 5:
        			$softTex[] = "Lainnya";
        			break;
        		}
        	}


        	$text = implode(",",$softTex);
        	$n2 = count($software);
        	$n3 = $lama;
        	if($lama == 2){
        		$this->form_validation->set_rules('soal[]', 'Soal', 'trim|required|in_list[1,2,3,4]');
        		if ($this->form_validation->run() == FALSE) return array("gagal","Mohon isi form dengan lengkap.");

        		    $soal = $this->input->post("soal[]");

		        	$soal = array_unique($soal);

		        	foreach($soal as $s){
		        		switch($s){
		        			case 1:
		        			$n4 -= 1;
		        			break;
		        			case 2:
		        			$n4 += 1;
		        			break;
		        			case 3:
		        			$n4 -= 1;
		        			break;
		        			case 4:
		        			$n4 += 1;
		        			break;
		        		}
		        	}
        	}

        }


		$this->db->where("peserta_id",$id)->delete("eksperimen_karakteristik");

		$data = array(
			"karakteristik_1" => $n1,
			"karakteristik_2" => $n2,
			"karakteristik_3" => $n3,
			"karakteristik_4" => $n4,
			"karakteristik_text2" => $text,
			"peserta_id" => $id

		);

		$this->db->insert("eksperimen_karakteristik",$data);


		if(($n1+$n2+$n3+$n4) > 5) $laman = 1;
		$this->db->where("peserta_id",$id)->set("peserta_status",2)->set("peserta_pengalaman",$laman)->update("eksperimen_peserta");
		$this->session->set_userdata("status",2);
		return array("berhasil","Terima kasih, silahkan mengerjakan tahapan ini.");
		
	}
	
	
}
?>