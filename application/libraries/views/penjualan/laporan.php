
<?php $this->load->view("penjualan/soal"); 
if($this->session->userdata("navigasi") == 1){
?>


<div class="progressContainer">
      <ul class="progressbar">
          <li class="active"><a href='<?php echo base_url("penjualan/pesanan"); ?>'>Pesanan Penjualan</a></li>
          <li class="active"><a href='<?php echo base_url("penjualan/pengiriman"); ?>'>Pengiriman Barang</a></li>
          <li class="active"><a href='<?php echo base_url("penjualan/penagihan"); ?>'>Kirim Tagihan</a></li>
          <li  class="active"><a href='<?php echo base_url("penjualan/pembayaran"); ?>'>Terima Pembayaran</a></li>
          <li class="active sekarang">Laporan Penjualan</li>
 	 </ul>
</div>
<?php } ?>

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-login">
            <h4>Laporan Penjualan</h4><hr>
            	<?php
	if($this->session->userdata("panduan") == 1){
?>
<ul>
<li><b>Group by</b> laporan penjualan disusun berdasarkan kategori</li>
<li><b>Dari dan Hingga</b> tanggal jangka waktu laporan</li>


</ul>
<?php 
}
?>
			<form class='form' method="post" action="?tipe=laporan">

<?php echo $this->M_Pesan->hasil(); ?>
				<table class='form'>				
				<tr>
					<td>
						Dari
					</td>
					<td>
						<input name="dari"  required  class="tgl" type="text" max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>">
					</td>
				</tr>				
				<tr>
					<td>
						Hingga
					</td>
					<td>
						<input name="sampai" required class="tgl" type="text" max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>">
					</td>
				</tr>
				<tr>
					<td>
						Order by 
					</td>
					<td>
						<select name="order">
							<option value="jenis">Nama Produk</option>
							<option value="jual">Jumlah terjual</option>
						</select>
					</td>
				</tr>				
				<tr>
					<td>
						Group by 
					</td>
					<td>
						<select name="group">
							<option value="produk">Produk</option>
							<option value="pembeli">Pembeli</option>
						</select>
					</td>
				</tr>
				</table>
				</br>
				<div class="wrapper">
					<span class="group-btn">     
						<input type="submit" value="Submit" class="btn btn-primary btn-md">
					</span>
				</div>
			</form>
            </div>
         </div>
        </div>