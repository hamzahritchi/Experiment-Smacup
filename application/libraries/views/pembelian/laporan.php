
<?php $this->load->view("pembelian/soal"); ?>

<?php 
if($this->session->userdata("navigasi") == 1){
?>
<div class="progressContainer">
      <ul class="progressbar">
          <li class="active"><a href='<?php echo base_url("pembelian/pesanan"); ?>'>Pesanan Pembelian</a></li>
          <li  class="active"><a href='<?php echo base_url("pembelian/penerimaan"); ?>'>Penerimaan Barang</a></li>
          <li class="active"><a href='<?php echo base_url("pembelian/tagihan"); ?>'>Terima Tagihan</a></li>
          <li class="active"><a href='<?php echo base_url("pembelian/pembayaran"); ?>'>Bayar Tagihan</a></li>
          <li class="sekarang active">Laporan Pembelian</li>
 	 </ul>
</div>

<?php } ?>
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-login">
            <h4>Laporan Pembelian</h4><hr>
            <?php 
if($this->session->userdata("panduan") == 1){
?>
<ul>
	<li>
		Laporan penjualan disusun berdasarkan kategori.
	</li>
	<li>
		Jangka waktu laporan.
	</li>
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
						<input name="dari"  required  type="text" class="tgl">
					</td>
				</tr>				
				<tr>
					<td>
						Hingga
					</td>
					<td>
						<input name="sampai" required type="text" class="tgl">
					</td>
				</tr>
				<tr>
					<td>
						Order by 
					</td>
					<td>
						<select name="order">
							<option value="jenis">Nama Produk</option>
							<option value="jual">Jumlah Dibeli</option>
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
							<option value="penjual">Penjual</option>
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