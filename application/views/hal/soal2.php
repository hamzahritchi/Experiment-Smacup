

<?php $this->load->view("pembelian/soal"); 

if($this->session->userdata("navigasi") == 1){

?>

<div class="progressContainer">

      <ul class="progressbar">

          <li><a href='<?php echo base_url("pembelian/pesanan"); ?>'>Pesanan Pembelian</a></li>

          <li><a href='<?php echo base_url("pembelian/penerimaan"); ?>'>Penerimaan Barang</a></li>

          <li><a href='<?php echo base_url("pembelian/tagihan"); ?>'>Terima Tagihan</a></li>

          <li><a href='<?php echo base_url("pembelian/pembayaran"); ?>'>Bayar Tagihan</a></li>

          <li><a href='<?php echo base_url("pembelian/laporan"); ?>'>Laporan Pembelian</a></li>

 	 </ul>

</div>

<?php } ?>



  <div class="row dokumen" style="text-align:justify;">



        <div class="col-sm-12">
<h3>Kerjakan Case Berikut Secara Berurutan</h3>
		 <h3>Case - Pembelian</h3>
<ol>
		 <li>

		 Pada tanggal 10 Oktober 2018, Konveksi Baju Baru membatalkan pesanan pembelian kain ke PT.Kain Sutera dengan ID pembelian P005.   </li><li>

Tanggal 11 Oktober 2018, Konveksi Baju Baru melakukan pemesanan ke PT.Kain Katun sebanyak 500 meter kain katun motif batik. Harga untuk kain katun motif batik permeternya adalah Rp 75.000 dan biaya pengiriman ditanggung oleh PT.Kain Katun selaku penjual.  </li>
<li>PT. Kain katun memberikan resi pengiriman atas pesanan P005 tanggal 12 Oktober 2018. Nomor resi atas pengiriman tersebut adalah JKT001 dengan biaya pengiriman sebesar Rp 100.000. Pengiriman dilakukan untuk 500 meter kain yang dipesan oleh Konveksi Baju Baru.  </li><li>

  15 Oktober 2018, Konveksi Baju Baru menerima nota tagihan dengan nomor tagihan PI004 atas resi pengiriman JKT001 untuk pesanan yang dilakukan kepada PT.Kain Katun. </p><p>Konveksi Baju baru membayarkan tagihan PI004 pada tanggal 22 Oktober 2018 sebesar Rp 37.500.000 secara tunai kepada PT.Kain Katun. Konveksi Baju Baru mencatat pembayaran atas tagihan tersebut ID Pembayaran CD003 </li><li>Petugas pembelian setiap akhir bulan (31 Oktober) melakukan pengecekan Laporan pembelian pada bulan tersebut berdasarkan produk yang dibeli.</li>
</li>
<br>



 <a class="btn btn-primary" href='<?php echo base_url("pembelian/pesanan"); ?>'">Berikutnya</a>

        </div>



    </div>