<?php

if($this->session->userdata("navigasi") == 1){

?>

<div class="progressContainer">

      <ul class="progressbar">

          <li class="active"><a href='<?php echo base_url("penjualan/pesanan"); ?>'>Pesanan Penjualan</a></li>

          <li class="active"><a href='<?php echo base_url("penjualan/pengiriman"); ?>'>Pengiriman Barang</a></li>

          <li class="active"><a href='<?php echo base_url("penjualan/pengiriman"); ?>'>Kirim Tagihan</a></li>

          <li  class="active sekarang">Terima Pembayaran</li>

          <li><a href='<?php echo base_url("penjualan/laporan"); ?>'>Laporan Penjualan</a></li>

 	 </ul>

</div>

<?php } ?>



<?php $this->load->view("penjualan/soal"); ?>

<div id="createPembayaran" class="modal fade" role="dialog">

 	<div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button><p>

Tuan Andy membayarkan tagihan SI003 pada tanggal 15 September 2018 sebesar Rp 25.250.000 melalui transfer bank. Konveksi Baju Baru mencatat pembayaran Tuan Andy dengan ID Pembayaran CR002 .</p><hr>

        <h4 class="modal-title">Add Pembayaran</h4>

      </div>

	  <form method="post" action="?tipe=tambah">	

	  <div class="modal-body">

		<table class="form">

			<thead>

			<tr><td>ID</td><td><input type="text" readonly name="id" value="<?php echo $id ?>" required pattern="[a-zA-Z0-9]+"></td></tr>

			<tr><td>Tanggal</td><td><input class="tgl" type="text" name="tanggal" autocomplete="off"></td></tr>

			<tr><td>No Kwitansi</td><td><input type="text" required name="kwitansi" autocomplete="off"></td></tr>

			<tr><td>Jumlah Bayar</td><td><input type="number" name="bayar"></td></tr>

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

 	<div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header"><p>

Tuan Andy membayarkan tagihan SI003 pada tanggal 15 September 2018 sebesar Rp 25.250.000 melalui transfer bank. Konveksi Baju Baru mencatat pembayaran Tuan Andy dengan ID Pembayaran CR002 .</p><hr>

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Edit Pembayaran</h4>

      </div>

	  <form method="post" action="?tipe=update">	

	  <div class="modal-body">

		<table class="form">

			<thead>

			<tr><td>ID</td><td><input type="text" readonly name="id" value="<?php echo $id ?>" required pattern="[a-zA-Z0-9]+"></td></tr>

			<tr><td>Tanggal</td><td><input class="tgl" type="text" name="tanggal" autocomplete="off"></td></tr>

			<tr><td>No Kwitansi</td><td><input type="text" required name="kwitansi" autocomplete="off"></td></tr>

			<tr><td>Jumlah Bayar</td><td><input type="number" name="bayar"></td></tr>

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





<div class="dokumen">



	<div class="well ">

	<h3>Fungsi Pembayaran</h3>

	<p>Fitur ini digunakan untuk mencatat pembayaran dari pelanggan.</p>

	<?php

	if($this->session->userdata("panduan") == 1){

?>

<ul>

<li>tanggal bayar sesuai tanggal pelanggan membayar tagihan</li>

<li>nomor tagihan sesuai dengan nomor nota tagihan yang di bayar</li>

<li>jumlah bayar nominal yang dibayarkan oleh pelanggan</li>

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

				echo "<td>$b->pembayaran_id</td>";

				echo "<td>$b->pembayaran_tanggal</td>";

				echo "<td>$b->kwitansi_id</td>";

				echo "<td>$b->pembayaran_jumlah</td>";

				echo "<td>$b->pembayaran_via</td>";

				echo "<td>$b->pembayaran_jumlah</td>";

				echo "<td>";

				echo  "<a href='#' data-id='$b->pembayaran_id' data-toggle='modal' data-target='#editPembayaran' class='editButton btn btn-default glyphicon glyphicon-eye-open'></a>

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

            url: "<?php echo base_url(); ?>penjualan/pembayaran_ajax/" + id,

            method: 'GET',

			dataType: 'JSON',

			success: function(response) {

            // Populate the form fields with the data returned from server

            $('#editPembayaran')

                .find('[name="id"]').val(response.pembayaran_id).end()

                .find('[name="tanggal"]').val(response.pembayaran_tanggal).end()

                .find('[name="kwitansi"]').val(response.kwitansi_id).end()

                .find('[name="bayar"]').val(response.pembayaran_jumlah).end()

				.find('[name="via"]').val(response.pembayaran_via).end()

                .find('[name="ket"]').val(response.pembayaran_ket).end()

                .find('form').attr("action","?tipe=update&id="+response.pembayaran_id).end();

			}

		});//end ajax header

	});//end edit Pembayaran

}); //end document

</script>