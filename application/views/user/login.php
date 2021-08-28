<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Antrian Sidang | Login</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/fontawesome-free/css/all.min.css') ?>">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="<?php echo base_url('asset/plugin/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'); ?>">
	<!-- Theme style -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/dist/css/adminlte.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/cpr.css') ?>">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="<?php echo base_url(); ?>" class="h1"><b>Antrian Sidang</b></a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Sign in to start your session</p>
				<form action="<?php echo base_url('user/login_proses'); ?>" method="post">
					<div class="input-group mb-3">
						<input type="text" name="username" class="form-control" placeholder="Username" required="">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="password" class="form-control" placeholder="Password" required="">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block">Sign in</button>
						</div>
					</div>
					<footer class="main-footer" style="margin-left: 0px;">
						<strong class="color-change-4x">Copyright &copy; <?php echo date("Y"); ?> <a href="https://topyk27.github.io/">Taufik Dwi Wahyu Putra<br></a></strong>
						<div class="float-right d-none d-sm-block">
						  <b>Version</b> 1.0.0
						</div>
					</footer>
				</form>
			</div>
		</div>

	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<!-- SweetAlert2 -->
	<script src="<?php echo base_url('asset/plugin/sweetalert2/sweetalert2.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			var Toast = Swal.mixin({
			  toast: true,
			  position: 'top-end',
			  showConfirmButton: false,
			  timer: 3000
			});

			<?php if($this->session->flashdata('antrian_proses_login')) : ?>
				Toast.fire({
					icon : 'error',
					title : 'Username atau password salah.'
				});

			<?php endif; ?>
		});
	</script>
</body>
</html>