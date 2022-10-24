<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ambil Antrian Sidang</title>
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
							<h1>Ambil Antrian Sidang</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
							  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
							  <li class="breadcrumb-item active">Ambil Antrian</li>
							</ol>
						</div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row-mb-3">
						<p>Untung mengambil antrian silahkan klik data nomor perkara</p>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary p-3">
								<table id="dt_antrian" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th></th>
											<th>Nomor Perkara</th>
											<th>Penggugat</th>
											<th>Tergugat</th>
											<th>Ruang Sidang</th>
											<th>ID Ruang</th>
											<th>Tanggal Sidang</th>
											<th>Agenda</th>
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
		<div id="ambil_modal" class="modal fade" data-keyboard="false" data-backdrop="static">
		  <div class="modal-dialog modal-confirm">
		    <div class="modal-content">
		      <div class="modal-header flex-column">
		        <div class="icon-box">
		          <i class="material-icons" id="responSimbol">queue</i>
		        </div>
		        <h4 class="modal-title w-100" id="modal_title">Ambil Antrian</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		      </div>
		      <div class="modal-body" id="modal_body">
		        <p id="teks_konten"></p>
				<div id="cb">
					<?php if($this->session->userdata("antrian_role")=="petugas"): ?>
						<div class="form-check form-check-inline">
							<input type="checkbox" class="form-check-input" id="checkboxP" value="penggugat">
							<label for="checkboxP" class="form-check-label">Penggugat</label>
						</div>
						<div class="form-check form-check-inline">
							<input type="checkbox" class="form-check-input" id="checkboxT" value="tergugat">
							<label for="checkboxT" class="form-check-label">Tergugat</label>
						</div>
					<?php endif; ?>
				</div>
		      </div>
		      <div class="modal-footer justify-content-center" id="modal_footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
		        <button type="button" class="btn btn-success" data-dismiss="modal" id="ambil_button">Ambil</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js'); ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js'); ?>"></script>
	<!-- datatables -->
	<script src="<?php echo base_url('asset/plugin/datatables/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('asset/plugin/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?php echo base_url('asset/plugin/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
	<script src="<?php echo base_url('asset/plugin/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
	<?php $this->load->view("_partials/token.php"); ?>
	<script type="text/javascript">
		<?php 
			$this->config->load('antrian_config',TRUE);
			$print = $this->config->item('print','antrian_config');			
		 ?>
		const printable = "<?php echo $print; ?>";
		const isPetugas = <?php echo ($this->session->userdata("antrian_role")=="petugas") ? "true" : "false";  ?>;
		
	</script>
	<script src="<?php echo base_url('asset/js/view/ambil.min.js'); ?>"></script>
</body>
</html>