<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_kontak extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_kontak()
	{
		$this->load->database();
		$this->db->order_by("kontak_id","ASC");
		$datauser=$this->db->get("eksperimen_kontak")->result();
		return $datauser;
	}

	public function get_kontak_tipe($tipe)
	{
		$this->load->database();

		$this->db->where("kontak_jenis",$tipe);
		$this->db->order_by("kontak_id","ASC");
		$datauser=$this->db->get("eksperimen_kontak")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db->where("kontak_id",$kode)->get("eksperimen_kontak");
		return $datauser->row_array();
	}
}
?>