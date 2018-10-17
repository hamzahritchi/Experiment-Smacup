<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pengiriman extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$peserta = $this->session->userdata("id");
			$this->db->where("peserta_id",$peserta);
			$datauser=$this->db->where("pengiriman_id",$kode)->get("eksperimen_pengiriman");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$peserta = $this->session->userdata("id");
			$datauser=$this->db->where("peserta_id",$peserta)->where("pengiriman_id",$kode)->from("eksperimen_barispengiriman t")->join("eksperimen_barang b","b.barang_id=t.barang_id")->get();
			return $datauser->result_array();
		}

		public function get_pengiriman(){
			$this->load->library("session");
			$peserta = $this->session->userdata("id");

			$this->db->where("peserta_id",$peserta);
			$pengiriman=$this->db
					->from("eksperimen_pengiriman p")
					->join("eksperimen_kontak k","k.kontak_id=p.kontak_id")
					->get()
					->result();

			return $pengiriman;
		}
			
		public function tambah_pengiriman()
		{
			//validasi
		    $this->load->library('form_validation');
		    $this->load->model("m_Serbaguna","ms");

		    $this->form_validation->set_rules('id', 'id', 'trim|required|max_length[20]');
			
			 if($this->form_validation->run() == FALSE){
				return "gagal";
			}
			else{
				//gabung mang
				$id=$this->input->post("id");
				$pesanan=$this->input->post("pesanan");
				$pemesan=$this->input->post("pemesan");
				$tanggal=$this->input->post("tanggal");
				$term=$this->input->post("term");
				$biaya=$this->input->post("biaya");
				$barang=$this->input->post("namabarang");
				$jumlah=$this->input->post("jumlah");
				$peserta = $this->session->userdata("id");


				$case1_a2 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case1")->row()->case1_a2;
				if($case1_a2 == 1) return ["gagal","Anda sudah mengerjakan soal ini"];


				if(empty($pesanan)){
					$pesanan=null;
				} else {
					if($this->ms->cek_ada("eksperimen_pesanan",["pesanan_id"=>$pesanan,"peserta_id"=>$peserta])==FALSE) return ["gagal","No Pesanan Salah"];
				}

				if($this->ms->cek_ada("eksperimen_pengiriman",["pengiriman_id"=>$id,"peserta_id"=>$peserta])==TRUE) return ["gagal","ID Sudah dipakai"];

				$cek=0;
				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;
					$cek++;
				}

				if($cek==0) return ["gagal","Isi kosong"];

				$n7 = 0;
				$n8 = 0;
				$n9 = 0;
				$n10 = 0;
				$n11 = 0;

				if($id == "BDO001") $n7 = 1;
				if($pesanan == "S003") $n8 = 1;
				if($tanggal == "2018-09-08") $n9 = 1;
				if($biaya == "250000") $n10 = 1;

				$data=array(
					"pengiriman_id"=>$id,
					"pesanan_id"=>$pesanan,
					"pengiriman_tanggal"=>$tanggal,
					"kontak_id"=>$pemesan,
					"pengiriman_status"=>0,
					"pengiriman_beban"=>$biaya,
					"pengiriman_term"=>$term,
					"peserta_id"=>$peserta
					);

				$this->db->insert("eksperimen_pengiriman",$data);

				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;

					$dbarang=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row();

					if($this->ms->cek_ada("eksperimen_barispengiriman",array("barang_id"=>$barang[$i],"pengiriman_id"=>$id,"peserta_id",$peserta))){
						$this->db->where("barang_id",$barang[$i])->where(["pengiriman_id"=>$id,"peserta_id"=>$peserta])->set("barispengiriman_jumlah","barispengiriman_jumlah+".$jumlah[$i],false)->update("eksperimen_barispengiriman");
						continue;
					}

					$tcost=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row()->barang_cost*$jumlah[$i];
					$data=array(
							"pengiriman_id"=>$id,
							"barang_id"=>$barang[$i],
							"barispengiriman_jumlah"=>$jumlah[$i],
							"barispengiriman_tcost"=>$tcost,
							"peserta_id"=>$peserta
						);

					$this->db->insert("eksperimen_barispengiriman",$data);

					if($jumlah[$i] == 50) $n11 = 1;
				}

				//Update status pesanan
				$this->db->set("pesanan_status",1)->where(["pesanan_id"=>$pesanan,"peserta_id"=>$peserta])->update("eksperimen_pesanan");

			$data = array(
				"case1_7" => $n7,
				"case1_8" => $n8,
				"case1_9" => $n9,
				"case1_10" => $n10,
				"case1_11" => $n11,
				"case1_a2" => 1,
			);

			$this->db->where("peserta_id",$peserta)->update("eksperimen_case1",$data);

				return "berhasil";
			}
		}
	

		public function update_pengiriman($kode = "A123")
		{
			//validasi
		    $this->load->library('form_validation');
		    $this->load->model("m_Serbaguna","ms");

		    $this->form_validation->set_rules('id', 'id', 'trim|required|max_length[20]');
			
			 if($this->form_validation->run() == FALSE){
				return ["gagal","Form tidak lengkap"];
			}
			else{
				//gabung mang
				$id=$this->input->post("id");
				$pesanan=$this->input->post("pesanan");
				$pemesan=$this->input->post("pemesan");
				$tanggal=$this->input->post("tanggal");
				$term=$this->input->post("term");
				$biaya=$this->input->post("biaya");
				$barang=$this->input->post("namabarang");
				$jumlah=$this->input->post("jumlah");
				$peserta = $this->session->userdata("id");


				$case1_a3 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case1")->row()->case1_a3;
				if($case1_a3 == 1) return ["gagal","Anda sudah mengerjakan soal selanjutnya"];


				if(empty($pesanan)){
					$pesanan=null;
				} else {
					if($this->ms->cek_ada("eksperimen_pesanan",["pesanan_id"=>$pesanan,"peserta_id"=>$peserta])==FALSE) return ["gagal","No Pesanan Salah"];
				}

				if($this->ms->cek_ada("eksperimen_pengiriman",["pengiriman_id"=>$id,"peserta_id"=>$peserta])==TRUE && $kode != $id) return ["gagal","ID Sudah dipakai"];


				if($this->ms->cek_ada("eksperimen_pengiriman",["pengiriman_id"=>$kode,"peserta_id"=>$peserta])==FALSE) return ["gagal","ID tidak ditemukan"];


				$cek=0;
				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;
					$cek++;
				}

				if($cek==0) return ["gagal","Isi kosong"];

				$n7 = 0;
				$n8 = 0;
				$n9 = 0;
				$n10 = 0;
				$n11 = 0;

				if($id == "BDO001") $n7 = 1;
				if($pesanan == "S003") $n8 = 1;
				if($tanggal == "2018-09-08") $n9 = 1;
				if($biaya == "250000") $n10 = 1;

				$data=array(
					"pengiriman_id"=>$id,
					"pesanan_id"=>$pesanan,
					"pengiriman_tanggal"=>$tanggal,
					"kontak_id"=>$pemesan,
					"pengiriman_status"=>0,
					"pengiriman_beban"=>$biaya,
					"pengiriman_term"=>$term,
					"peserta_id"=>$peserta
					);

				$this->db->where(["pengiriman_id"=>$kode,"peserta_id"=>$peserta]);
				$this->db->update("eksperimen_pengiriman",$data);

				$this->db->where(["pengiriman_id"=>$kode,"peserta_id"=>$peserta])->delete("eksperimen_barispengiriman");
				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;

					$dbarang=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row();

					if($this->ms->cek_ada("eksperimen_barispengiriman",array("barang_id"=>$barang[$i],"pengiriman_id"=>$id,"peserta_id",$peserta))){
						$this->db->where("barang_id",$barang[$i])->where(["pengiriman_id"=>$id,"peserta_id"=>$peserta])->set("barispengiriman_jumlah","barispengiriman_jumlah+".$jumlah[$i],false)->update("eksperimen_barispengiriman");
						continue;
					}

					$tcost=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row()->barang_cost*$jumlah[$i];
					$data=array(
							"pengiriman_id"=>$id,
							"barang_id"=>$barang[$i],
							"barispengiriman_jumlah"=>$jumlah[$i],
							"barispengiriman_tcost"=>$tcost,
							"peserta_id"=>$peserta
						);

					$this->db->insert("eksperimen_barispengiriman",$data);

					if($jumlah[$i] == 50) $n11 = 1;
				}

				//Update status pesanan
				$this->db->set("pesanan_status",1)->where(["pesanan_id"=>$pesanan,"peserta_id"=>$peserta])->update("eksperimen_pesanan");

			$data = array(
				"case1_7" => $n7,
				"case1_8" => $n8,
				"case1_9" => $n9,
				"case1_10" => $n10,
				"case1_11" => $n11
			);

			$this->db->where("peserta_id",$peserta)->update("eksperimen_case1",$data);

				return "berhasil";
			}
		}

		public function delete_pengiriman($kode){
			$id=$kode;
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');

			$case1_a2 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case1")->row()->case1_a2;
			if($case1_a2 == 1) return ["gagal","Anda sudah mengerjakan soal ini"];

			if($this->ms->cek_ada("eksperimen_pengiriman",["pengiriman_id"=>$id,"peserta_id"=>$peserta])==TRUE){
				$this->db->where(["pengiriman_id"=>$id,"peserta_id"=>$peserta])->delete("eksperimen_barispengiriman");
				if($this->db->where(["pengiriman_id"=>$id,"peserta_id"=>$peserta])->delete("eksperimen_pengiriman")){
					return "berhasil";
				}
			else{
					return "gagal";
				}
			}
			else{
				return "gagal";
			}
		}
}
?>