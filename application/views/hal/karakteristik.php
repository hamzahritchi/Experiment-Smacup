       <div class="row dokumen" style="text-align:justify;">

        <div class="col-sm-12">
<h1>KARAKTERISTIK PENGGUNA</h1>

<p>Jawablah pertanyaan berikut setepat mungkin.</p>
		 <form method="post">
		  <div class="form-group">
		  	<b>Apa Anda berpengalaman dalam penggunaan sistem informasi akuntansi (software akuntansi)? </b>
		 <div class="radio">
			  <label><input type="radio" class='pengalaman' name="pengalaman" value="1" required>Ya</label>
			</div>
			<div class="radio">
			  <label><input type="radio" class='pengalaman' name="pengalaman" value="2" required>Tidak</label>
			</div>
		  </div>
 		
		  <br>
		  <button type="submit" class="btn btn-primary">Berikutnya</button>
		</form> 
</div>
</div>
<script>
	$(document).ready(function(){

		$(document).on('change',".pengalaman",function() {
		var pengalaman = $(".pengalaman:checked"),
			valPengalaman = pengalaman.val();
		if(valPengalaman == 1){
			pengalaman.parent().parent().parent().append('<div class="form-group kedua"> <b>Apa jenis sistem informasi akuntansi yang Anda gunakan? </b> <div class="checkbox"> <label><input type="checkbox" class="software" name="software[]" value="1">Accurate</label> </div> <div class="checkbox"> <label><input type="checkbox" class="software" name="software[]" value="2">Zahir</label> </div> <div class="checkbox"> <label><input type="checkbox" class="software" name="software[]" value="3">MYOB</label> </div> <div class="checkbox"> <label><input type="checkbox" class="software" name="software[]" value="4">SAP</label></div><div class="checkbox"><label><input type="checkbox" class="software" name="software[]" value="5">Lainnya</label></div></div><div class="form-group kedua"><b>Berapa lamakah Anda menggunakan sistem informasi akuntansi tersebut? </b><div class="radio "><label><input type="radio" class="lama" name="lama" value="1"  required>&#8924; 1 tahun</label></div><div class="radio"><label><input type="radio" class="lama" name="lama" value="2" required>&gt; 1 tahun</label></div>');
		}else{
			$('.kedua').remove();
		}
		});


		$(document).on('change',".lama",function() {
		var lama = $(".lama:checked"),
			valLama = lama.val();
		if(valLama == 2){
			lama.parent().parent().parent().append('<div class="form-group kedua ketiga"><b>Dari beberapa istilah berikut yang bukan merupakan bagian dari siklus pendapatan adalah </b><div class="checkbox"><label><input type="checkbox" class="soal" name="soal[]" value="1">Piutang Usaha</label></div><div class="checkbox"> <label><input type="checkbox" class="soal" name="soal[]" value="2">	Penggajian/Payroll</label></div><div class="checkbox"><label><input type="checkbox" class="soal" name="soal[]" value="3">Free on Board (FOB)</label></div><div class="checkbox"><label><input type="checkbox" class="soal" name="soal[]" value="4">Penerimaan Barang/Receiving</label></div></div>');
		}else{
			$('.ketiga').remove();
		}
		});


    $(document).on('submit','form',function() {
		var pengalaman = $(".pengalaman:checked"),
			valPengalaman = pengalaman.val();
    	if(valPengalaman == 1){
		      	checked1 = $("input[name='software[]']:checked").length;

		      if(!checked1) {
		        alert("Mohon isi pilihan sistem informasi akuntansi yang Anda gunakan.");
		        return false;
		      }
				var lama = $(".lama:checked"),
				valLama = lama.val();


		      if(valLama == 2){
			      	checked2 = $("input[name='soal[]']:checked").length;
			      if(!checked2) {
			        alert("Mohon isi pertanyaan terakhir.");
			        return false;
			      }
	      	}
  		}
    	
    });
});
</script>