<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Partisipan extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	
	public $nav;
	
	public function partisipasi()
	{
		$this->load->database();
		$this->load->library('user_agent');
		$this->load->helper('cookie');

		//data peserta
		$ip = $this->input->ip_address();
		$kota = "";
		$lokasi = "";
		$isp = "";
		if(!filter_var($ip, FILTER_VALIDATE_IP)) 
			$cekIP = "";
		else
			$cekIP = $ip."/";
 		$getloc = json_decode(file_get_contents("http://ipinfo.io/".$cekIP."json"));

		$browser = $this->input->user_agent();
		if(isset($getloc->city)){
			$kota = $getloc->city;
			$lokasi = $getloc->region;
			$isp = $getloc->org;
		}
		$token = hash("sha512",mt_rand().date("H:i:s").$browser.$isp);

		//variabel
		$a = 0; // navigasi
		$b = 0; // preview
		$cek = 20; //pelaksanaan distribusi random ketika jumlah peserta yang melaksanakan lebih dari variabel\
		$maxDev = 2; //maksimal standar deviasi
		$finish = 7; //stat 6 = beres soal, stat 7 beres kesulitan, stat 8 100% finish beserta email
		$urutan = mt_rand(1,2);

		//Uji random
		$random = mt_rand(1,100);

		//populasi total 
		$nt = $this->db
		->get("eksperimen_peserta")->num_rows();

		//populasi valid
		if($nt > $cek) $this->db->where("peserta_status",$finish);
		$n= $this->db
		->get("eksperimen_peserta")->num_rows();
		if($n==0) $n = 1;

		//populasi variabel x1 (Dengan navigasi, dengan preview)
		if($nt > $cek) $this->db->where("peserta_status",$finish);
		$nx1 = $this->db
		->where("peserta_navigasi",1)
		->where("peserta_panduan",1)
		->get("eksperimen_peserta")->num_rows();

		//populasi variabel x2 (Dengan navigasi, tanpa preview)
		if($nt > $cek) $this->db->where("peserta_status",$finish);
		$nx2 = $this->db
		->where("peserta_navigasi",1)
		->where("peserta_panduan",0)
		->get("eksperimen_peserta")->num_rows();

		//populasi variabel x3 (Tanpa navigasi, dengan preview)
		if($nt > $cek) $this->db->where("peserta_status",$finish);
		$nx3 = $this->db
		->where("peserta_navigasi",0)
		->where("peserta_panduan",1)
		->get("eksperimen_peserta")->num_rows();

		//populasi variabel x4 (Tanpa navigasi, tanpa preview)
		if($nt > $cek) $this->db->where("peserta_status",$finish);
		$nx4 = $this->db
		->where("peserta_navigasi",0)
		->where("peserta_panduan",0)
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


		set_cookie("token_eksperimen",$token,214748364);
		if($this->input->cookie("cek_cookie") != 1) return array("gagal","Cookie tidak aktif");

		$this->db
			->set("peserta_navigasi",$a)
			->set("peserta_panduan",$b)
			->set("peserta_urutan",$urutan)
			->set("peserta_pengalaman",0)
			->set("peserta_token",$token)
			->set("peserta_ip",$ip)
			->set("peserta_browser",$browser)
			->set("peserta_kota",$kota)
			->set("peserta_lokasi",$lokasi)
			->set("peserta_isp",$isp)
			->set("peserta_status",0);
		$this->db->insert("eksperimen_peserta"); // simpan peserta pada database
   		$insert_id = $this->db->insert_id();

   		$this->session->set_userdata("id",$insert_id);
   		$this->session->set_userdata("navigasi",$a);
   		$this->session->set_userdata("panduan",$b);

		return array("berhasil","Peserta diinput");
	}	
}
?>