<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Antrian Hari Ini</title>
	<?php $this->load->view("_partials/css.php") ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php $this->load->view("_partials/navbar.php") ?>
		<?php $this->load->view("_partials/sidebar_container.php") ?>
		<div class="content-wrapper">
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Antrian Sidang Hari Ini</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Home</a></li>
							</ol>
						</div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<?php $total_ruangan = sizeof($data); ?>
					<?php foreach($data as $key=>$val): ?>
					<?php if($total_ruangan % 2 == 0) : ?>
					<div class="row">
					<?php endif; ?>
						<div class="col-md-6">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title"><?php echo $val['nama']; ?></h3>
								</div>
								<div class="card-body">
									<table class="table table-bordered table-hover">
										<tr>
											<td>Jumlah Perkara</td>
											<td><?php echo $val['jumlah_sidang']; ?></td>
										</tr>
										<tr>
											<td>Ambil Antrian</td>
											<td><?php echo $val['jumlah_ambil']; ?></td>
										</tr>
										<tr>
											<td>Belum Ambil</td>
											<td><?php echo $val['jumlah_belum']; ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					<?php if($total_ruangan % 2 == 1) : ?>
					</div>
					<?php endif; ?>
					<?php --$total_ruangan; endforeach; ?>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<?php $this->load->view("_partials/loader.php") ?>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
	<script type="text/javascript">
		const token = "<?php echo $this->session->userdata('tkn'); ?>";
		const nama_pa = "<?php echo $this->session->userdata('nama_pa'); ?>";
		const nama_pa_pendek = "<?php echo $this->session->userdata('nama_pa_pendek'); ?>";
		$.ajax({
			url: "https://raw.githubusercontent.com/topyk27/Drivethru-Pengadilan-Agama-Tenggarong/master/asset/mine/token/token.json",
			method: "GET",
			dataType: "JSON",
			beforeSend: function()
			{
				$(".loader2").show();
			},
			success: function(data)
			{
				try{
					if(nama_pa==data[nama_pa_pendek][0].nama_pa && nama_pa_pendek==data[nama_pa_pendek][0].nama_pa_pendek && token==data[nama_pa_pendek][0].token)
					{
						
					}
					else
					{
						location.replace("<?php echo base_url('aktivasi'); ?>");
					}
				}
				catch(err)
				{
					location.replace("<?php echo base_url('aktivasi'); ?>");
				}
				$(".loader2").hide();
			},
			error: function(err)
			{
				location.replace("<?php echo base_url('aktivasi'); ?>");
			}
		});
		$(document).ready(function(){
			$("#sidebar_home").addClass("active");
		});
	</script>
</body>
</html>