<?php $this->load->view("penjualan/soal"); ?>


<?php $this->load->view("penjualan/soal"); ?>
<div id="createPengiriman" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Pengiriman</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form"">		
		<tr>
			<td>No Resi</td>
			<td><input type="text" name="id" required pattern="[a-zA-Z0-9]+" autocomplete="off"></td>
		</tr>		
		<tr>
			<td>ID Pesanan</td>
			<td><select class="pesanan" name="pesanan" required><option selected disabled>Silahkan pilih</option>
				<?php
					foreach($pesanan as $s){
						echo "<option value='$s->pesanan_id'>$s->pesanan_id</option>";
					} 
				?>
			</select> <!-- <button class="btn btn-default get-pesanan">Get</button></td> -->
		</tr>
		<tr>
			<td>Pemesan</td>
			<td><select  name="pemesan" required><option value="" disabled selected>Silahkan Pilih</option><?php foreach($pembeli as $p){echo "<option value=\"$p->kontak_id\">$p->kontak_nama</option>";} ?></select></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input class="tgl" type="text" name="tanggal" required></td>
		</tr>	
		<tr>
			<td>Term</td>
			<td><select name="term"><option value='fob_shipping_point'>FOB Shipping Point</option><option value='fob_destination_point'>FOB Destination Point</option></select></td>
		</tr>		
		<tr>
			<td>Biaya Pengiriman</td>
			<td><input type="number" name="biaya" min=0 value=0></select></td>
		</tr>
	 </table>
	 <br><br>

	 <div class="table-responsive">
		<table class='detail isidetail'>
		</table>
		</div>
      </div>
	  <br>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>

  </div>
</div>


<div id="editPengiriman" class="modal fade areaprint" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen Pengiriman</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form"">		
	<tr>
			<td>No Resi</td>
			<td><input type="text" disabled name="id" required pattern="[a-zA-Z0-9]+"></td>
		</tr>		
		<tr>
			<td>ID Pesanan</td>
			<td><input type="text" disabled name="pesanan" required pattern="[a-zA-Z0-9]+"></td>
		</tr>
		<tr>
			<td>Pemesan</td>
			<td><select name="pemesan" disabled required><option value="" diabled>Silahkan Pilih</option><?php foreach($pembeli as $p){echo "<option value=\"$p->kontak_id\">$p->kontak_nama</option>";} ?></select></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input class="tgl" disabled type="text" name="tanggal" required></td>
		</tr>	
		<tr>
			<td>Term</td>
			<td><select name="term" disabled><option value='fob_shipping_point'>FOB Shipping Point</option><option value='fob_destination_point'>FOB Destination Point</option></select></td>
		</tr>		
		<tr>
			<td>Biaya Pengiriman</td>
			<td><input disabled type="number" name="biaya" min=0 value=0></select></td>
		</tr>
		<tr>
			<td>Status Pengiriman Pengiriman</td>
			<td><input disabled type="number" name="biaya" min=0 value=0></select></td>
		</tr>
	 </table>
	 <br><br>

	 <div class="table-responsive">
		<table class='form detail editdetail'>
			<thead>
			  <tr><th>Produk</th><th>Jumlah</th></tr>
			 </thead>
			 <tbody>
					 <tr> 
					 	<td>
					 		<input required type="text" class='long' list="barang" autocomplete="off" name="namabarang[]" placeholder="nama Produk" required>
					 	</td>
					 	<td>
					 		<input  class='short jumlah' type="number" min=1 max=1000 value=1 name='jumlah[]'>
					 	</td>
					 </tr>
				</tbody>
		</table>
		</div>
      </div>
	  <br>
	  </form>
    </div>

  </div>
</div>
<?php
if($this->session->userdata("navigasi") == 1){
?>
<div class="progressContainer">
      <ul class="progressbar">
          <li class="active"><a href='<?php echo base_url("penjualan/pesanan"); ?>'>Pesanan Penjualan</a></li>
          <li class="active sekarang">Pengiriman Barang</li>
          <li><a href='<?php echo base_url("penjualan/penagihan"); ?>'>Kirim Tagihan</a></li>
          <li><a href='<?php echo base_url("penjualan/pembayaran"); ?>'>Terima Pembayaran</a></li>
          <li><a href='<?php echo base_url("penjualan/laporan"); ?>'>Laporan Penjualan</a></li>
 	 </ul>
</div>
<?php } ?>
<div class="dokumen">
<div class="well ">
	<h3>Fungsi Pengiriman</h3>
	<p>Fitur ini digunakan untuk mengelola pengiriman barang kepada pelanggan.</p>
