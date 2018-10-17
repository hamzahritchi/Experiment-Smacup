<datalist id="barang">

<?php foreach($barang as $b){

	echo "<option value='$b->barang_id'>$b->barang_id - $b->barang_nama</option>";

}

?>

</datalist>



<?php $this->load->view("pembelian/soal"); ?>



<div id="createPesanan" class="modal fade" role="dialog">

 	<div class="modal-dialog fjurnal">

    <!-- Modal content-->

    <div class="modal-content fjurnal">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Soal</h4>         <p>

Tanggal 11 Oktober 2018, Konveksi Baju Baru melakukan pemesanan ke PT.Kain Katun sebanyak 500 meter kain katun motif batik. Harga untuk kain katun motif batik permeternya adalah Rp Rp 75.000 dan biaya pengiriman ditanggung oleh PT.Kain Katun selaku penjual. </p><hr>

        <h4 class="modal-title">Add Pesanan</h4>

      </div>

	  <form method="post" action="?tipe=tambah">

		<div class="modal-body">

	<table class="form"">		

	<tr>

			<td>ID</td>

			<td><input type="text" name="id" required pattern="[a-zA-Z0-9]+" readonly value="<?php echo $id ?>"></td>

		</tr>	

		<tr>

			<td>Vendor</td>

			<td><select name="vendor" required><option value="" diabled>Silahkan Pilih</option><?php foreach($pembeli as $p){echo "<option value=\"$p->kontak_id\">$p->kontak_nama</option>";} ?></select></td>

		</tr>

		<tr>

			<td>Tanggal</td>

			<td><input type="text" name="tanggal" required class="tgl" autocomplete="off"></td>

		</tr>	

		<tr>

			<td>Term</td>

			<td><select required name="term"><option value='fob_shipping_point'>FOB Ditanggung Pembeli</option><option value='fob_destination_point'>FOB Ditanggung Penjual</option></select></td>

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

					 		<select required class='long changeble barang' list="barang" name="namabarang[]" placeholder="nama Produk" required>

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

					 <tr>

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



<div id="editPesanan" class="modal fade" role="dialog">

 	<div class="modal-dialog fjurnal">

    <!-- Modal content-->

    <div class="modal-content fjurnal">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Soal</h4>         <p>

Tanggal 11 Oktober 2018, Konveksi Baju Baru melakukan pemesanan ke PT.Kain Katun sebanyak 500 meter kain katun motif batik. Harga untuk kain katun motif batik permeternya adalah Rp Rp 75.000 dan biaya pengiriman ditanggung oleh PT.Kain Katun selaku penjual. </p><hr>

        <h4 class="modal-title">Edit Pesanan</h4>

      </div>

	  <form method="post" action="?tipe=uodate">

		<div class="modal-body">

	<table class="form"">		

	<tr>

			<td>ID</td>

			<td><input type="text" name="id" required pattern="[a-zA-Z0-9]+" value="<?php echo $id ?>"></td>

		</tr>	

		<tr>

			<td>Vendor</td>

			<td><select name="vendor" required><option value="" disabled>Silahkan Pilih</option><?php foreach($pembeli as $p){echo "<option value=\"$p->kontak_id\">$p->kontak_nama</option>";} ?></select></td>

		</tr>

		<tr>

			<td>Tanggal</td>

			<td><input type="text" name="tanggal" required class="tgl" autocomplete="off"></td>

		</tr>	

		<tr>

			<td>Term</td>

			<td><select required name="term"><option value='fob_shipping_point'>FOB Ditanggung Pembeli</option><option value='fob_destination_point'>FOB Ditanggung Penjual</option></select></td>

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

					 		<select required class='long changeble barang' list="barang" name="namabarang[]" placeholder="nama Produk" required>

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

					 <tr>

					 </tr>

				</tbody>

		</table>

		</div>

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

          <li class="active sekarang">Pesanan Pembelian</li>

          <li><a href='<?php echo base_url("pembelian/penerimaan"); ?>'>Penerimaan Barang</a></li>

          <li><a href='<?php echo base_url("pembelian/tagihan"); ?>'>Terima Tagihan</a></li>

          <li><a href='<?php echo base_url("pembelian/pembayaran"); ?>'>Bayar Tagihan</a></li>

          <li><a href='<?php echo base_url("pembelian/laporan"); ?>'>Laporan Pembelian</a></li>

 	 </ul>

</div>

<?php } ?>

<div class="dokumen">

