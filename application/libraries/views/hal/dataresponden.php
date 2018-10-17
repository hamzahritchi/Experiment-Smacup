       <div class="row dokumen" style="text-align:justify;">

        <div class="col-sm-12">
<h1>Data Responden</h1>
<?php 
		$this->load->helper("cookie");
		set_cookie("cek_cookie",1,214748364);
		
		echo $this->M_Pesan->hasil(); ?>
<p>Jawablah setiap pertanyaan berikut ini setepat mungkin.</p>

		 <form method="post">
		  <div class="form-group">
		  	<b>Jenis Kelamin: </b>
		 <div class="radio">
			  <label><input type="radio" name="jeniskelamin" value="1" required>Pria</label>
			</div>
			<div class="radio">
			  <label><input type="radio" name="jeniskelamin" value="2" required>Wanita</label>
			</div>
		  </div>
		  <div class="form-group row">
		  	<div class="col-sm-2">
		    <label for="usia">Usia Anda:</label>
		    <input type="number" class="form-control" name="usia" min=18 max=75 required>
			</div>
		  </div>
		  <div class="form-group">
		  	<b>Pendidikan Terakhir: </b>
		 <div class="radio">
			  <label><input type="radio" name="pendidikan" value="1"  required>SD</label>
			</div>
			<div class="radio">
			  <label><input type="radio" name="pendidikan" value="2" required>SMP</label>
			</div>

			<div class="radio">
			  <label><input type="radio" name="pendidikan" value="3" required>SMA</label>
			</div>

			<div class="radio">
			  <label><input type="radio" name="pendidikan" value="4" required>Diploma</label>
			</div>

			<div class="radio">
			  <label><input type="radio" name="pendidikan" value="5" required>Sarjana</label>
			</div>

			<div class="radio">
			  <label><input type="radio" name="pendidikan" value="6" required>Pascasarjana</label>
			</div>
		  </div>
		   <div class="form-group">
		  	<b>Bidang Usaha: </b>
		 <div class="radio">
			  <label><input type="radio" class="usaha" name="usaha" value="1"  required>Makanan dan Minuman</label>
			</div>
			<div class="radio">
			  <label><input type="radio" class="usaha" name="usaha" value="2" required>Konveksi</label>
			</div>

			<div class="radio">
			  <label><input type="radio" class="usaha" name="usaha" value="3" required>Teknologi</label>
			</div>

			<div class="radio">
			  <label><input type="radio" class="usaha" name="usaha" value="4" required>Fashion</label>
			</div>

			<div class="radio">
			  <label><input type="radio" class="usaha" name="usaha" value="5" required>Alat Berat</label>
			</div>

			<div class="radio">
			  <label><input type="radio" class="usaha" name="usaha" value="6" required>Lainnya (sebutkan)</label> 
			</div>
		  </div>

		   <div class="form-group">
		  	<b>Besaran penghasilan selama 1 tahun: </b>
		 <div class="radio">
			  <label><input type="radio" name="penghasilan" value="1"  required>< Rp 50.000.000</label>
			</div>
			<div class="radio">
			  <label><input type="radio" name="penghasilan" value="2" required>Rp 50.000.000 – Rp 300.000.000</label>
			</div>

			<div class="radio">
			  <label><input type="radio" name="penghasilan" value="3" required>Rp 300.000.000 – Rp 1.000.000.000</label>
			</div>

			<div class="radio">
			  <label><input type="radio" name="penghasilan" value="4" required>> Rp 1.000.000.000</label>
			</div>

		  </div>

		  		   <div class="form-group">
		  	<b>Jumlah Karyawan: </b>
		 <div class="radio">
			  <label><input type="radio" name="karyawan" value="1" required>< 10 Orang</label>
			</div>
			<div class="radio">
			  <label><input type="radio" name="karyawan" value="2" required>10 – 30 Orang</label>
			</div>

			<div class="radio">
			  <label><input type="radio" name="karyawan" value="3" required>>30 Orang</label>
			</div>

		  </div>
		  <br>
		  <button type="submit" class="btn btn-primary">Berikutnya</button>
		</form> 
</div>
</div>
<script>
	$(document).ready(function(){
		$(document).on('input change',".usaha",function() {
		var usaha = $(".usaha:checked"),
			val = usaha.val();
		if(val == 6){
			usaha.parent().append("<input type='text' name='lainnya' id='lainnya' required>");
		}else{
			$('#lainnya').remove();
		}
		});


		$(document).on('change',"input[name=usia]",function() {
			var usia = $("input[name=usia]"),
				valUsia = usia.val();
			if(valUsia < 18 || valUsia > 75){
				alert("Usia antara 18 hingga 75 tahun");
				usia.val("");
			}
		});


		$(document).on('input change',"input[name=penghasilan]",function() {
			var usaha = $("input[name=usaha]:checked").val(),
			    lainnya = $("input[name=lainnya]").val();
			if(usaha == 6 && lainnya ==""){
				alert("Anda belum mengisi text lainnya");
			}
		});
});
</script>