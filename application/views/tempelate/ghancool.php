<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=0.9"/>
    <link href="<?php echo base_url(); ?>asset/img/favicon.ico" rel="icon" type="image/x-icon" />

    <title>Simulasi SIA - UMKM</title>

	<!-- JS -->

	<script src="<?php echo base_url(); ?>asset/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/BootSideMenu.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/jquery.datetimepicker.js"></script>
	<script>
	$(document).ready(function() {
		$(".tgl").datetimepicker({
			timepicker:false,
			format:"Y-m-d"
		});

		$(".tglo").datetimepicker({
			timepicker:false,
			format:"Y-m-d"
		});
	});
	</script>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet">

	<!-- Bootstrap core JS -->
	<script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>asset/css/jquery.datetimepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/smacc.css" rel="stylesheet">
     <link href="<?php echo base_url(); ?>asset/css/BootSideMenu.css" rel="stylesheet">
</head>

<body style="padding-top:50px">
<header id="navbar">
<nav class="navbar navbar-default navbar-static-top" data-spy="affix" >
  <div class="container-fluid">

    <div class="navbar-header">
    	<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url()."asset/img/logo.gif" ?>"></a>
	<p id="navbar-text" class="navbar-text" href="#">Simulasi SIA - UMKM</p>
	<?php if($nav != ""){ ?>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
  <?php } ?>
    </div>

    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
		<?php echo $nav; ?>
      </ul>
     </div>
  </div>
</nav>
</header>



<div class="body">

	<div class="container">

		<?php $this->load->view($hal); ?>

	</div>

</div>

<footer class="hidden-xs">

	<hr>

	<div class="container">

		<p>&copy; 2018 Riset Universitas Padjadjaran</p>

	</div>

</footer>

</body>

</html>