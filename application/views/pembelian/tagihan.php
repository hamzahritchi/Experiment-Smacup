
<?php $this->load->view("pembelian/soal"); ?>
<div id="createKwitansi" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Soal</h4>
        <p>

 15 Oktober 2018, Konveksi Baju Baru menerima nota tagihan dengan nomor tagihan PI004 atas resi pengiriman JKT001 untuk pesanan yang dilakukan kepada PT.Kain Katun. </p><hr>
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
			<td><input type="text" class="resi" name="terima" autocomplete="off" required pattern="[a-zA-Z0-9]+"><a class="pilih btn btn-default" href='#'>Use</a></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input type="text" name="tanggal" required  class="tgl" autocomplete="off"></td>
		</tr>				
		<tr>
			<td>Beban</td>
			<td><input type="number" name="beban" min=0 value=0></td>
		</tr>		
		<tr>
		<td>Term</td>
			<td><select name="term" readonly><option value='fob_shipping_point'>FOB Ditanggung Pembeli</option><option value='fob_destination_point'>FOB Ditanggung Penjual</option></select></td>
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


<div id="editKwitansi" class="modal fade" role="dialog">
 	<div class="modal-dialog fjurnal">
    <!-- Modal content-->
    <div class="modal-content fjurnal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Soal</h4>
        <p>

 15 Oktober 2018, Konveksi Baju Baru menerima nota tagihan dengan nomor tagihan PI004 atas resi pengiriman JKT001 untuk pesanan yang dilakukan kepada PT.Kain Katun. </p><hr>
        <h4 class="modal-title">Edit Tagihan</h4>
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
			<td><input type="text" class="resi" name="terima" autocomplete="off" required pattern="[a-zA-Z0-9]+"><a class="pilih btn btn-default" href='#'>Use</a></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td><input type="text" name="tanggal" required  class="tgl" autocomplete="off"></td>
		</tr>				
		<tr>
			<td>Beban</td>
			<td><input type="number" name="beban" min=0 value=0></td>
		</tr>		
		<tr>
		<td>Term</td>
			<td><select name="term" readonly><option value='fob_shipping_point'>FOB Ditanggung Pembeli</option><option value='fob_destination_point'>FOB Ditanggung Penjual</option></select></td>
		</tr>
	 </table>
	 <br><br>
		<table class='form detail editdetail'>
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

<?php echo $this->M_Pesan->hasil(); ?>


<table class='table' id="ajaxtable">
	<thead>
		<tr>
			<th>No Tagihan</th>
			<th>No Resi Barang</th>
			<th>Tanggal</th>
			<th>Term</th>
			<th>Status</th>
			<th>Conf</th>
		</tr>
	</thead>	
	<tobdy>
		<?php foreach($kwitansi as $p){
			echo "<tr>";
			echo "<td>$p->tagihan_id</td>";
			echo "<td>$p->terimabarang_id</td>";
			echo "<td>$p->tagihan_tanggal</td>";
			echo $p->tagihan_term=="fob_shipping_point" ? "<td>FOB Ditanggung Pembeli</td>" : "<td>FOB Ditanggung Penjual</td>";
			echo $p->tagihan_status=="1" ? "<td>Sudah Diproses</td>" : "<td>Belum Diproses</td>";
			echo "<td>";
			if($p->tagihan_status == 0)
				echo "
							<a href='#' data-id='$p->tagihan_id' data-toggle='modal' data-target='#editKwitansi' class='editButton btn btn-default glyphicon glyphicon-eye-open'>
							</a>
				";
			echo "</td></tr>";
		}
	?>
	</tbody>
</table>

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


    $('#createKwitansi .pilih').on('click', function() {
        // tarik record
        var id = $("#createKwitansi .resi").val();

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

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/penerimaan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
		   		$(".isidetail").empty();

		   		var judul = $("<tr>");
		   		judul.append ($("<th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>"))
		   		judul.append ($("</tr>"))

		   		$(".isidetail").append(judul);
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.barang_id;
		      	var jumlah = value.baristerimabarang_jumlah;
		      	var harga = value.barang_hargajual;
		      	var subtotal = jumlah*harga;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select readonly value='"+produk+"' list='barang' class='long changeble barang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></select></td>"))
						 .append($("<td><input readonly class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
						 .append($("<td><input class='harga' value='"+harga+"' type='number' value=0 disabled></td>"))
						 .append($("<td><input class='subtotal' value='"+subtotal+"' value=0 type='number' disabled></td>"))
					 .append($("</tr>"));

				$(".isidetail").append(akun);
				$('#createKwitansi .barang').select2({data:data}).val(produk).trigger("change");
		      }) // each
		    //  $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");
			}
		});//end ajax detail

	});//end detail Pesanan



    $('#editKwitansi .pilih').on('click', function() {
        // tarik record
        var id = $("#editKwitansi .resi").val();

        //ajax header
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/penerimaan_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
            $('#editKwitansi')
                .find('[name="beban"]').val(response.terimabarang_beban).end()
				.find('[name="term"]').val(response.terimabarang_term).end()
			}
		});//end ajax header

   		 //request

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/penerimaan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
            // Populate the form fields with the data returned from server
		   		$(".editdetail").empty();

		   		var judul = $("<tr>");
		   		judul.append ($("<th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>"))
		   		judul.append ($("</tr>"))

		   		$(".editdetail").append(judul);
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.barang_id;
		      	var jumlah = value.baristerimabarang_jumlah;
		      	var harga = value.barang_hargajual;
		      	var subtotal = jumlah*harga;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select readonly value='"+produk+"' list='barang' class='long changeble barang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></select></td>"))
						 .append($("<td><input readonly class='jumlah short changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
						 .append($("<td><input class='harga' value='"+harga+"' type='number' value=0 disabled></td>"))
						 .append($("<td><input class='subtotal' value='"+subtotal+"' value=0 type='number' disabled></td>"))
					 .append($("</tr>"));

				$(".editdetail").append(akun);
				$('#editKwitansi .barang').select2({data:data}).val(produk).trigger("change");
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
                .find('form').attr("action","?tipe=update&id="+response.tagihan_id).end()
			}
		});//end ajax header

   		 //request

        //ajax detail
        $.ajax({
            url: "<?php echo base_url(); ?>pembelian/tagihan_detail_ajax/" + id,
            method: 'GET',
			dataType: 'JSON',
			success: function(response) {
		   		$(".editdetail").empty();

		   		var judul = $("<tr>");
		   		judul.append ($("<th>Produk</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th>"))
		   		judul.append ($("</tr>"))

		   		$(".editdetail").append(judul);
            // Populate the form fields with the data returned from server
            
		      $.each(response, function(index, value){
		      //alert(value);
		      	var produk = value.barang_id;
		      	var jumlah = value.baristagihan_jumlah;
		      	var harga = value.baristagihan_subtotal/value.baristagihan_jumlah;
		      	var subtotal = value.baristagihan_subtotal;

		      	  var akun = $("<tr>");

				  akun.append($("<td><select readonly value='"+produk+"' list='barang' class='long changeble barang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></select></td>"))
						 .append($("<td><input class='jumlah short changeble' readonly value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 
						 .append($("<td><input class='harga' disabled value='"+harga+"' type='number' value=0 disabled></td>"))
						 .append($("<td><input class='subtotal' disabled  value='"+subtotal+"' value=0 type='number' disabled></td>"))
					 .append($("</tr>"));

				$(".editdetail").append(akun);
				$('.barang').select2({data:data}).val(produk).trigger("change");
		      }) // each
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