<?php
	if($this->session->userdata("panduan") == 1){
?>
<ul>
<li>nomor resi disesuaikan dengan resi pengiriman</li>
<li>ID pesanan pilih dari list yang tersedia berdasarkan nomor pesanan pada kasus</li>
<li>tanggal pengiriman sesuai dengan waktu pengiriman barang</li>
<li>biaya pengiriman sesuai biaya untuk sekali pengiriman</li>
<li>jumlah yang dikirim total barang yang di pesan</li>

</ul>
<?php 
}
?>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPengiriman">+ Add Pengiriman</button>
		</div>
	</div>


<br><br>

<?php echo $this->M_Pesan->hasil(); ?>

	 <div class="table-responsive">
<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>ID</th>
			<th>Pemesan</th>
			<th>Tanggal</th>
			<th>Term</th>
			<th>Biaya</th>
			<th>Status</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<?php foreach($pengiriman as $p){
			echo "<tr>";
			echo "<td>$p->pengiriman_id</td>";
			echo "<td>$p->kontak_id - $p->kontak_nama</td>";
			echo "<td>$p->pengiriman_tanggal</td>";
			echo "<td>$p->pengiriman_term</td>";
			echo "<td>$p->pengiriman_beban</td>";
			switch($p->pengiriman_status){
				case "0":
					echo "<td>Belum Diproses</td>";
				break;
				case "1":
					echo "<td>Sudah Diproses</td>";
				break;
			}
			echo "<td>";
			echo "<a href='#' data-id='$p->pengiriman_id' data-toggle='modal' data-target='#editPengiriman' class='editButton btn btn-default glyphicon glyphicon-eye-open'></a>";

			echo "</tr>";
		}
	?>
	</tbody>
</table>
</tobdy>
</div>
<script>
$(document).ready(function() {
		var data = [
			<?php 
				foreach($barang as $b)
					{
						echo "{";
							echo "id:'$b->barang_id',";
							echo "text:'$b->barang_nama',";
						echo "},";
					}
					?>
				]
    $('.barang').select2({
		  data: data
		})


	//ediit Pesanan
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>penjualan/pengiriman_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editPengiriman')
                .find('[name="id"]').val(response.pengiriman_id).end()
                .find('[name="pesanan"]').val(response.pesanan_id).end()
                .find('[name="pemesan"]').val(response.kontak_id).end()
                .find('[name="term"]').val(response.pengiriman_term).end()
				.find('[name="tanggal"]').val(response.pengiriman_tanggal).end()
                .find('[name="biaya"]').val(response.pengiriman_biaya).end();
			}
		});//end ajax header

   		 //request
   		$(".editdetail").empty();

   		var judul = $("<tr>");
   		judul.append ($("<th>Produk</th><th>Jumlah</th>"))
   		judul.append ($("</tr>"))

   		$(".editdetail").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>penjualan/pengiriman_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.barang_id;
		      	var jumlah = value.barispengiriman_jumlah;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select disabled value='"+produk+"' list='barang' class='long changeble barang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></select></td>"))
						 .append($("<td><input disabled class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
			 .append($("</tr>"));

				$(".editdetail").append(akun);

				$('.barang').select2({data:data,readonly:true}).val(produk).trigger("change");
		      }) // each
		     // $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit Pesanan

	//add keranjang dalam Pesanan
	
    $('.pesanan').on('change', function() {
        // tarik record
        var id = $(".pesanan").val();
	     //ajax header
	        $.ajax({
	            url: "<?php echo base_url(); ?>penjualan/pesanan_ajax/" + id,
	            method: 'GET',
				dataType: 'JSON',
				success: function(response) {
	            // Populate the form fields with the data returned from server
	            $('#createPengiriman')
                	.find('option').removeAttr("disabled").end()
	                .find('[name="pemesan"]').val(response.kontak_id).end()
	                .find('[name="pemesan"] option:not(:selected)').attr('disabled','disabled').end()
					.find('[name="term"]').val(response.pesanan_term).end()
                	.find('[name="term"] option:not(:selected)').attr('disabled','disabled').end()
				}
			});//end ajax header
   		 //request
   		$(".isidetail").empty();

   		var judul = $("<tr>");
   		judul.append ($("<th>Produk</th><th>Jumlah</th>"))
   		judul.append ($("</tr>"))

   		$(".isidetail").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>penjualan/pesanan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.barang_id;
		      	var jumlah = value.barispesanan_jumlah;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select readonly value='"+produk+"' class='long changeble barang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></select></td>"))
						 .append($("<td><input readonly class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
			 .append($("</tr>"));

				$(".isidetail").append(akun);

				$('.barang').select2({data:data,readonly:true}).val(produk).trigger("change");
		      }) // each
		    //  $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});
	});//end detail Pesanan
</script>