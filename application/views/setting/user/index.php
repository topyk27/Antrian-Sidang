<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Setting | User</title>
	<?php $this->load->view("_partials/css.php") ?>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
	<!-- loader -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/mine/css/loader.css'); ?>">
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
							<h1>Data User</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Setting</a></li>
								<li class="breadcrumb-item active">User</li>
							</ol>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-2">
							<a href="<?php echo base_url('setting/user_tambah') ?>" class="btn btn-block bg-gradient-primary">
								<i class="fas fa-plus"></i> Tambah
							</a>
						</div>						
					</div>	
					<div class="row mb-2">
						<div class="col-md-12" id="respon"></div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary">
								<table id="dt_user" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th></th>
											<th>#</th>
											<th>Username</th>
											<th>Nama</th>
											<th>Ruang</th>
											<th>Ubah</th>
											<th>Hapus</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view("_partials/footer.php") ?>
		<?php $this->load->view("_partials/loader.php") ?>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<div id="hapusModal" class="modal fade">
	  <div class="modal-dialog modal-confirm">
	    <div class="modal-content">
	      <div class="modal-header flex-column">
	        <div class="icon-box">
	          <i class="material-icons">delete</i>
	        </div>
	        <h4 class="modal-title w-100">Apakah anda yakin?</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      </div>
	      <div class="modal-body">
	        <p>Apakah anda ingin menghapus data ini? Data ini tidak bisa dipulihkan kembali.</p>
	      </div>
	      <div class="modal-footer justify-content-center">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal" id="deleteButton">Hapus</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
	<!-- datatables -->
	<script src="<?php echo base_url('asset/plugin/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?php echo base_url('asset/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?php echo base_url('asset/plugin/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
	<script src="<?php echo base_url('asset/plugin/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

	<script type="text/javascript">
		<?php
			if($this->session->userdata('success')):
				$respon = $this->session->userdata('success');
		?>
			$("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><?php echo $respon; ?></div>")
			$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
		<?php endif; ?>
		const base_url = "<?php echo base_url(); ?>";		
	</script>
	<script src="<?php echo base_url('asset/js/view/setting/user/index.min.js'); ?>"></script>
</body>
</html>