 
<?php $this->load->view("pembelian/soal"); ?>

   <div class="row dokumen" style="text-align:justify;">

        <div class="col-sm-12">
		 <h3>Konfirmasi Selesai</h3>
		 <?php
		 	$this->load->database();
		 	$peserta = $this->session->userdata("id");
		 	$selesai = $this->db->where("peserta_id",$peserta)->get("eksperimen_case2")->row();

		 	if($selesai->case2_a1 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan pemesanan</div>";
		 	if($selesai->case2_a2 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan penerimaan barang</div>";
		 	if($selesai->case2_a3 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan tagihan</div>";
		 	if($selesai->case2_a4 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan pembayaran</div>";
		 	if($selesai->case2_a5 == 0) echo "<div class='alert alert-warning' role='alert'>Anda belum menyelesaikan laporan</div>";
		 ?>
		 <p>Dengan memilih tombol dibawah ini, Anda menyatakan telah menyelesaikan kasus yang diberikan kepada Anda.</p>
<br>
<a <?php if($selesai->case2_a1 == 0 || $selesai->case2_a2 == 0 || $selesai->case2_a3 == 0 || $selesai->case2_a4 == 0 || $selesai->case2_a5 == 0) echo "disabled tabindex='-1' onclick='return false'"; else echo "onclick=\"return confirm('Anda yakin?')\""; ?> class="btn btn-primary" href="<?php echo base_url("soal/selesai/".md5("case2")) ?>">Selesai</a>

        </div>

    </div>