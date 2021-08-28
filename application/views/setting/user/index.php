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
		var dt_user;
		function hapusData(id) {
			$.ajax({
				url: "<?php echo base_url('setting/user_hapus'); ?>",
				type: "POST",
				data: {id: id},
				dataType: "TEXT",
				beforeSend: function()
				{
					$(".loader2").show();
				},
				success: function(data)
				{
					$(".loader2").hide();
					if(data)
					{
						dt_user.reload(null,false);
						$("#respon").html("<div class='alert alert-success' role='alert' id='responMsg'><strong>Selamat</strong> Data berhasil dihapus</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
					}
					else
					{
						$("#respon").html("<div class='alert alert-warning' role='alert' id='responMsg'><strong>Maaf</strong> Data gagal dihapus</div>")
						$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});
					}
				},
				error: function(err)
				{
					console.log(err);
					$(".loader2").hide();
					$("#respon").html("<div class='alert alert-danger' role='alert' id='responMsg'><strong>Error</strong> mohon periksa jaringan internet anda.</div>")
					$("#responMsg").hide().fadeIn(200).delay(2000).fadeOut(1000, function(){$(this).remove();});

				}
			});
		}
		$(document).ready(function(){
			$("#sidebar_setting").addClass("active");
			$("#sidebar_setting_user").addClass("active");
			dt_user = $("#dt_user").DataTable({
				ajax: {
					url: "<?php echo base_url('setting/data_user'); ?>",
					dataSrc: "user",
				},
				columns: [
				{data:'id'},
				{data: null, sortable: false, render: function(data,type,row, meta){
				return meta.row + meta.settings._iDisplayStart + 1;
				}},
				{data:'username'},
				{data:'nama'},
				{data:'ruangan'},
				{data: null, sortable: false, render: function(data,type,row,meta){
					return "<a href='<?php echo base_url('setting/user_ubah/') ?>"+row['id']+"' class='btn btn-warning'><i class='fas fa-edit'></i>Ubah</a>";
				}},
				{data: null, sortable: false, render: function(data,type,row,meta){
					return "<a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
				}}
				],
				columnDefs : [
				{
					targets: [0],
					visible: false,
				},
				{
					targets: [1,2,4],
					responsivePriority: 1,
				}
				],
				responsive : true,
				autoWidth: false,
			});

			$("#dt_user tbody").on('click', 'tr .deleteButton', function(e){
				e.preventDefault();
				var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
				var data = $("#dt_user").DataTable().row(currentRow).data();
				$('#hapusModal').modal('show');
				$('#hapusModal').find('.modal-body').html("<p>Apakah anda ingin menghapus data "+data['nama']+"? Data ini tidak bisa dipulihkan kembali.");
				$('#hapusModal').find('#deleteButton').attr("onclick", "hapusData("+data['id']+")");
			});
		});
	</script>
</body>
</html>