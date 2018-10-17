<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class M_Navigasi extends CI_Model {

	

		public $nav;

		public function tarik($tarik){
		$tarikan = "";
			switch($tarik){
				case "utama":
				$tarikan = $this->utama();
				break;
				case "soal1":
				$tarikan = $this->case1();
				break;
				case "soal2":
				$tarikan = $this->case2();
				break;
				default:
				$tarikan = $this->utama();
				break;
			}
		return $tarikan;
		}



        public function utama()

        {

				$this->load->library('session');
				$this->load->helper('url');
				$this->load->model('m_Serbaguna');


				$this->nav="";
				

				return $this->nav;

        }

        public function case1()

        {

				$this->load->library('session');
				$this->load->helper('url');
				$this->load->model('m_Serbaguna');

				$this->nav.="<li><a href=\"".base_url("soal")."\" class=\"halonav\">Soal</a></li>";
			$this->nav.="<li class=\"dropdown\">";

								$this->nav.="<a href=\"".base_url()."penjualan\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">Penjualan";

								$this->nav.="<span class=\"caret\"></span></a>";

								$this->nav.="<ul class='dropdown-menu'>";

									$this->nav.="<li><a href=\"".base_url()."penjualan/pesanan\" class=\"halonav\">Pesanan</a></li>";

									$this->nav.="<li><a href=\"".base_url()."penjualan/pengiriman\" class=\"halonav\">Pengiriman</a></li>";

									$this->nav.="<li><a href=\"".base_url()."penjualan/penagihan\" class=\"halonav\">Penagihan</a></li>";

									$this->nav.="<li><a href=\"".base_url()."penjualan/pembayaran\" class=\"halonav\">Pembayaran</a></li>";
									$this->nav.="<li><a href=\"".base_url()."penjualan/laporan\" class=\"halonav\">Laporan</a></li>";

								$this->nav.="</ul>";

							$this->nav.="</li>";
				

				return $this->nav;

        }

        public function case2()

        {

				$this->load->library('session');
				$this->load->helper('url');
				$this->load->model('m_Serbaguna');


				$this->nav.="<li><a href=\"".base_url("soal")."\" class=\"halonav\">Soal</a></li>";

							$this->nav.="<li class=\"dropdown\">";

								$this->nav.="<a href=\"".base_url()."pembelian\" class=\"halonav dropdown-toggle\" data-toggle=\"dropdown\">Pembelian";

								$this->nav.="<span class=\"caret\"></span></a>";

								$this->nav.="<ul class='dropdown-menu'>";

									$this->nav.="<li><a href=\"".base_url()."Pembelian/pesanan\" class=\"halonav\">Pemesanan Barang</a></li>";

									$this->nav.="<li><a href=\"".base_url()."pembelian/penerimaan\" class=\"halonav\">Penerimaan Barang</a></li>";
									$this->nav.="<li><a href=\"".base_url()."pembelian/tagihan\" class=\"halonav\">Tagihan</a></li>";

									$this->nav.="<li><a href=\"".base_url()."pembelian/pembayaran\" class=\"halonav\">Pembayaran</a></li>";
									$this->nav.="<li><a href=\"".base_url()."pembelian/laporan\" class=\"halonav\">Laporan</a></li>";

								$this->nav.="</ul>";

							$this->nav.="</li>";
				

				return $this->nav;

        }

}

?>