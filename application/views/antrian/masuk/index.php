<!DOCTYPE html>
<html lang="ID">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Antrian Sidang</title>
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
							<h1>Antrian <?php echo $nama_ruangan; ?></h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
								<li class="breadcrumb-item active" id="bc_ruang">Antrian <?php echo $nama_ruangan; ?></li>
							</ol>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-md-2">
							<a href="#" id="btn_security" class="btn btn-block bg-gradient-primary">
								<i class="fas fa-phone"></i> Security
							</a>
						</div>
						<div class="col-md-2">
							<a href="#" id="btn_buka_sidang" class="btn btn-block bg-gradient-warning">
								<i class="fas fa-gavel"></i> Buka Sidang
							</a>
						</div>
						<div class="col-md-2">
							<a href="#" id="btn_pengumuman" class="btn btn-block bg-gradient-success">
								<i class="fas fa-bullhorn"></i> Pengumuman
							</a>
						</div>
					</div>
				</div>
			</section>
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary">
								<table id="dt_antrian" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th></th>
											<th>Panggil</th>
											<th>Antrian</th>
											<th>Perkara</th>
											<th>Penggugat</th>
											<th>Tergugat</th>
											<th>Agenda</th>
											<th>Status</th>
											<th>Ruangan</th>
											<th>Nama Ruangan</th>
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

	<div id="responModal" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header flex-column">
					<div class="icon-box">
						<i class="material-icons" id="responModalIcon">done</i>
					</div>
					<h4 class="modal-title w-100" id="responModalTitle">Berhasil</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body" id="responModalBody">
					<p>Data berhasil dihapus</p>
				</div>
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-success" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
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

	<div id="ubahModal" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header flex-column">
					<div class="icon-box">
						<i class="material-icons">edit</i>
					</div>
					<h4 class="modal-title w-100" id="ubahTitle">Ubah data nomor perkara</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body" id="ubahBody">
					<div class="form-group">
						<label for="ruangan">Ruang Sidang</label>
						<select class="form-control" name="ruang_sidang_id">
							<?php foreach ($data_ruangan as $key => $val) : ?>
								<option value="<?php echo $val->id; ?>"><?php echo $val->nama; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-success" data-dismiss="modal" id="ubahButton">Simpan</button>
				</div>
			</div>
		</div>
	</div>
	<div id="pengumumanModal" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header flex-column">
					<div class="icon-box">
						<i class="material-icons">campaign</i>
					</div>
					<h4 class="modal-title w-100">Umumkan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<textarea id="text_pengumuman" rows="3" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-success" data-dismiss="modal" id="modal_pengumuman">Umumkan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
	<!-- ResponsiveVoice -->
	<script src="https://code.responsivevoice.org/responsivevoice.js?key=6UoEN13s"></script>
	<script>
		<?php
		$this->config->load('antrian_config', TRUE);
		$panggil = $this->config->item('panggil', 'antrian_config');
		$rsvc = $this->config->item('rsvc', 'antrian_config');
		?>		
		var rsvc = <?php echo $rsvc; ?>;
		var panggil_melalui = "<?php echo $panggil; ?>";
		const jadwal_sidang = "<?php echo date("Y-m-d"); ?>";		
		const base_url = "<?php echo base_url(); ?>";
		const panggilan_security = "<?php echo $panggilan->security; ?>";
		var ruang = "<?php echo $nama_ruangan; ?>";		
		const nama_ruangan = "<?php echo $nama_ruangan; ?>";
		const panggilan_sidang = "<?php echo $panggilan->sidang; ?>";
		$(document).ready(function(){
			<?php if ($this->session->userdata("antrian_role") == "admin") : ?>
				$("#sidebar_ruang").addClass("active");
			<?php endif; ?>
			$("#sidebar_ruang_" + ruang_sidang).addClass("active");
		});
	</script>
	<script src="<?php echo base_url('asset/js/view/antrian/masuk/index.min.js'); ?>"></script>

</body>

</html>