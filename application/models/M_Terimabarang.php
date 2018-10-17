<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_Terimabarang extends CI_Model {
		public function get_detail($kode)
		{
			$this->load->database();
			$peserta = $this->session->userdata("id");
			$datauser=$this->db->where("peserta_id",$peserta)->where("terimabarang_id",$kode)->get("eksperimen_terimabarang");
			return $datauser->row_array();
		}		

		public function get_baris($kode)
		{
			$this->load->database();
			$peserta = $this->session->userdata("id");
			$datauser=$this->db->where("peserta_id",$peserta)->where("terimabarang_id",$kode)->from("eksperimen_baristerimabarang t")->join("eksperimen_barang b","b.barang_id=t.barang_id")->get();
			return $datauser->result_array();
		}

		public function get_penerimaan(){
			$this->load->library("session");
			$this->load->database();
			$peserta = $this->session->userdata("id");

			$terimabarang=$this->db->where("p.peserta_id",$peserta)
					->from("eksperimen_terimabarang p")
					->join("eksperimen_pesanbeli b","b.pesanbeli_id=p.pesanbeli_id and b.peserta_id=p.peserta_id","left")
					->join("eksperimen_kontak k","k.kontak_id=b.kontak_id","left")
					->get()
					->result();

			return $terimabarang;
		}
			
		public function tambah_penerimaan()
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
				$tanggal=$this->input->post("tanggal");
				$biaya=$this->input->post("biaya");

				$barang=$this->input->post("namabarang");
				$jumlah=$this->input->post("jumlah");
				$peserta = $this->session->userdata("id");

				$case2_a2 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case2")->row()->case2_a2;
				if($case2_a2 == 1) return ["gagal","Anda sudah mengerjakan soal ini"];

				if($this->ms->cek_ada("eksperimen_pesanbeli",["pesanbeli_id"=>$pesanan,"peserta_id"=>$peserta])==FALSE) return ["gagal","ID Pesanan tidak ada"];
				$term = $this->db->where("peserta_id",$peserta)->where("pesanbeli_id",$pesanan)->get("eksperimen_pesanbeli")->row()->pesanbeli_term;

				if($this->ms->cek_ada("eksperimen_terimabarang",["terimabarang_id"=>$id,"peserta_id"=>$peserta])==TRUE) return ["gagal","No Resi sudah dipakai"];

				$cek=0;
				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;
					$cek++;
				}

				if ($cek == 0) return ["gagal","Pilih Nomor Pesanan terlebih dahulu"];

				$kontak = $this->db->where(["peserta_id"=>$peserta,"pesanbeli_id"=>$pesanan])->get("eksperimen_pesanbeli")->row()->kontak_id;
				$data=array(
					"terimabarang_id"=>$id,
					"pesanbeli_id"=>$pesanan,
					"terimabarang_tanggal"=>$tanggal,
					"terimabarang_beban"=>$biaya,
					"terimabarang_term"=>$term,
					"kontak_id"=>$kontak,
					"peserta_id"=>$peserta
					);

				$this->db->insert("eksperimen_terimabarang",$data);

				$n7 = 0;
				$n8 = 0;
				$n9 = 0;
				$n10 = 0;
				$n11 = 0;

				if($id == "JKT001") $n7 = 1;
				if($pesanan == "P005") $n8 = 1;
				if($tanggal == "2018-10-12") $n9 = 1;
				if($biaya == "100000") $n10 = 1;

				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;

					$dbarang=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row();

					if($this->ms->cek_ada("eksperimen_baristerimabarang",array("barang_id"=>$barang[$i],"terimabarang_id"=>$id,"peserta_id"=>$peserta))){
						$this->db->where("barang_id",$barang[$i])->where("terimabarang_id",$id)->where("peserta_id",$peserta)->set("baristerimabarang_jumlah","baristerimabarang_jumlah+".$jumlah[$i],false)->update("eksperimen_baristerimabarang");
						continue;

					}

					if($jumlah[$i] == 500) $n11=1;
					$data=array(
							"terimabarang_id"=>$id,
							"barang_id"=>$barang[$i],
							"peserta_id"=>$peserta,
							"baristerimabarang_jumlah"=>$jumlah[$i]
						);

					$this->db->insert("eksperimen_baristerimabarang",$data);

				}

				$this->db->where("peserta_id",$peserta)->where("pesanbeli_id",$pesanan)->set("pesanbeli_status",1)->update("eksperimen_pesanbeli");

				$data = array(
					"case2_7" => $n7,
					"case2_8" => $n8,
					"case2_9" => $n9,
					"case2_10" => $n10,
					"case2_11" => $n11,
					"case2_a2" => 1,
				);

				$this->db->where("peserta_id",$peserta)->update("eksperimen_case2",$data);

				return "berhasil";
			}
		}
	
	public function update_penerimaan($kode = "A123")
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
				$tanggal=$this->input->post("tanggal");
				$biaya=$this->input->post("biaya");

				$barang=$this->input->post("namabarang");
				$jumlah=$this->input->post("jumlah");
				$peserta = $this->session->userdata("id");

				$case2_a3 = $this->db->where("peserta_id",$peserta)->get("eksperimen_case2")->row()->case2_a3;
				if($case2_a3 == 1) return ["gagal","Anda sudah mengerjakan soal selanjutnya"];

				if($this->ms->cek_ada("eksperimen_pesanbeli",["pesanbeli_id"=>$pesanan,"peserta_id"=>$peserta])==FALSE) return ["gagal","ID Pesanan tidak ada"];
				$term = $this->db->where("peserta_id",$peserta)->where("pesanbeli_id",$pesanan)->get("eksperimen_pesanbeli")->row()->pesanbeli_term;

				if($this->ms->cek_ada("eksperimen_terimabarang",["terimabarang_id"=>$id,"peserta_id"=>$peserta])==TRUE  && $id != $kode) return ["gagal","No Resi sudah dipakai"];

				if($this->ms->cek_ada("eksperimen_terimabarang",["terimabarang_id"=>$kode,"peserta_id"=>$peserta])==FALSE) return ["gagal","ID Tidak ditemukan"];

				$cek=0;
				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;
					$cek++;
				}

				if ($cek == 0) return ["gagal","Pilih Nomor Pesanan terlebih dahulu"];

				$kontak = $this->db->where(["peserta_id"=>$peserta,"pesanbeli_id"=>$pesanan])->get("eksperimen_pesanbeli")->row()->kontak_id;
				$data=array(
					"terimabarang_id"=>$id,
					"pesanbeli_id"=>$pesanan,
					"terimabarang_tanggal"=>$tanggal,
					"terimabarang_beban"=>$biaya,
					"terimabarang_term"=>$term,
					"kontak_id"=>$kontak,
					"peserta_id"=>$peserta
					);

				$this->db->where(["terimabarang_id"=>$kode,"peserta_id"=>$peserta]);
				$this->db->update("eksperimen_terimabarang",$data);
				$this->db->where(["terimabarang_id"=>$kode,"peserta_id"=>$peserta])->delete("eksperimen_baristerimabarang");

				$n7 = 0;
				$n8 = 0;
				$n9 = 0;
				$n10 = 0;
				$n11 = 0;

				if($id == "JKT001") $n7 = 1;
				if($pesanan == "P005") $n8 = 1;
				if($tanggal == "2018-10-12") $n9 = 1;
				if($biaya == "100000") $n10 = 1;

				for($i=0;$i<count($barang);$i++){
					if($this->ms->cek_ada("eksperimen_barang","barang_id",$barang[$i])==FALSE) continue;

					$dbarang=$this->db->where("barang_id",$barang[$i])->get("eksperimen_barang")->row();

					if($this->ms->cek_ada("eksperimen_baristerimabarang",array("barang_id"=>$barang[$i],"terimabarang_id"=>$id,"peserta_id"=>$peserta))){
						$this->db->where("barang_id",$barang[$i])->where("terimabarang_id",$id)->where("peserta_id",$peserta)->set("baristerimabarang_jumlah","baristerimabarang_jumlah+".$jumlah[$i],false)->update("eksperimen_baristerimabarang");
						continue;

					}

					if($jumlah[$i] == 500) $n11=1;
					$data=array(
							"terimabarang_id"=>$id,
							"barang_id"=>$barang[$i],
							"peserta_id"=>$peserta,
							"baristerimabarang_jumlah"=>$jumlah[$i]
						);

					$this->db->insert("eksperimen_baristerimabarang",$data);

				}

				$this->db->where("peserta_id",$peserta)->where("pesanbeli_id",$pesanan)->set("pesanbeli_status",1)->update("eksperimen_pesanbeli");

				$data = array(
					"case2_7" => $n7,
					"case2_8" => $n8,
					"case2_9" => $n9,
					"case2_10" => $n10,
					"case2_11" => $n11
				);

				$this->db->where("peserta_id",$peserta)->update("eksperimen_case2",$data);

				return "berhasil";
			}
		}

		public function delete_penerimaan($kode){
			$peserta = $this->session->userdata("id");
			$id=$kode;
			$this->load->database();
			$this->load->model('m_Serbaguna','ms');
			if($this->ms->cek_ada("eksperimen_terimabarang",["terimabarang_id"=>$id,"peserta_id"=>$peserta])==TRUE){
				$this->db->where(["terimabarang_id"=>$id,"peserta_id"=>$peserta])->delete("eksperimen_baristerimabarang");
				if($this->db->where("terimabarang_id",$id)->where("peserta_id",$peserta)->delete("eksperimen_terimabarang")){
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