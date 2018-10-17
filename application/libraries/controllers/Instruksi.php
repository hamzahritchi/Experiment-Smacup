<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instruksi extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
			if(!in_array($this->session->userdata("status"),[2,4])) redirect(base_url());
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->database();
		
		//code
		$peserta = $this->db->where("peserta_id",$this->session->userdata("id"))->get("eksperimen_peserta");
		$peserta = $peserta->row();
		$urutan = $peserta->peserta_urutan;
		$status = $peserta->peserta_status;

		if($status == 2 && $urutan == 1) $instruksi = "instruksi1";
		if($status == 4 && $urutan == 1) $instruksi = "instruksi2";
		if($status == 2 && $urutan == 2) $instruksi = "instruksi2";
		if($status == 4 && $urutan == 2) $instruksi = "instruksi1";
		

		//muatan data
		$data['hal']="hal/".$instruksi;
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}


	public function berikutnya(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->database();
		
		//code
		$peserta = $this->db->where("peserta_id",$this->session->userdata("id"))->get("eksperimen_peserta");
		$peserta = $peserta->row();
		$urutan = $peserta->peserta_urutan;
		$status = $peserta->peserta_status;

		if($status == 2 && $urutan == 1) $status = "3";
		if($status == 4 && $urutan == 1) $status = "5";
		if($status == 2 && $urutan == 2) $status = "3";
		if($status == 4 && $urutan == 2) $status = "5";

		if($status == 3 && $urutan ==1){
			$this->isi1();
			$this->db->set("peserta_id",$peserta->peserta_id)->insert("eksperimen_case1");
		}
		
		if($status == 5 && $urutan ==1){
			$this->isi2();
			$this->db->set("peserta_id",$peserta->peserta_id)->insert("eksperimen_case2");
		}

		if($status == 3 && $urutan ==2){
			$this->isi2();
			$this->db->set("peserta_id",$peserta->peserta_id)->insert("eksperimen_case2");
		}
		
		if($status == 5 && $urutan ==2){
			$this->isi1();
			$this->db->set("peserta_id",$peserta->peserta_id)->insert("eksperimen_case1");
		}

		$this->db->set("peserta_status",$status)->where("peserta_id",$this->session->userdata("id"))->update("eksperimen_peserta");
		$this->session->set_userdata("status",$status);

		redirect(base_url("soal"));
	}

	private function isi1(){
		$peserta = $this->session->userdata("id");
		$this->load->database();

		//isi pesanan
		$data = array(
			"pesanan_id"=>"S001",
			"pesanan_tanggal" =>"2018-09-01",
			"kontak_id"=>1,
			"pesanan_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta,
			"pesanan_status"=>1
		);
		$this->db->insert("eksperimen_pesanan",$data);

		$data = array(
		"pesanan_id"=>"S001",
		"peserta_id"=>$peserta,
		"barang_id"=>7,
		"barispesanan_jumlah"=>50,
		"barispesanan_subtotal"=>22500000
		);

		$this->db->insert("eksperimen_barispesanan",$data);

		$data = array(
			"pesanan_id"=>"S002",
			"pesanan_tanggal" =>"2018-09-01",
			"kontak_id"=>2,
			"pesanan_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta,
			"pesanan_status"=>1,
		);
		$this->db->insert("eksperimen_pesanan",$data);


		$data = array(
		"pesanan_id"=>"S002",
		"peserta_id"=>$peserta,
		"barang_id"=>7,
		"barispesanan_jumlah"=>50,
		"barispesanan_subtotal"=>22500000
		);

		$this->db->insert("eksperimen_barispesanan",$data);


		$data = array(
			"pesanan_id"=>"S003",
			"pesanan_tanggal" =>"2018-09-01",
			"kontak_id"=>3,
			"pesanan_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta,
			"pesanan_status"=>1,
		);
		$this->db->insert("eksperimen_pesanan",$data);

		$data = array(
		"pesanan_id"=>"S003",
		"peserta_id"=>$peserta,
		"barang_id"=>7,
		"barispesanan_jumlah"=>50,
		"barispesanan_subtotal"=>22500000
		);

		$this->db->insert("eksperimen_barispesanan",$data);

		//isi Pengiriman
		$data = array(
			"pengiriman_id"=>"SBY001",
			"pengiriman_tanggal" =>"2018-09-02",
			"pesanan_id"=>"S001",
			"kontak_id"=>1,
			"pengiriman_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta,
			"pengiriman_status"=>1
		);
		$this->db->insert("eksperimen_pengiriman",$data);

		$data = array(
		"pengiriman_id"=>"SBY001",
		"peserta_id"=>$peserta,
		"barang_id"=>7,
		"barispengiriman_jumlah"=>50
		);

		$this->db->insert("eksperimen_barispengiriman",$data);

		$data = array(
			"pengiriman_id"=>"SBY002",
			"pengiriman_tanggal" =>"2018-09-02",
			"pesanan_id"=>"S002",
			"kontak_id"=>2,
			"pengiriman_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta,
			"pengiriman_status"=>1,
			"pengiriman_beban"=>100000
		);
		$this->db->insert("eksperimen_pengiriman",$data);

		$data = array(
		"pengiriman_id"=>"SBY002",
		"peserta_id"=>$peserta,
		"barang_id"=>7,
		"barispengiriman_jumlah"=>50
		);

		$this->db->insert("eksperimen_barispengiriman",$data);

		//penagihan
		$data = array(
			"kwitansi_id"=>"SI001",
			"kwitansi_tanggal" =>"2018-09-03",
			"pengiriman_id"=>"SBY001",
			"kontak_id"=>1,
			"kwitansi_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta,
			"kwitansi_status"=>1
		);
		$this->db->insert("eksperimen_kwitansi",$data);

		$data = array(
		"kwitansi_id"=>"SI001",
		"peserta_id"=>$peserta,
		"barang_id"=>7,
		"bariskwitansi_jumlah"=>50,
		"bariskwitansi_subtotal"=>22500000
		);

		$this->db->insert("eksperimen_bariskwitansi",$data);


		$data = array(
			"kwitansi_id"=>"SI002",
			"kwitansi_tanggal" =>"2018-09-03",
			"pengiriman_id"=>"SBY002",
			"kontak_id"=>2,
			"kwitansi_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta,
			"kwitansi_status"=>0
		);
		$this->db->insert("eksperimen_kwitansi",$data);

		$data = array(
		"kwitansi_id"=>"SI002",
		"peserta_id"=>$peserta,
		"barang_id"=>7,
		"bariskwitansi_jumlah"=>50,
		"bariskwitansi_subtotal"=>22500000
		);

		$this->db->insert("eksperimen_bariskwitansi",$data);

		//Add Pembayaran
			$data=array(
			"pembayaran_id"=>"CR001",
			"pembayaran_tanggal"=>"2018-09-04",
			"pembayaran_jumlah"=>22500000,
			"pembayaran_via"=>"kas",
			"pembayaran_ket"=>"",
			"kwitansi_id"=>"SI001",
			"peserta_id"=>$peserta
			);
		$this->db->insert("eksperimen_pembayaran",$data);
	}

	private function isi2(){
		$peserta = $this->session->userdata("id");
		$this->load->database();

		$data = array(
			"pesanbeli_id"=>"P001",
			"pesanbeli_tanggal" =>"2018-10-01",
			"kontak_id"=>8,
			"pesanbeli_term"=>"fob_destination_point",
			"peserta_id"=>$peserta,
			"pesanbeli_status"=>1
		);
		$this->db->insert("eksperimen_pesanbeli",$data);

		$data = array(
		"pesanbeli_id"=>"P001",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"barispesanbeli_jumlah"=>400,
		"barispesanbeli_subtotal"=>40000000
		);

		$this->db->insert("eksperimen_barispesanbeli",$data);

		$data = array(
			"pesanbeli_id"=>"P002",
			"pesanbeli_tanggal" =>"2018-10-01",
			"kontak_id"=>9,
			"pesanbeli_term"=>"fob_destination_point",
			"peserta_id"=>$peserta,
			"pesanbeli_status"=>1
		);
		$this->db->insert("eksperimen_pesanbeli",$data);


		$data = array(
		"pesanbeli_id"=>"P002",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"barispesanbeli_jumlah"=>400,
		"barispesanbeli_subtotal"=>40000000
		);

		$this->db->insert("eksperimen_barispesanbeli",$data);

		$data = array(
			"pesanbeli_id"=>"P003",
			"pesanbeli_tanggal" =>"2018-10-01",
			"kontak_id"=>10,
			"pesanbeli_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta,
			"pesanbeli_status"=>1
		);
		$this->db->insert("eksperimen_pesanbeli",$data);


		$data = array(
		"pesanbeli_id"=>"P003",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"barispesanbeli_jumlah"=>400,
		"barispesanbeli_subtotal"=>40000000
		);

		$this->db->insert("eksperimen_barispesanbeli",$data);


		$data = array(
			"pesanbeli_id"=>"P004",
			"pesanbeli_tanggal" =>"2018-10-01",
			"kontak_id"=>16,
			"pesanbeli_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanbeli",$data);


		$data = array(
		"pesanbeli_id"=>"P004",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"barispesanbeli_jumlah"=>400,
		"barispesanbeli_subtotal"=>40000000
		);

		$this->db->insert("eksperimen_barispesanbeli",$data);

		$data = array(
			"pesanbeli_id"=>"P005",
			"pesanbeli_tanggal" =>"2018-10-01",
			"kontak_id"=>17,
			"pesanbeli_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_pesanbeli",$data);


		$data = array(
		"pesanbeli_id"=>"P005",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"barispesanbeli_jumlah"=>500,
		"barispesanbeli_subtotal"=>50000000
		);

		$this->db->insert("eksperimen_barispesanbeli",$data);

		//Isi Terima Barang
		$data=array(
			"terimabarang_id"=>"SMR001",
			"pesanbeli_id"=>"P001",
			"terimabarang_tanggal"=>"2018-10-02",
			"terimabarang_beban"=>0,
			"terimabarang_term"=>"fob_destination_point",
			"kontak_id"=>8,
			"peserta_id"=>$peserta
			);

		$this->db->insert("eksperimen_terimabarang",$data);


		$data = array(
		"terimabarang_id"=>"SMR001",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"baristerimabarang_jumlah"=>400
		);

		$this->db->insert("eksperimen_baristerimabarang",$data);


		$data=array(
			"terimabarang_id"=>"SMR002",
			"pesanbeli_id"=>"P002",
			"terimabarang_tanggal"=>"2018-10-02",
			"terimabarang_beban"=>0,
			"kontak_id"=>9,
			"terimabarang_term"=>"fob_destination_point",
			"peserta_id"=>$peserta
			);

		$this->db->insert("eksperimen_terimabarang",$data);


		$data = array(
			"terimabarang_id"=>"SMR002",
			"peserta_id"=>$peserta,
			"barang_id"=>3,
			"baristerimabarang_jumlah"=>400
		);

		$this->db->insert("eksperimen_baristerimabarang",$data);


		$data=array(
			"terimabarang_id"=>"SMR003",
			"pesanbeli_id"=>"P003",
			"terimabarang_tanggal"=>"2018-10-02",
			"terimabarang_beban"=>0,
			"kontak_id"=>10,
			"terimabarang_term"=>"fob_shipping_point",
			"peserta_id"=>$peserta
			);

		$this->db->insert("eksperimen_terimabarang",$data);


		$data = array(
		"terimabarang_id"=>"SMR003",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"baristerimabarang_jumlah"=>400
		);

		$this->db->insert("eksperimen_baristerimabarang",$data);

		//Isi tagihan

		$data = array(
			"tagihan_id"=>"PI001",
			"tagihan_tanggal" =>"2018-10-03",
			"kontak_id"=>8,
			"tagihan_term"=>"fob_destination_point",
			"terimabarang_id"=>"SMR001",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_tagihan",$data);


		$data = array(
		"tagihan_id"=>"PI001",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"baristagihan_jumlah"=>400,
		"baristagihan_subtotal"=>40000000
		);

		$this->db->insert("eksperimen_baristagihan",$data);



		$data = array(
			"tagihan_id"=>"PI002",
			"tagihan_tanggal" =>"2018-10-03",
			"kontak_id"=>9,
			"tagihan_term"=>"fob_destination_point",
			"terimabarang_id"=>"SMR002",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_tagihan",$data);


		$data = array(
		"tagihan_id"=>"PI002",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"baristagihan_jumlah"=>400,
		"baristagihan_subtotal"=>40000000
		);

		$this->db->insert("eksperimen_baristagihan",$data);



		$data = array(
			"tagihan_id"=>"PI003",
			"tagihan_tanggal" =>"2018-10-03",
			"kontak_id"=>10,
			"tagihan_term"=>"fob_shipping_point",
			"terimabarang_id"=>"SMR003",
			"peserta_id"=>$peserta
		);
		$this->db->insert("eksperimen_tagihan",$data);


		$data = array(
		"tagihan_id"=>"PI003",
		"peserta_id"=>$peserta,
		"barang_id"=>3,
		"baristagihan_jumlah"=>400,
		"baristagihan_subtotal"=>40000000
		);

		$this->db->insert("eksperimen_baristagihan",$data);

		//Pembayaran
		$data=array(
			"pembtagihan_id"=>"CD001",
			"pembtagihan_tanggal"=>"2018-10-04",
			"pembtagihan_jumlah"=>40000000,
			"pembtagihan_via"=>"bank",
			"pembtagihan_ket"=>"",
			"peserta_id"=>$peserta,
			"tagihan_id"=>"PI001"
			);
		$this->db->insert("eksperimen_pembtagihan",$data);

		$data=array(
			"pembtagihan_id"=>"CD002",
			"pembtagihan_tanggal"=>"2018-10-04",
			"pembtagihan_jumlah"=>40000000,
			"pembtagihan_via"=>"bank",
			"pembtagihan_ket"=>"",
			"peserta_id"=>$peserta,
			"tagihan_id"=>"PI002"
			);
		$this->db->insert("eksperimen_pembtagihan",$data);		
	}
}
?>
