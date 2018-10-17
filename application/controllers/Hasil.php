<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hasil extends CI_Controller {
	public function __construct(){
			parent::__construct();
            //code for allowed
			$this->load->helper('url');
			$this->load->database();
    }
		
	public function penelitian($kode = ""){
		//memastikan hasil penelitian dapat diakses dengan kode dibawah ini
		//537c03ffff7c1e2069adf82b2bb94fa2babdec2a6aa7a764103d25a183df618db76c3936d26110aad104844a0496e6146fba0b76ba98090ac33f192edb908f59
		if($kode == md5("PUPTUNPAD").md5("MUHAMMADGHANYIRSYA").md5("keren").md5("sekali")){
			//pilih data yang akan ditarik
			$this->db
				->select("p.peserta_id")				
->select("p.peserta_dibuat")
				->select("p.peserta_status")
				->select("peserta_email")
				->select("peserta_hp")
				->select("peserta_hadiah")
				->select("peserta_isp")
				->select("peserta_ip")
				->select("peserta_lokasi")
				->select("peserta_kota")
				->select("peserta_browser")
				->select("peserta_pengalaman")
				->select("peserta_navigasi")
				->select("peserta_panduan")
				->select("(count(`aktivitas_url`)) as `peserta_aktivitas`",false)
				->select("responden_jk")
				->select("responden_usia")
				->select("responden_pendidikan")
				->select("responden_bidangusaha")
				->select("responden_penghasilan")
				->select("responden_karyawan")
				->select("(karakteristik_1 + karakteristik_2 + karakteristik_3 + karakteristik_4) as karakteristik_total",false)
				->select("karakteristik_text2")
				->select("peserta_urutan")
				->select("case1_final")
				->select("(UNIX_TIMESTAMP(case1_timefinish) - UNIX_TIMESTAMP(case1_timestart)) as case1_waktu",false)
				->select("case2_final")
				->select("(UNIX_TIMESTAMP(case2_timefinish) - UNIX_TIMESTAMP(case2_timestart)) as case2_waktu",false)
				->select("kesulitan_1")
				->select("kesulitan_2")
				->select("kesulitan_3")
				->select("kesulitan_4")
				->select("kesulitan_5")
				->select("kesulitan_preferensi");
			$this->db->order_by("peserta_dibuat","asc");
			$this->db->from("eksperimen_peserta p");
			$this->db->group_by("p.peserta_id")
			->group_by("responden_jk")
				->group_by("responden_usia")
				->group_by("responden_pendidikan")
				->group_by("responden_bidangusaha")
				->group_by("responden_penghasilan")
				->group_by("responden_karyawan")
				->group_by("karakteristik_total")
				->group_by("karakteristik_text2")
				->group_by("case1_final")
				->group_by("case1_waktu")
				->group_by("case2_final")
				->group_by("case2_waktu")
				->group_by("kesulitan_1")
				->group_by("kesulitan_2")
				->group_by("kesulitan_3")
				->group_by("kesulitan_4")
				->group_by("kesulitan_5")
				->group_by("kesulitan_preferensi");
			$this->db->join("eksperimen_responden r","r.peserta_id=p.peserta_id");
			$this->db->join("eksperimen_aktivitas a","a.peserta_id=p.peserta_id");
			$this->db->join("eksperimen_karakteristik k","k.peserta_id=p.peserta_id");
			$this->db->join("eksperimen_case1 c1","c1.peserta_id=p.peserta_id");
			$this->db->join("eksperimen_case2 c2","c2.peserta_id=p.peserta_id");
			$this->db->join("eksperimen_kesulitan ks","ks.peserta_id=p.peserta_id");
			$data = $this->db->get()->result_array();

			//Siapkan judul tabel
			echo "<table>";
			echo "<tr>";
				echo "<th>No</th>";
				echo "<th>ID</th>";				
echo "<th>Waktu</th>";
				echo "<th>Status</th>";
				echo "<th>Email</th>";
				echo "<th>HP</th>";
				echo "<th>Reward</th>";
				echo "<th>ISP</th>";
				echo "<th>IP</th>";
				echo "<th>Lokasi</th>";
				echo "<th>Kota</th>";
				echo "<th>Browser</th>";
				echo "<th>Pengalaman</th>";
				echo "<th>Navigasi</th>";
				echo "<th>Panduan</th>";
				echo "<th>Total Aktivitas</th>";
				echo "<th>Jenis Kelamin</th>";
				echo "<th>Usia</th>";
				echo "<th>Pendidikan</th>";
				echo "<th>Bidang Usaha</th>";
				echo "<th>Penghasilan</th>";
				echo "<th>Karyawan</th>";
				echo "<th>Nilai Pengalaman</th>";
				echo "<th>Pengalaman Software</th>";				
				echo "<th>Urutan Soal</th>";
				echo "<th>Nilai Case 1</th>";
				echo "<th>Waktu Case 1 (detik)</th>";
				echo "<th>Nilai Case 2</th>";
				echo "<th>Waktu Case 2 (detik)</th>";
				echo "<th>Post test 1</th>";
				echo "<th>Post test 2</th>";
				echo "<th>Post test 3</th>";
				echo "<th>Post test 4</th>";
				echo "<th>Post test 5</th>";
				echo "<th>Post test preferensi</th>";
			echo "</tr>";

			//Isi data kedalam tabel yang sudah disiapkan
			$n = 1;
			foreach($data as $d){
				echo "<tr>";
				echo "<td>$n</td>";
				foreach($d as $a){
					echo "<td>";
					echo $a;
					echo "</td>";
				}
				echo "</tr>";
				$n++;
			}
			echo "</table>";
		}
	}
	public function jumlahpeserta(){
		//Melihat jumlah peserta pada masing-masing case
		echo $this->db->get('eksperimen_peserta')->num_rows()."<br>";
		echo $this->db->where("peserta_status",1)->get('eksperimen_peserta')->num_rows()."<br>";
		echo $this->db->where("peserta_status",2)->get('eksperimen_peserta')->num_rows()."<br>";
		echo $this->db->where("peserta_status",3)->get('eksperimen_peserta')->num_rows()."<br>";
		echo $this->db->where("peserta_status",4)->get('eksperimen_peserta')->num_rows()."<br>";
		echo $this->db->where("peserta_status",5)->get('eksperimen_peserta')->num_rows()."<br>";
		echo $this->db->where("peserta_status",6)->get('eksperimen_peserta')->num_rows()."<br>";
		echo $this->db->where("peserta_status",7)->get('eksperimen_peserta')->num_rows()."<br>";
		echo $this->db->where("peserta_status",8)->get('eksperimen_peserta')->num_rows()."<br>";
	}

	public function case1(){
		//Monitoring nilai case1 peserta
		$case = $this->db->get('eksperimen_case1')->result_array();
		foreach($case as $c){
			foreach($c as $a){
				echo $a."|";
			}
			echo "<br>";
		}
	}

	public function case2(){
		//Monitoring nilai case2 peserta
		$case = $this->db->get('eksperimen_case2')->result_array();
		foreach($case as $c){
			foreach($c as $a){
				echo $a."|";
			}
			echo "<br>";
		}
	}

	public function std(){
		//fungsi untuk melihat standar deviasi dari para kasus eksperimen yang didistribusikan
		$this->load->database();
		$this->load->library('user_agent');
		$this->load->helper('cookie');

		//data peserta
		$ip = $this->input->ip_address();
		$kota = "";
		$lokasi = "";
		$isp = "";
		$browser = $this->input->user_agent();
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
		if($nt > $cek) $this->db->where("peserta_status >=",$finish);
		$n= $this->db
		->get("eksperimen_peserta")->num_rows();
		if($n==0) $n = 1;
		//populasi variabel x1 (Dengan navigasi, dengan preview)
		if($nt > $cek) $this->db->where("peserta_status >=",$finish);
		$nx1 = $this->db
		->where("peserta_navigasi",1)
		->where("peserta_panduan",1)
		->get("eksperimen_peserta")->num_rows();
		//populasi variabel x2 (Dengan navigasi, tanpa preview)
		if($nt > $cek) $this->db->where("peserta_status >=",$finish);
		$nx2 = $this->db
		->where("peserta_navigasi",1)
		->where("peserta_panduan",0)
		->get("eksperimen_peserta")->num_rows();
		//populasi variabel x3 (Tanpa navigasi, dengan preview)
		if($nt > $cek) $this->db->where("peserta_status >=",$finish);
		$nx3 = $this->db
		->where("peserta_navigasi",0)
		->where("peserta_panduan",1)
		->get("eksperimen_peserta")->num_rows();
		//populasi variabel x4 (Tanpa navigasi, tanpa preview)
		if($nt > $cek) $this->db->where("peserta_status >=",$finish);
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

		//tampilkan nilai proporsi 4 case, N 4 case, dan standar deviasi
		echo "$px1 $px2 $px3 $px4 <br>";
		echo "$nx1 $nx2 $nx3 $nx4 <br>";
		echo $deviasi." ".$a." ".$b."<br>";
	}
}
?>