<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting | User Ubah</title>
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
							<h1>Ubah User</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Setting</a></li>
								<li class="breadcrumb-item"><a href="<?php echo base_url('setting/user'); ?>">User</a></li>
								<li class="breadcrumb-item active">Ubah</li>
							</ol>
						</div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Ubah Data User</h3>
								</div>
								<form role="form" method="post">
									<div class="card-body">
										<div class="form-group">
											<label for="nama">Nama</label>
											<input type="text" name="nama" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>" value="<?php if(empty(set_value('nama'))) { echo $user->nama; } else{ echo set_value('nama');} ?>" required>
											<div class="invalid-feedback">
												<?php echo form_error('nama'); ?>
											</div>
										</div>
										
										<div class="form-group">
											<label for="username">Username</label>
											<input type="text" name="username" class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>" value="<?php if(empty(set_value('username'))) { echo $user->username; } else{ echo set_value('username');} ?>" required readonly>
											<div class="invalid-feedback">
												<?php echo form_error('username'); ?>
											</div>
										</div>
										<div class="form-group">
											<label for="password">Password</label>
											<input type="password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>" value="<?php if(empty(set_value('password'))) { } else{ echo set_value('password');} ?>" placeholder="Kosongkan apabila tidak ingin mengganti password">
											<div class="invalid-feedback">
												<?php echo form_error('password'); ?>
											</div>
										</div>
										<div class="form-group">
											<label for="ruangan">Ruangan</label>
											<select class="form-control <?php echo form_error('ruangan') ? 'is-invalid' : '' ?>" name="ruangan">
												<?php foreach($ruangan as $key=>$val): ?>
													<option value="<?php echo $val->id.'#'.$val->nama; ?>" <?php if($user->ruang_sidang_id == $val->id) { echo set_select('ruangan',$val->id.'#'.$val->nama,TRUE); } ?>><?php echo $val->nama; ?></option>
												<?php endforeach; ?>
											</select>
											<div class="invalid-feedback">
												<?php echo form_error('ruangan'); ?>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="<?php echo base_url("setting/user"); ?>" class="btn btn-danger">Batal</a>
									</div>
								</form>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#sidebar_setting").addClass("active");
			$("#sidebar_setting_user").addClass("active");
		});
	</script>
</body>
</html>