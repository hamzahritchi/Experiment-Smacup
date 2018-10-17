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


<?php 
}
?>
			<form class='form' method="post" action="?tipe=laporan">
<?php 
if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong>Terdapat kesalahan, operasi gagal.</div>";
}
?>
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