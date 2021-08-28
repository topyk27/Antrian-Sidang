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
	<?php $this->load->view("_partials/token.php") ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#sidebar_home").addClass("active");
		});
	</script>
</body>
</html>