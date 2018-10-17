<datalist id="barang">
<?php foreach($barang as $b){
	echo "<option value='$b->barang_id'>$b->barang_id - $b->barang_nama</option>";
}
?>
</datalist>


<div id="createKwitansi" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Tagihan</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form">		
	<tr>
			<td>ID</td>
			<td><input type="text" name="id" required pattern="[a-zA-Z0-9]+" readonly value="<?php echo $tid ?>"></td>
		</tr>	
		<tr>
			<td>No Resi Barang</td>
			<td><input type="text" class="resi" name="terima" required pattern="[a-zA-Z0-9]+"><a class="pilih btn btn-default" href='#'>Use</a></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input type="date" name="tanggal" required></td>
		</tr>				
		<tr>
			<td>Beban</td>
			<td><input type="number" name="beban" min=0 value=0></select></td>
		</tr>		
		<tr>
		<td>Term</td>
			<td><input type="text" name="term" readonly></select></td>
		</tr>
	 </table>
	 <br><br>
		<table class='form detail isidetail'>
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


<div id="editKwitansi" class="modal fade areaprint" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Kwitansi Pembelian</h4>
      </div>
	  <form method="post" action="?tipe=tambah">
		<div class="modal-body">
	<table class="form"">		
		<tr>
			<td>ID</td>
			<td><input type="text" name="id" required pattern="[a-zA-Z0-9]+"></td>
		</tr>	
		<tr>
			<td>No Penerimaan Barang</td>
			<td><input type="text" name="terima" required pattern="[a-zA-Z0-9]+"></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input type="date" name="tanggal" required max="<?php echo $this->session->userdata("periode_sampai") ?>" min="<?php echo $this->session->userdata("periode_dari") ?>" value="<?php echo date('Y-m-d'); ?>"></td>
		</tr>				
		<tr>
			<td>Beban</td>
			<td><input type="number" name="beban" min=0 value=0 readonly></select></td>
		</tr>		
		<tr>
			<td>Term</td>
			<td><input type="text" name="term" value="" required readonly></select></td>
		</tr>
	 </table>
	 <br><br>
		<table class='form detail editdetail'>
			<thead>
			  <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>
			 </thead>
			 <tbody>
					 <tr> 
					 	<td>
					 		<input required type="text" class='long' list="barang" autocomplete="off" name="namabarang[]" placeholder="nama Produk" required>
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
          <li class="active"><a href='<?php echo base_url("pembelian/pesanan"); ?>'>Pesanan Pembelian</a></li>
          <li class="active"><a href='<?php echo base_url("pembelian/penerimaan"); ?>'>Penerimaan Barang</a></li>
          <li class="sekarang active">Terima Tagihan</li>
          <li><a href='<?php echo base_url("pembelian/pembayaran"); ?>'>Bayar Tagihan</a></li>
          <li><a href='<?php echo base_url("pembelian/laporan"); ?>'>Laporan Pembelian</a></li>
 	 </ul>
</div>

<?php } ?>
<div class="dokumen">
<div class="well ">
	<h3>Fungsi Tagihan</h3>
	<p>Fitur ini digunakan untuk mengelola tagihan dari vendor.</p>

<?php 
if($this->session->userdata("panduan") == 1){
?>
<ul><li>nomor resi diketik sesuai tagihan atas resi, pillih use untuk menggunakan data yang terkait nomor resi</li>
<li>tanggal sesuai tanggal pada nota tagihan</li>
</ul>
<?php 
}
?>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createKwitansi">+ Add Kwitansi</button>
		</div>
	</div>


<br><br>
<?php if($this->session->flashdata('hasil')=="berhasil"){
	echo "<div class=\"alert alert-success\"><strong>Sukses!</strong> Operasi berhasil.</div>";
}
?>
<?php if($this->session->flashdata('hasil')=="gagal"){
	echo "<div class=\"alert alert-danger\"><strong>Gagal!</strong> Terdapat kesalahan, operasi gagal.</div>";
}
?>

