<?php $this->load->view("penjualan/soal"); ?>


<div id="createPesanan" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Pesanan</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form">		
	<tr>
			<td>ID</td>
			<td><input type="text" name="id" value="<?php echo $id ?>" readonly required pattern="[a-zA-Z0-9]+"></td>
		</tr>
		<tr>
			<td>Pemesan</td>
			<td><select name="pemesan" required><option value="" diabled>Silahkan Pilih</option><?php foreach($pembeli as $p){echo "<option value=\"$p->kontak_id\">$p->kontak_nama</option>";} ?></select></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input class="tgl" type="text" name="tanggal" required"></td>
		</tr>	
		<tr>
			<td>Term</td>
			<td><select name="term"><option value='fob_shipping_point'>FOB Shipping Point</option><option value='fob_destination_point'>FOB Destination Point</option></select></td>
		</tr>		
		<tr>
			<td>DP</td>
			<td><input type="number" name="dp" min=0 value=0></select></td>
		</tr>
	 </table>
	 <br><br>
	 <div class="table-responsive">
		<table class='form detail'>
			<thead>
			  <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
			 </thead>
			 <tbody>
					 <tr> 
					 	<td>
					 		<select required class='long barang' name="namabarang[]" placeholder="nama Produk" required>
					 		</select>
					 	</td>
					 	<td>
					 		<input  class='short jumlah changeble' type="number" min=1 max=1000 value=1 name='jumlah[]'>
					 	</td>
					 	<td>
					 		<input  class='harga' type="number" min=0 disabled value=0>
					 	</td>
					 	<td>
					 		<input  class='subtotal' type="number" min=0 disabled value=0>
					 	</td>
					 </tr>
				</tbody>
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


<div id="editPesanan" class="modal fade areaprint" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen Pesanan</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form"">		
	<tr>
			<td>ID</td>
			<td><input type="text" disabled name="id" required pattern="[a-zA-Z0-9]+" value="<?php echo $id ?>"></td>
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
			<td>DP</td>
			<td><input type="number" disabled name="dp" min=0 value=0></select></td>
		</tr>
	 </table>
	 <br><br>
	 <div class="table-responsive">
		<table class='form detail editdetail'>
			<thead>
			  <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
			 </thead>
			 <tbody>
					 <tr> 
					 	<td>
					 		<select required class='long barang' name="namabarang[]" placeholder="nama Produk" required>
					 		</select>
					 	</td>
					 	<td>
					 		<input  class='short jumlah' type="number" min=1 max=1000 value=1 name='jumlah[]'>
					 	</td>
					 	<td>
					 		<input  class='harga' type="number" min=0 disabled value=0>
					 	</td>
					 	<td>
					 		<input  class='subtotal' type="number" min=0 disabled value=0>
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
          <li class="active sekarang">Pesanan Penjualan</li>
          <li><a href='<?php echo base_url("penjualan/pengiriman"); ?>'>Pengiriman Barang</a></li>
          <li><a href='<?php echo base_url("penjualan/penagihan"); ?>'>Kirim Tagihan</a></li>
          <li><a href='<?php echo base_url("penjualan/pembayaran"); ?>'>Terima Pembayaran</a></li>
          <li><a href='<?php echo base_url("penjualan/laporan"); ?>'>Laporan Penjualan</a></li>
 	 </ul>
</div>
<?php } ?>
<div class="dokumen">
<div class="well ">
	<h3>Fungsi Pesanan</h3>
	<p>Fitur ini digunakan untuk mengelola pesanan pembelian dari pelanggan.</p>
		<?php 
if($this->session->userdata("panduan") == 1){
?>
<ul>
<li>nama pelanggan dipilih dari database yang telah disediakan</li>
<li>tanggal pemesanan sesuai tanggal menerima pesanan pelanggan </li>
<li>term pengiriman pilih antara FOB shipping point(biaya pengiriman di tanggung pembeli)/FOB destination point(biaya pengiriman di tanggung penjual)</li>
<li>nama barang pilih dari list yang telah disediakan, jika benar dipilih akan muncul harga per unit barang </li>
<li>jumlah barang disesuaikan dengan jumlah yang dipesan oleh pembeli</li>
</ul>
<?php 
}
?>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPesanan">+ Add Pesanan</button>
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
			<th>DP</th>
			<th>Status</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tbody>
		<?php foreach($pesanan as $p){
			echo "<tr>";
			echo "<td>$p->pesanan_id</td>";
			echo "<td>$p->kontak_id - $p->kontak_nama</td>";
			echo "<td>$p->pesanan_tanggal</td>";
			echo $p->pesanan_term=="fob_shipping_point" ? "<td>FOB Shipping Point</td>" : "<td>FOB Destination Point</td>";
			echo "<td>$p->pesanan_dp</td>";
			switch($p->pesanan_status){
				case "0":
					echo "<td>Belum Diproses</td>";
				break;
				case "1":
					echo "<td>Sudah Diproses</td>";
				break;
			}
			echo "<td>";
			echo "<a href='#' data-id='$p->pesanan_id' data-toggle='modal' data-target='#editPesanan' class='editButton btn btn-default glyphicon glyphicon-eye-open'></a>";
			echo " <a href='".base_url()."penjualan/pesanan/?tipe=delete&id=$p->pesanan_id' onclick=\"return confirm('Anda yakin?')\" class='btn btn-default glyphicon glyphicon-trash'></a>
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
            url: "<?php echo base_url(); ?>penjualan/pesanan_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editPesanan')
                .find('[name="id"]').val(response.pesanan_id).end()
                .find('[name="pemesan"]').val(response.kontak_id).end()
                .find('[name="term"]').val(response.pesanan_term).end()
				.find('[name="tanggal"]').val(response.pesanan_tanggal).end()
                .find('[name="dp"]').val(response.pesanan_dp).end();
			}
		});//end ajax header

   		 //request
   		$(".editdetail").empty();

   		var judul = $("<tr>");
   		judul.append ($("<th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>"))
   		judul.append ($("</tr>"))

   		$(".editdetail").append(judul);

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
		      	var harga = value.barispesanan_subtotal/value.barispesanan_jumlah;
		      	var subtotal = value.barispesanan_subtotal;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select disabled value='"+produk+"' class='long changeble barang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></select></td>"))
						 .append($("<td><input class='jumlah short changeble' disabled value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
						 .append($("<td><input class='harga' value='"+harga+"' disabled type='number' value=0 disabled></td>"))
						 .append($("<td><input class='subtotal' value='"+subtotal+"' disabled value=0 type='number' disabled></td>"))
					 .append($("</tr>"));

				$(".editdetail").append(akun);
				$('.editdetail > .barang').select2({data:data,readonly:true}).val(produk).trigger("change");
		      }) // each
		      //$(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit Pesanan
	
    $(document).on('change',".changeble",function() {
    	var ini=$(this).parent().parent();

    	var id=ini.find('[name="namabarang[]"]').val();
    	var jumlah=ini.find('[name="jumlah[]"]').val();


    	//ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>penjualan/pesanan_ajax_harga/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            if(response){
	            $(ini)
	                .find('.harga').val(response.barang_hargajual).end()
	                .find('.subtotal').val((response.barang_hargajual*jumlah)).end();
	            }else{
	             $(ini)
	                .find('.harga').val("0").end()
	                .find('.subtotal').val("0").end();
	            }
			}
		});//end ajax header

    });
}); //end document
</script>