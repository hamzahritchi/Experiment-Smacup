<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
			if($this->session->userdata("soal") != "soal1") redirect(base_url("soal"));
			$this->load->database();
			$peserta = $this->session->userdata("id");

			$currentURL = current_url(); //http://myhost/main

			$params   = $_SERVER['QUERY_STRING']; //my_id=1,3

			$fullURL = $currentURL . '?' . $params; 
			$this->db->set("peserta_id",$peserta)->set("aktivitas_url",$fullURL)->insert("eksperimen_aktivitas");
    }
		
	public function index(){
		//load model
		$this->load->model('m_Navigasi');
		
		//code
		
		//muatan data
		$data['hal']="penjualan/utama";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function pesanan(){
		//load model
		$this->load->library('user_agent');
		$this->load->model('m_Navigasi');
		$this->load->model('m_Kontak');
		$this->load->model('m_Barang');
		$this->load->model('m_Pesanan');
		
		//code
		
		//muatan data
		$data['barang']=$this->m_Barang->get_barang("2");
		$data['pembeli']=$this->m_Kontak->get_kontak_tipe("2");
		$data['pesanan']=$this->m_Pesanan->get_pesanan();
		$data['hal']="penjualan/pesanan";
		$data['nav']=$this->m_Navigasi->case1();
		$data['id'] = $this->m_Pesanan->get_id();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

		//Apabila ada post
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_Pesanan->tambah_pesanan();
				break;				
				case "update":
				$hasil=$this->m_Pesanan->update_pesanan();
				break;
				case "delete":
				$hasil=$this->m_Pesanan->delete_pesanan($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}		
	}	

	public function pesanan_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Pesanan");
			echo json_encode($this->m_Pesanan->get_detail($kode));
		}
	}	

	public function pesanan_detail_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Pesanan");
			echo json_encode($this->m_Pesanan->get_baris($kode));
		}
	}


	public function pesanan_ajax_harga($kode=0){
		if($kode!==0){
			$this->load->model("m_Pesanan");
			echo json_encode($this->m_Pesanan->get_harga($kode));
		}
	}

	public function pengiriman(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->library('user_agent');
		$this->load->model('m_Kontak');
		$this->load->model('m_Barang');
		$this->load->model('m_Pengiriman');
		$peserta = $this->session->userdata("id");
		
		//code
		$data['pesanan'] = $this->db->where("peserta_id",$peserta)->get("eksperimen_pesanan")->result();
		//muatan data
		$data['barang']=$this->m_Barang->get_barang("2");
		$data['pembeli']=$this->m_Kontak->get_kontak_tipe("2");
		$data['pengiriman']=$this->m_Pengiriman->get_pengiriman();
		$data['hal']="penjualan/pengiriman";
		$data['nav']=$this->m_Navigasi->case1();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);		

		//Apabila ada post
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_Pengiriman->tambah_pengiriman();
				break;
				case "delete":
				$hasil=$this->m_Pengiriman->delete_pengiriman($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}
	}	

	public function pengiriman_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Pengiriman");
			echo json_encode($this->m_Pengiriman->get_detail($kode));
		}
	}	

	public function  pengiriman_detail_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Pengiriman");
			echo json_encode($this->m_Pengiriman->get_baris($kode));
		}
	}


	public function pengiriman_ajax_harga($kode=0){
		if($kode!==0){
			$this->load->model("m_Pengiriman");
			echo json_encode($this->m_Pengiriman->get_harga($kode));
		}
	}

		public function penagihan(){
		//load model
		$this->load->library('user_agent');
		$this->load->model('m_Navigasi');
		$this->load->model('m_Kontak');
		$this->load->model('m_Barang');
		$this->load->model('m_Penagihan');
		
		//code
		
		//muatan data
		$data['barang']=$this->m_Barang->get_barang("2");
		$data['pembeli']=$this->m_Kontak->get_kontak_tipe("2");
		$data['kwitansi']=$this->m_Penagihan->get_penagihan();
		$data['hal']="penjualan/penagihan";
		$data['nav']=$this->m_Navigasi->case1();
		$data['id'] = $this->m_Penagihan->get_id();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

		//Apabila ada post
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_Penagihan->tambah_penagihan();
				break;				
				case "update":
				$hasil=$this->m_Penagihan->update_penagihan();
				break;
				case "delete":
				$hasil=$this->m_Penagihan->delete_penagihan($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}		
	}	

	public function penagihan_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Penagihan");
			echo json_encode($this->m_Penagihan->get_detail($kode));
		}
	}	

	public function penagihan_detail_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Penagihan");
			echo json_encode($this->m_Penagihan->get_baris($kode));
		}
	}

		public function pembayaran(){
		//load model
		$this->load->library('user_agent');
		$this->load->model('m_Navigasi');
		$this->load->model('m_Pembayaran');
		
		//code
		
		//muatan data
		$data['bayar']=$this->m_Pembayaran->get_pembayaran();
		$data['hal']="penjualan/pembayaran";
		$data['nav']=$this->m_Navigasi->case1();
		$data['id'] = $this->m_Pembayaran->get_id();
		
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);

		//Apabila ada post
		if($this->input->get("tipe")){
			$hasil="gagal";
			$tipe=$this->input->get("tipe");
			switch($tipe){
				case "tambah":
				$hasil=$this->m_Pembayaran->tambah_pembayaran();
				break;				
				case "update":
				$hasil=$this->m_Pembayaran->update_pembayaran();
				break;
				case "delete":
				$hasil=$this->m_Pembayaran->delete_pembayaran($this->input->get("id"));
				break;
			}

			$this->session->set_flashdata("hasil",$hasil);
			redirect($this->agent->referrer());
		}		
	}	

	public function pembayaran_ajax($kode=0){
		if($kode!==0){
			$this->load->model("m_Pembayaran");
			echo json_encode($this->m_Pembayaran->get_detail($kode));
		}
	}	

	public function laporan(){
		//load model
		$this->load->model('m_Navigasi');
		$this->load->model('m_OutputPenjualan');
		
		//code

		//muatan data
		$data["jumlah"]=($this->input->get("tipe")=="laporan") ? $this->m_OutputPenjualan->jumlah() : "";
		$data['hal']= ($this->input->get("tipe")=="laporan") ? "penjualan/laporan_output" : "penjualan/laporan";
		$data['nav']=$this->m_Navigasi->case1();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
}