<div class="well ">

	<h3>Fungsi Pemesanan</h3>

	<p>Fitur ini digunakan untuk mengelola pesanan pembelian oleh usaha Anda.</p>

	<?php 

if($this->session->userdata("panduan") == 1){

?>

<ul>

<li>nama vendor dipilih dari database yang telah disediakan</li>

<li>tanggal pemesanan sesuai tanggal melakukan pesanan ke vendor </li>

<li>term pengiriman pilih antara FOB shipping point(biaya pengiriman di tanggung pembeli)/FOB destination point(biaya pengiriman di tanggung penjual)</li>

<li>nama barang pilih dari list yang telah disediakan, jika benar dipilih akan muncul harga per unit barang </li>

<li>jumlah barang disesuaikan dengan jumlah yang dipesan oleh perusahaan</li>

</ul>



<?php 

}

?>

</div>

	<div class="row">
<h3>Soal</h3>
<p>

		 Pada tanggal 10 Oktober 2018, Konveksi Baju Baru membatalkan pesanan pembelian kain ke PT.Kain Sutera dengan ID pembelian P005.  </p>
<br><br>
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

			<th>Status</th>

			<th>Conf</th>

		</tr>

	</thead>	

	<tbody>

		<?php foreach($pesanan as $p){

			echo "<tr>";

			echo "<td>$p->pesanbeli_id</td>";

			echo "<td>$p->kontak_id - $p->kontak_nama</td>";

			echo "<td>$p->pesanbeli_tanggal</td>";

			echo $p->pesanbeli_term=="fob_shipping_point" ? "<td>FOB Ditanggung Pembeli</td>" : "<td>FOB Ditanggung Penjual</td>";

			switch($p->pesanbeli_status){

				case "0":

					echo "<td>Belum Diproses</td>";

				break;

				case "1":

					echo "<td>Sudah Diproses</td>";

				break;

			}

			echo "<td>";
			if($p->pesanbeli_status ==0){

			echo "<a href='#' data-id='$p->pesanbeli_id' data-toggle='modal' data-target='#editPesanan' class='editButton btn btn-default glyphicon glyphicon-eye-open'>

							</a>";

		echo "<a href='".base_url()."pembelian/pesanan/?tipe=delete&id=$p->pesanbeli_id' class='btn btn-default glyphicon glyphicon-trash'>

							</a>";

						}

			echo "</td></tr>";

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

            url: "<?php echo base_url(); ?>pembelian/pesanan_ajax/" + id,

            method: 'GET',

			dataType: 'JSON',

			success: function(response) {

            // Populate the form fields with the data returned from server

            $('#editPesanan')

                .find('[name="id"]').val(response.pesanbeli_id).end()

                .find('[name="vendor"]').val(response.kontak_id).end()

                .find('[name="term"]').val(response.pesanbeli_term).end()

				.find('[name="tanggal"]').val(response.pesanbeli_tanggal).end()

                .find('form').attr("action","?tipe=update&id="+response.pesanbeli_id).end();

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

            url: "<?php echo base_url(); ?>pembelian/pesanan_detail_ajax/" + id,

            method: 'GET',

			dataType: 'JSON',

			success: function(response) {

            // Populate the form fields with the data returned from server

            

		      $.each(response, function(index, value){

		      //alert(value);

		      	var produk = value.barang_id;

		      	var jumlah = value.barispesanbeli_jumlah;

		      	var harga = value.barispesanbeli_subtotal/value.barispesanbeli_jumlah;

		      	var subtotal = value.barispesanbeli_subtotal;



		      	  var akun = $("<tr>");



				  akun.append($("<td><select class='long changeble barang' autocomplete='off' name='namabarang[]' placeholder='Nama Produk'></select></td>"))

						 .append($("<td><input class='jumlah short  changeble' value='"+jumlah+"' short' name='jumlah[]' type='number' value=1 min=1></td>")) 

						 .append($("<td><input class='harga' value='"+harga+"' type='number' value=0 disabled></td>"))

						 .append($("<td><input class='subtotal' value='"+subtotal+"' value=0 type='number' disabled></td>"))

					 .append($("</tr>"));



				$(".editdetail").append(akun);

				

				$('.editdetail .barang').select2({data:data}).val(produk).trigger("change");

		      }) // each

		     // $(".editdetail").append("<tr><td colspan=4><a href=\"#\" class=\"addkeranjang btn btn-default\">+</a> </td></tr>");

			}

		});//end ajax detail



	});//end edit Pesanan

	

    $(document).on('input change',".changeble",function() {

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