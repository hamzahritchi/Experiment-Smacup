<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_OutputPenjualan extends CI_Model {
	public function jumlah(){
		$this->load->database();

		$dari=$this->input->post("dari")." 00:00:00";
		$sampai=$this->input->post("sampai")." 23:59:59";
		$order=$this->input->post("sampai");
		$group=$this->input->post("group");
		$filter=$this->input->post("filter");
		$isifilter=$this->input->post("isifilter");
		$peserta = $this->session->userdata("id");

		if(!$dari || !$sampai || !$order) redirect(base_url("penjualan/laporan"));


		$n19 = 0;
		$n20 = 0;

		if($dari == "2018-09-01 00:00:00" && $sampai == "2018-09-30 23:59:59") $n19 =1;
		if($group == "produk") $n20 =1;

		$data = array(
			"case1_19" => $n19,
			"case1_20" => $n20,
			"case1_a5" => 1
		);

		$this->db->where("peserta_id",$peserta)->update("eksperimen_case1",$data);


		switch($filter){
			case 2:
				$this->db->where("segment1",$isifilter);
			break;
			case 3:
				$this->db->where("segment2",$isifilter);
			break;
			case 4:
				$this->db->where("segment3",$isifilter);
			break;
		}

		$this->db->where("k.peserta_id",$peserta);
		$this->db->where("kwitansi_tanggal <=",$sampai);
		$this->db->where("kwitansi_tanggal >=",$dari);

		$this->db->order_by($order=="produk" ? "barang_nama" : "tsubtotal","ASC");
		$this->db->group_by($group=="produk" ? "b.barang_id" : "t.kontak_id");
		$this->db->select($group=="produk" ? "barang_nama as uraian" : "kontak_nama as uraian");

		$this->db
				->select_sum("k.bariskwitansi_jumlah","tjumlah")
				->select_sum("bariskwitansi_subtotal","tsubtotal");
		$data=$this->db->from("eksperimen_kwitansi t")
				->join("eksperimen_bariskwitansi k","t.kwitansi_id=k.kwitansi_id")
				->join("eksperimen_barang b","b.barang_id=k.barang_id")
				->join("eksperimen_kontak o","o.kontak_id=t.kontak_id")
				->get()->result();

		return($data);
	}
}
?>