 
<?php $this->load->view("penjualan/soal"); ?>

   <div class="row dokumen" style="text-align:justify;">

        <div class="col-sm-12">
		 <h3>Konfirmasi Selesai</h3>
		 <?php
		 	$this->load->database();
		 	$peserta = $this->session->userdata("id");
		 	$selesai = $this->db->where("peserta_id",$peserta)->get("eksperimen_case1")->row();

		 	if($selesai->case1_a1 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan kasus pemesanan</div>";
		 	if($selesai->case1_a2 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan pengiriman kasus barang</div>";
		 	if($selesai->case1_a3 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan kasus penagihan</div>";
		 	if($selesai->case1_a4 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan kasus pembayaran</div>";
		 	if($selesai->case1_a5 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan kasus laporan</div>";
		 ?>
		 <p>Dengan memilih tombol dibawah ini, Anda menyatakan telah menyelesaikan kasus yang diberikan kepada Anda.</p>
<br>
<a <?php if($selesai->case1_a1 == 0 || $selesai->case1_a2 == 0 || $selesai->case1_a3 == 0 || $selesai->case1_a4 == 0 || $selesai->case1_a5 == 0) echo "disabled tabindex='-1' onclick='return false'"; else echo "onclick=\"return confirm('Anda yakin?')\""; ?> class="btn btn-primary" href="<?php echo base_url("soal/selesai/".md5("case1")) ?>">Selesai</a>

        </div>

    </div>