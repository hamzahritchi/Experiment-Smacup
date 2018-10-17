<datalist id="barang">
<?php foreach($barang as $b){
	echo "<option value='$b->barang_id'>$b->barang_id - $b->barang_nama</option>";
}
?>
</datalist>

<?php $this->load->view("pembelian/soal"); ?>

<div id="createPengiriman" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Penerimaan Barang</h4>
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
			<td><select name="pesanan" class="pesanan" required><option disabled selected>Silahkan Pilih</option><?php foreach($pesanan as $p){echo "<option value='$p->pesanbeli_id'>$p->pesanbeli_id</option>";}?></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input type="text" name="tanggal" required class="tgl"></td>
		</tr>
		<tr>
			<td>Biaya</td>
			<td><input type="number" name="biaya" required></td>
		</tr>
	 </table>
	 <br><br>
	 <div class="table-responsive">
		<table class='form detail isidetail'>
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


<div id="editPenerimaan" class="modal fade areaprint" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header fjurnal">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dokumen Penerimaan Barang</h4>
      </div>
	  <form method="post" action="?tipe=update">
		<div class="modal-body">
	<table class="form"">		
	<tr>
			<td>No Resi</td>
			<td><input type="text" disabled name="id" required pattern="[a-zA-Z0-9]+"></td>
		</tr>		
		<tr>
			<td>ID Pesanan</td>
			<td><input type="text" disabled name="pesanan" required pattern="[a-zA-Z0-9]+"> </td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input type="text" disabled name="tanggal" required  class="tgl"></td>
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
          <li class="active"><a href='<?php echo base_url("pembelian/pesanan"); ?>'>Pesanan Pembelian</a></li>
          <li  class="sekarang active">Penerimaan Barang</li>
          <li><a href='<?php echo base_url("pembelian/tagihan"); ?>'>Terima Tagihan</a></li>
          <li><a href='<?php echo base_url("pembelian/pembayaran"); ?>'>Bayar Tagihan</a></li>
          <li><a href='<?php echo base_url("pembelian/laporan"); ?>'>Laporan Pembelian</a></li>
 	 </ul>
</div>

<?php } ?>
<div class="dokumen">
<div class="well ">
	<h3>Fungsi Penerimaan Barang</h3>
	<p>Fitur ini digunakan untuk mencatat penerimaan barang yang dipesan dari vendor.</p>
	<?php 
if($this->session->userdata("panduan") == 1){
?>
<ul>
<li>nomor resi disesuaikan dengan resi penerimaan</li>
<li>ID pesanan pilih dari list yang tersedia berdasarkan nomor pesanan pada kasus</li>
<li>tanggal penerimaan sesuai dengan waktu penerimaan barang</li>
<li>biaya pengiriman sesuai biaya untuk sekali pengiriman</li>
<li>jumlah yang dikirim total barang yang di pesan</li>
</ul>
<?php 
}
?>
</div>
	<div class="row">
		<div class="col-sm-3 col-xs-3">
			<button style="font-size:14px;padding:5px 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPengiriman">+ Add Penerimaan</button>
		</div>
	</div>


<br><br>

<?php echo $this->M_Pesan->hasil(); ?>


	 <div class="table-responsive">
<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>ID</th>
			<th>No Pesanan</th>
			<th>Vendor</th>
			<th>Tanggal</th>
			<th>Term</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<?php foreach($terima as $p){
			echo "<tr>";
			echo "<td>$p->terimabarang_id</td>";
			echo "<td>$p->pesanbeli_id</td>";
			echo "<td>$p->kontak_id - $p->kontak_nama</td>";
			echo "<td>$p->terimabarang_tanggal</td>";
			echo "<td>$p->terimabarang_term</td>";
			echo "<td>
							<a href='#' data-id='$p->terimabarang_id' data-toggle='modal' data-target='#editPenerimaan' class='editButton btn btn-default glyphicon glyphicon-eye-open'>
							</a>
				</td>";
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


    $('.pesanan').on('change', function() {
        // tarik record
        var id = $(".pesanan").val();

   		 //request
   		$(".isidetail").empty();

   		var judul = $("<tr>");
   		judul.append ($("<th>Produk</th><th>Jumlah</th>"))
   		judul.append ($("</tr>"))

   		$(".isidetail").append(judul);

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/pesanan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.barang_id;
		      	var jumlah = value.barispesanbeli_jumlah;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select readonly value='"+produk+"' list='barang' class='long changeble barang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></select></td>"))
						 .append($("<td><input readonly class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
			 .append($("</tr>"));

				$(".isidetail").append(akun);
				$('.barang').select2({data:data}).val(produk).trigger("change");
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
            url: "<?php echo base_url(); ?>pembelian/penerimaan_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editPenerimaan')
                .find('[name="id"]').val(response.terimabarang_id).end()
                .find('[name="pesanan"]').val(response.pesanbeli_id).end()
				.find('[name="tanggal"]').val(response.terimabarang_tanggal).end()
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
            url: "<?php echo base_url(); ?>pembelian/penerimaan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.barang_id;
		      	var jumlah = value.baristerimabarang_jumlah;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select readonly value='"+produk+"' list='barang' class='long changeble barang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></select></td>"))
						 .append($("<td><input disabled class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
			 .append($("</tr>"));

				$(".editdetail").append(akun);
				
				$('.barang').select2({data:data}).val(produk).trigger("change");
		      }) // each
		    //  $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end edit Pesanan

	//add keranjang dalam Pesanan
	$(document).on('click',".addkeranjang",function() {
	  var row = $("<tr>");

	  row.append($("<td><input type='text' list='barang' class='long changeble' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></td>"))
		 .append($("<td><input class='jumlah short changeble' name='jumlah[]' type='number' value=1 min=1></td>")) 
	 .append($("</tr>"));
	 
	  $(this).parent().parent().before(row);

	  $("#daftar").scrollTop($("#daftar")[0].scrollHeight);
	  return false;
	})
}); //end document
</script>