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
												<textarea class="form-control" name="textsecurity" rows="3" readonly></textarea>
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
												<textarea class="form-control" name="textbukasidang" rows="3" readonly></textarea>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#sidebar_setting").addClass("active");
			$("#sidebar_setting_sistem").addClass("active");

			$("#btnSecurityUbah").click(function(){
				$("#btnSecuritySimpan").show();
				$(this).hide();
				$("textarea[name='textsecurity']").attr("readonly",false);
			});
			$("#btnSecuritySimpan").click(function(){
				let data = $("textarea[name='textsecurity']").val();
				$.ajax({
					url: "<?php echo base_url('setting/save_text/security'); ?>",
					type: "POST",
					data: {data: data},
					dataType: "TEXT",
					success: function(respon)
					{
						if(respon>0)
						{
							$("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>")
							$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
						}
						else
						{
							$("#respon").html("<div class='alert alert-info' role='alert' id='responMsg'>Data tidak ada perubahan</div>")
							$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
						}
						$("#btnSecuritySimpan").hide();
						$("#btnSecurityUbah").show();
						$("textarea[name='textsecurity']").attr("readonly",true);
					},
					error: function(err)
					{
						console.log(err);
						$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah, mohon periksa jaringan internet anda.</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
					}
				});
			});

			$("#btnSidangUbah").click(function(){
				$("#btnSidangSimpan").show();
				$(this).hide();
				$("textarea[name='textbukasidang']").attr("readonly",false);
			});
			$("#btnSidangSimpan").click(function(){
				let data = $("textarea[name='textbukasidang']").val();
				$.ajax({
					url: "<?php echo base_url('setting/save_text/security'); ?>",
					method: "POST",
					data: {data: data},
					dataType: "TEXT",
					success: function(respon)
					{
						if(respon>0)
						{
							$("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'>Data berhasil diubah</div>")
							$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
						}
						else
						{
							$("#respon").html("<div class='alert alert-info' role='alert' id='responMsg'>Data tidak ada perubahan</div>")
							$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
						}
						$("#btnSidangSimpan").hide();
						$("#btnSidangUbah").show();
						$("textarea[name='textbukasidang']").attr("readonly",true);
					},
					error: function(err)
					{
						console.log(err);
						$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'>Data gagal diubah, mohon periksa jaringan internet anda.</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
					}
				});
			});
		});
	</script>
</body>
</html>