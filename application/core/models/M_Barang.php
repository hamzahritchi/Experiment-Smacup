<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Barang extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function get_barang()
	{
		$this->load->database();
		$this->db->order_by("barang_id","ASC");
		$datauser=$this->db->get("eksperimen_barang")->result();
		return $datauser;
	}
	
	public function get_detail($kode=1)
	{
		$this->load->database();
		$datauser=$this->db
			->where("barang_id",$kode)
			->get("eksperimen_barang")
			;
		return $datauser->row_array();
	}
}
?>