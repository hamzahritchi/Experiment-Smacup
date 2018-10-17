
<?php $this->load->view("pembelian/soal"); ?>

<div id="createPembayaran" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Soal</h4>
        <p>
Konveksi Baju baru membayarkan tagihan PI004 pada tanggal 22 Oktober 2018 sebesar Rp 37.500.000 secara tunai kepada PT.Kain Katun. Konveksi Baju Baru mencatat pembayaran atas tagihan tersebut ID Pembayaran CD003 </p><hr>
        <h4 class="modal-title">Add Pembayaran</h4>
      </div>
	  <form method="post" action="?tipe=tambah">	
	  <div class="modal-body">
		<table class="form">
			<thead>
			<tr><td>ID</td><td><input type="text"  name="id" required readonly pattern="[a-zA-Z0-9]+" value="<?php echo $tid ?>"></td></tr>
			<tr><td>Tanggal</td><td><input type="text" class="tgl" autocomplete="off" required name="tanggal"></td></tr>
			<tr><td>No tagihan</td><td><input type="text" name="tagihan" required autocomplete="off"></td></tr>
			<tr><td>Jumlah Bayar</td><td><input type="number" name="bayar" required></td></tr>
			<tr><td>Via</td><td><select name="via" required><option value="bank">Bank</option><option value="tunai">Tunai</option></select></td></tr>
			<tr><td>Keterangan</td><td><input type="text" name="ket"></td></tr>
			</thead>
		</table>	
      </div>
	  <br>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>

  </div>
</div>



<div id="editPembayaran" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Soal</h4>
        <p>
Konveksi Baju baru membayarkan tagihan PI004 pada tanggal 22 Oktober 2018 sebesar Rp 37.500.000 secara tunai kepada PT.Kain Katun. Konveksi Baju Baru mencatat pembayaran atas tagihan tersebut ID Pembayaran CD003</p><hr>
        <h4 class="modal-title">Edit Pembayaran</h4>
      </div>
	  <form method="post" action="?tipe=update">	
	  <div class="modal-body">
		<table class="form">
			<thead>
			<tr><td>ID</td><td><input type="text"  name="id" required readonly pattern="[a-zA-Z0-9]+" value="<?php echo $tid ?>"></td></tr>
			<tr><td>Tanggal</td><td><input type="text" class="tgl" autocomplete="off" required name="tanggal"></td></tr>
			<tr><td>No tagihan</td><td><input type="text" name="tagihan" required autocomplete="off"></td></tr>
			<tr><td>Jumlah Bayar</td><td><input type="number" name="bayar" required></td></tr>
			<tr><td>Via</td><td><select name="via" required><option value="bank">Bank</option><option value="tunai">Tunai</option></select></td></tr>
			<tr><td>Keterangan</td><td><input type="text" name="ket"></td></tr>
			</thead>
		</table>	
      </div>
	  <br>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Edit</button> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>

  </div>
</div>

<?php 
if($this->session->userdata("navigasi") == 1){
?>
<div class="progressContainer">
      <ul class="progressbar">
          <li class="active"><a href='<?php echo base_url("pembelian/pesanan"); ?>'>Pesanan Pembelian</a></li>
          <li class="active"><a href='<?php echo base_url("pembelian/penerimaan"); ?>'>Penerimaan Barang</a></li>
          <li class="active"><a href='<?php echo base_url("pembelian/tagihan"); ?>'>Terima Tagihan</a></li>
          <li class="sekarang active">Bayar Tagihan</li>
          <li><a href='<?php echo base_url("pembelian/laporan"); ?>'>Laporan Pembelian</a></li>
 	 </ul>
</div>

<?php } ?>
<div class="dokumen">

	<div class="well ">
	<h3>Fungsi Pembayaran</h3>
	<p>Fitur ini digunakan untuk mencatat pembayaran dari pelanggan.</p>
	<?php 
if($this->session->userdata("panduan") == 1){
?>
<ul>
<li>tanggal bayar sesuai tanggal pembayar tagihan dilakukan</li>
<li>nomor tagihan sesuai dengan nomor nota tagihan yang di bayar</li>
<li>jumlah bayar nominal yang dibayarkan oleh perusahaan kepada vendor</li>
<li>via pembayaran dilakukan melalui bank/tunai</li>
</ul>
<?php 
}
?>
	</div>

	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPembayaran">+ Add Pembayaran</button>
		</div>
	</div>
	<br><br>
<?php echo $this->M_Pesan->hasil(); ?>

	 <div class="table-responsive">
<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No Pembayaran</th>
			<th>Tanggal</th>
			<th>No Tagihan</th>
			<th>Jumlah Bayar</th>
			<th>Via</th>
			<th>Keterangan</th>
			<th>Conf</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach($bayar as $b){
			echo "<tr>";
				echo "<td>$b->pembtagihan_id</td>";
				echo "<td>$b->pembtagihan_tanggal</td>";
				echo "<td>$b->tagihan_id</td>";
				echo "<td>$b->pembtagihan_jumlah</td>";
				echo "<td>$b->pembtagihan_via</td>";
				echo "<td>$b->pembtagihan_ket</td>";
				echo "<td>
							<a href='#' data-id='$b->pembtagihan_id' data-toggle='modal' data-target='#editPembayaran' class='editButton btn btn-default glyphicon glyphicon-eye-open'>
							</a>
					</td>";
			echo "</tr>";
		}
	 ?>
	</tbody>
</table>
</div>
</div>
<script>
$(document).ready(function() {
	//ediit Pembayaran
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/pembayaran_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editPembayaran')
                .find('[name="id"]').val(response.pembtagihan_id).end()
                .find('[name="tanggal"]').val(response.pembtagihan_tanggal).end()
                .find('[name="tagihan"]').val(response.tagihan_id).end()
                .find('[name="bayar"]').val(response.pembtagihan_jumlah).end()
				.find('[name="via"]').val(response.pembtagihan_via).end()
                .find('[name="ket"]').val(response.pembtagihan_ket).end()
                .find('form').attr("action","?tipe=update&id="+response.pembtagihan_id).end();
			}
		});//end ajax header
	});//end edit Pembayaran
	


	//add akun dalam Pembayaran
	$(document).on('click',".addakun",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' list='produk' class='namaakun' autocomplete='off' name='namaakun[]' placeholder='Nama Produk'></td>"))
		 .append($("<td><input name='debit[]' type='number' value=1 min=1 max=1000></td>")) 
		 .append($("<td><input name='debit[]' type='number' value=0  ></td>"))
		 .append($("<td><input value=0 name='kredit[]' type='number' disabled></td>"))
	 .append($("</tr>"));
	 
	  $(this).before(row);

	  $("#daftar").scrollTop($("#daftar")[0].scrollHeight);
	  return false;
	})
}); //end document
</script>