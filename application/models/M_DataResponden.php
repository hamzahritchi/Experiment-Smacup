<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_DataResponden extends CI_Model {	
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

        $this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin', 'trim|required|in_list[1,2]');
        $this->form_validation->set_rules('usia', 'Usia', 'trim|required|numeric|greater_than_equal_to[18]|less_than_equal_to[75]');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'trim|required|in_list[1,2,3,4,5,6]');
        $this->form_validation->set_rules('usaha', 'Usaha', 'trim|required|in_list[1,2,3,4,5,6]');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'trim|required|in_list[1,2,3,4]');
        $this->form_validation->set_rules('karyawan', 'Karyawan', 'trim|required|in_list[1,2,3]');

        if ($this->form_validation->run() == FALSE) return array("gagal","Mohon isi form dengan lengkap.");
		
		$jeniskelamin = $this->input->post("jeniskelamin");
		$usia = $this->input->post("usia");
		$pendidikan = $this->input->post("pendidikan");
		$usaha = $this->input->post("usaha");
		$penghasilan = $this->input->post("penghasilan");
		$karyawan = $this->input->post("karyawan");
		$lainnya =  $this->input->post("lainnya");

		if($usaha == 6 && empty($lainnya)) return array("gagal","Form tidak diisi dengan lengkap.");

		switch($jeniskelamin){
			case 1:
			$jeniskelamin = "pria";
			break;			
			case 2:
			$jeniskelamin = "wanita";
			break;
		}

		switch($pendidikan){
			case 1:
			$pendidikan = "SD";
			break;			
			case 2:
			$pendidikan = "SMP";
			break;	
			case 3:
			$pendidikan = "SMA";
			break;	
			case 4:
			$pendidikan = "Diploma";
			break;	
			case 5:
			$pendidikan = "Sarjana";
			break;	
			case 6:
			$pendidikan = "Pascasarjana";
			break;
		}

		switch($usaha){
			case 1:
			$usaha = "Makanan dan Minuman";
			break;			
			case 2:
			$usaha = "Konveksi";
			break;	
			case 3:
			$usaha = "Teknologi";
			break;	
			case 4:
			$usaha = "Fashion";
			break;	
			case 5:
			$usaha = "Alat Berat";
			break;	
			case 6:
			$usaha = $lainnya;
			break;
		}

		switch($penghasilan){
			case 1:
			$penghasilan = "< Rp 50.000.000";
			break;			
			case 2:
			$penghasilan = "Rp 50.000.000 – Rp 300.000.000";
			break;	
			case 3:
			$penghasilan = "Rp 300.000.000 – Rp 1.000.000.000";
			break;	
			case 4:
			$penghasilan = "> Rp 1.000.000.000";
			break;	
		}

		switch($karyawan){
			case 1:
			$karyawan = "< 10 Orang";
			break;			
			case 2:
			$karyawan = "10 – 30 Orang";
			break;	
			case 3:
			$karyawan = ">30 Orang";
		}

		$partisipasi = $this->M_Partisipan->partisipasi();
		if($partisipasi[0] == "gagal") return array("gagal",$partisipasi[1]);

		$uid = $this->session->userdata("id");
		$this->db->where("peserta_id",$uid)->delete("eksperimen_responden");

		$data = array(
			"responden_jk" => $jeniskelamin,
			"peserta_id" => $uid,
			"responden_usia" => $usia,
			"responden_pendidikan" => $pendidikan,
			"responden_bidangusaha" => $usaha,
			"responden_penghasilan" => $penghasilan,
			"responden_karyawan" => $karyawan

		);

		$this->db->insert("eksperimen_responden",$data);
		$this->db->where("peserta_id",$uid)->set("peserta_status",1)->update("eksperimen_peserta");
		$this->session->set_userdata("status",1);
		return array("berhasil","Terima kasih, silahkan mengerjakan tahapan ini.");
	}
	
	
}
?>