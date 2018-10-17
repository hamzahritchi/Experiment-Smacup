<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hal extends CI_Controller {
	public function __construct(){
		parent::__construct();
	    //code for allowed
		$this->load->helper('url');		
		$this->load->library('session');
		if($this->session->userdata("otoritas")) redirect(base_url("dashboard"));
	}
		
	public function index(){
		$tahun = date('Y');
		$this->load->model('m_Navigasi');

		//muatan data
		$data['hal']="hal/utama";
		$data['judul']="Home";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function masuk(){
		$tahun = date('Y');
		$this->load->model('m_Navigasi');

		//muatan data
		$data['hal']="hal/masuk";
		$data['judul']="Masuk";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	public function panduan(){
		$tahun = date('Y');
		$this->load->model('m_Navigasi');

		//muatan data
		$data['hal']="hal/panduan";
		$data['judul']="Panduan";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}	

	public function soal(){
		$tahun = date('Y');
		$this->load->model('m_Navigasi');

		//muatan data
		$data['hal']="hal/soal";
		$data['judul']="Soal";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}
	public function pre(){
		$tahun = date('Y');
		$this->load->model('m_Navigasi');

		//muatan data
		$data['hal']="hal/masuk";
		$data['judul']="Masuk";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function post(){
		$tahun = date('Y');
		$this->load->model('m_Navigasi');

		//muatan data
		$data['hal']="hal/post";
		$data['judul']="Post Test";
		$data['nav']=$this->m_Navigasi->utama();
		
		//load tempelate
		$this->load->view("tempelate/ghancool",$data);
	}

	public function roll(){
		$x=1;
		while($x <= 200){
			$this->hajar();
			$x++;
		}
	}

	public function hajar(){
		$this->load->database();
		//variabel
		$a = 0; // navigasi
		$b = 0; // preview
		$cek = 20; //pelaksanaan distribusi random ketika jumlah peserta yang melaksanakan lebih dari variabel\
		$maxDev = 2; //maksimal standar deviasi

		//Uji random
		$random = mt_rand(1,100);

		//populasi total 
		$nt = $this->db
		->get("eksperimen_peserta")->num_rows();

		//populasi valid
		if($nt > $cek) $this->db->where("peserta_selesai",1);
		$n= $this->db
		->get("eksperimen_peserta")->num_rows();
		if($n==0) $n = 1;

		//populasi variabel x1 (Dengan navigasi, dengan preview)
		if($nt > $cek) $this->db->where("peserta_selesai",1);
		$nx1 = $this->db
		->where("peserta_nav",1)
		->where("peserta_prev",1)
		->get("eksperimen_peserta")->num_rows();

		//populasi variabel x2 (Dengan navigasi, tanpa preview)
		if($nt > $cek) $this->db->where("peserta_selesai",1);
		$nx2 = $this->db
		->where("peserta_nav",1)
		->where("peserta_prev",0)
		->get("eksperimen_peserta")->num_rows();

		//populasi variabel x3 (Tanpa navigasi, dengan preview)
		if($nt > $cek) $this->db->where("peserta_selesai",1);
		$nx3 = $this->db
		->where("peserta_nav",0)
		->where("peserta_prev",1)
		->get("eksperimen_peserta")->num_rows();

		//populasi variabel x4 (Tanpa navigasi, tanpa preview)
		if($nt > $cek) $this->db->where("peserta_selesai",1);
		$nx4 = $this->db
		->where("peserta_nav",0)
		->where("peserta_prev",0)
		->get("eksperimen_peserta")->num_rows();

		//persentase populasi
		$px1 = $nx1/$n*100;
		$px2 = $nx2/$n*100;
		$px3 = $nx3/$n*100;
		$px4 = $nx4/$n*100;
		$px = array($px1,$px2,$px3,$px4); //persentase dalam array

		//persentase terendah
		$minpx= min($px);

		//pembagi
		$g=($nx1 + $nx2 + $nx3 + $nx4)/$n;

		//chance 
		$cx1 = (($n-$nx1)/$n)/(4-($g))*100;
		$cx2 = (($n-$nx2)/$n)/(4-($g))*100;
		$cx3 = (($n-$nx3)/$n)/(4-($g))*100;
		$cx4 = (($n-$nx4)/$n)/(4-($g))*100;

		//Kalkulasi manual sample 1
		// freq & hasil kesempatan nilai baru terbentuk
		// 1 = 0/1/3*100 = 0
		// 0 = 33.33%
		// 0 = 33.33%
		// 0 = 33.33%

		//Kalkulasi manual sample 2
		// freq & hasil kesempatan nilai baru terbentuk
		//25 = 25%
		//50 = 17%
		//10 = 30%
		//15 = 28%

		//hitung deviasi
		$mean = $n/4;

		$deviasi = (pow($nx1,2)+pow($nx2,2)+pow($nx3,2)+pow($nx4,2))-(pow($nx1+$nx2+$nx3+$nx4,2)/4);
		$deviasi = sqrt($deviasi/4);

		echo $deviasi."<br>";

		// fungsi stabilisasi yang membatasi standar deviasi dibawah var yang ditentukan
		if($deviasi > $maxDev){
			while(1){
				if($random <= $cx1){
					if($px1 == $minpx){
						break;
					}
				}elseif($random <= $cx1+$cx2){
					if($px2 == $minpx){
						break;
					} 
				}elseif($random <= $cx1+$cx2+$cx3){
					if($px3 == $minpx){
						break;
					} 
				}else{
					if($px4 == $minpx) break;
				}
				$random = mt_rand(1,100);
			}
		}

		//menentukan permasalahan yang didapat peserta
		if($random <= $cx1){
			$a = 1;
			$b = 1;
		}elseif($random <= $cx1+$cx2){
			$a = 1;
		}elseif($random <= $cx1+$cx2+$cx3){
			$b = 1;
		}

		$this->db
			->set("peserta_nav",$a)
			->set("peserta_prev",$b)
			->set("peserta_selesai",1);
		$this->db->insert("eksperimen_peserta"); // simpan peserta pada database
	}
}
