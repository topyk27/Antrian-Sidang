<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting | Sistem</title>
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
							<h1>Sistem</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Setting</a></li>
								<li class="breadcrumb-item active">Sistem</li>
							</ol>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-12" id="respon"></div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Setting</h3>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label for="security">Panggil Security</label>
										<div class="row">
											<div class="col-md-6">
												<textarea class="form-control" name="textsecurity" rows="3" readonly><?php echo $setting->security; ?></textarea>
											</div>
											<div class="col-md-2">
												<a href="#" id="btnSecurityUbah" class="btn btn-warning">Ubah</a>
												<a href="#" id="btnSecuritySimpan" class="btn btn-success" style="display: none;">Simpan</a>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="buka_sidang">Buka Sidang</label>
										<div class="row">
											<div class="col-md-6">
												<textarea class="form-control" name="textbukasidang" rows="3" readonly><?php echo $setting->sidang; ?></textarea>
											</div>
											<div class="col-md-2">
												<a href="#" id="btnSidangUbah" class="btn btn-warning">Ubah</a>
												<a href="#" id="btnSidangSimpan" class="btn btn-success" style="display: none;">Simpan</a>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="logo">Logo</label>
										<div class="row">
											<form class="form-inline" method="post" enctype="multipart/form-data">
												<div class="col-sm-4">
													<img src="<?php echo base_url('asset/img/logo.png').'?'.time(); ?>" class="img-fluid mb-3">
												</div>
												<div class="col-sm-4">
													<input type="file" accept=".png" name="logo" class="form-control-file mb-3 <?php echo form_error('logo') ? 'is-invalid' : '' ?>">
													<div class="invalid-feedback">
														<?php echo form_error('logo'); ?>
													</div>
												</div>
												<div class="col-sm-4">
													<button type="submit" class="btn btn-warning btn-submit">Simpan</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
	<script>
		const base_url = "<?php echo base_url(); ?>";
	</script>
	<script src="<?php echo base_url('asset/js/view/setting/sistem.min.js') ?>"></script>
</body>
</html>