<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No Tagihan</th>
			<th>No Resi Barang</th>
			<th>Tanggal</th>
			<th>B. Pengiriman</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<?php foreach($kwitansi as $p){
			echo "<tr>";
			echo "<td>$p->tagihan_id</td>";
			echo "<td>$p->terimabarang_id</td>";
			echo "<td>$p->tagihan_tanggal</td>";
			echo "<td>$p->terimabarang_beban</td>";
			echo "<td>
							<a href='#' data-id='$p->tagihan_id' data-toggle='modal' data-target='#editKwitansi' class='editButton btn btn-default glyphicon glyphicon-eye-open'>
							</a>
				</td>";
			echo "</tr>";
		}
	?>
	</tbody>
</table>

</div>
<script>
$(document).ready(function() {


    $('.pilih').on('click', function() {
        // tarik record
        var id = $(".resi").val();

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/penerimaan_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#createKwitansi')
                .find('[name="beban"]').val(response.terimabarang_beban).end()
				.find('[name="term"]').val(response.terimabarang_term).end()
			}
		});//end ajax header

   		 //request
   		$(".isidetail").empty();

   		var judul = $("<tr>");
   		judul.append ($("<th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>"))
   		judul.append ($("</tr>"))

   		$(".isidetail").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/penerimaan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.barang_id;
		      	var jumlah = value.baristerimabarang_jumlah;
		      	var harga = value.barang_hargajual;
		      	var subtotal = jumlah*harga;

		      	  var akun = $("<tr>");

				  akun.append($("<td><input readonly type='text' value='"+produk+"' list='barang' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></td>"))
						 .append($("<td><input readonly class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
						 .append($("<td><input class='harga' value='"+harga+"' type='number' value=0 disabled></td>"))
						 .append($("<td><input class='subtotal' value='"+subtotal+"' value=0 type='number' disabled></td>"))
					 .append($("</tr>"));

				$(".isidetail").append(akun);
		      }) // each
		    //  $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end detail Pesanan


	//ediit Pesanan
    $('.editButton').on('click', function() {
        // tarik record
        var id = $(this).attr('data-id');

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/tagihan_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editKwitansi')
                .find('[name="id"]').val(response.tagihan_id).end()
                .find('[name="terima"]').val(response.terimabarang_id).end()
                .find('[name="tanggal"]').val(response.tagihan_tanggal).end()
				.find('[name="beban"]').val(response.tagihan_beban).end()
				.find('[name="term"]').val(response.tagihan_term).end()
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
            url: "<?php echo base_url(); ?>pembelian/tagihan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.barang_id;
		      	var jumlah = value.baristagihan_jumlah;
		      	var harga = value.baristagihan_subtotal/value.baristagihan_jumlah;
		      	var subtotal = value.baristagihan_subtotal;

		      	  var akun = $("<tr>");

				  akun.append($("<td><input type='text' value='"+produk+"' list='barang' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></td>"))
						 .append($("<td><input class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
						 .append($("<td><input class='harga' value='"+harga+"' type='number' value=0 disabled></td>"))
						 .append($("<td><input class='subtotal' value='"+subtotal+"' value=0 type='number' disabled></td>"))
					 .append($("</tr>"));

				$(".editdetail").append(akun);
		      }) // each
		      $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit Pesanan
	
    $(document).on('change',".changeble",function() {
    	var ini=$(this).parent().parent();

    	var id=ini.find('[name="namabarang[]"]').val();
    	var jumlah=ini.find('[name="jumlah[]"]').val();


    	//ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/pesanan_ajax_harga/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            if(response){
	            $(ini)
	                .find('.harga').val(response.hjualbarang).end()
	                .find('.subtotal').val((response.hjualbarang*jumlah)).end();
	            }else{
	             $(ini)
	                .find('.harga').val("0").end()
	                .find('.subtotal').val("0").end();
	            }
			}
		});//end ajax header

    });

	//add keranjang dalam Pesanan
	$(document).on('click',".addkeranjang",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' list='barang' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></td>"))
		 .append($("<td><input class='jumlah short changeble' name='jumlah[]' type='number' value=1 min=1></td>")) 
		 .append($("<td><input class='harga' type='number' value=0 disabled></td>"))
		 .append($("<td><input class='subtotal' value=0 type='number' disabled></td>"))
	 .append($("</tr>"));
	 
	  $(this).parent().parent().before(row);

	  $("#daftar").scrollTop($("#daftar")[0].scrollHeight);
	  return false;
	})
}); //end document
</script>