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
					<div class="row">
						<div class="col-md-12">
							<div class="card card-primary">
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
		<div id="ambil_modal" class="modal fade">
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
		        <p></p>
		      </div>
		      <div class="modal-footer justify-content-center" id="modal_footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal" id="ambil_button">Ambil</button>
		      </div>
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
			$this->config->load('antrian_config',TRUE);
			$print = $this->config->item('print','antrian_config');
		 ?>
		const printable = "<?php echo $print; ?>";
		var dt_antrian;
		function ambil(id,perkara,penggugat,tergugat,jadwal_sidang,agenda,ruang_sidang_id, ruang_sidang)
		{
			$.ajax({
				url: "<?php echo base_url('jadwal/insert_antrian'); ?>",
				method: "POST",
				data: {perkara_id: id, perkara: perkara, penggugat: penggugat, tergugat: tergugat, jadwal_sidang: jadwal_sidang, agenda: agenda, ruang_sidang_id: ruang_sidang_id, ruang_sidang: ruang_sidang},
				dataType: 'json',
				beforeSend: function()
				{
					$(".loader2").show();
				},
				success: function(data)
				{
					$(".loader2").hide();
					if(printable=="enable")
					{
						if(data.success)
						{
							var process_cetak = cetak(data.no_antrian,perkara,jadwal_sidang,ruang_sidang);
							if(process_cetak=="ok")
							{
								dt_antrian.ajax.reload();
								$("#responSimbol").text('done');
								$("#modal_title").html('Nomor Antrian '+ data.no_antrian + '<br>di ' + data.ruang_sidang);
								$("#modal_body").text('Silahkan menunggu nomor antrian anda dipanggil');
								$("#modal_footer").hide();
								$("#ambil_modal").modal({backdrop: 'static', keyboard: false});
								setTimeout(function(){$("#ambil_modal").modal('hide');},5000);
							}
						}
						else
						{
							alert('ada kesalahan, harap refresh halaman');
						}
					}
					else
					{
						if(data.success)
						{
							dt_antrian.ajax.reload();
							$("#responSimbol").text('done');
							$("#modal_title").html('Nomor Antrian '+ data.no_antrian + '<br>di ' + data.ruang_sidang);
							$("#modal_body").text('Silahkan menunggu nomor antrian anda dipanggil');
							$("#modal_footer").hide();
							$("#ambil_modal").modal({backdrop: 'static', keyboard: false});
							setTimeout(function(){$("#ambil_modal").modal('hide');},5000);
						}
						else
						{
							alert('ada kesalahan, harap refresh halaman');
						}
					}
				},
				error: function(err)
				{
					$(".loader2").hide();
					alert('ada yang salah');
					console.log(err);
				}
			});
		}

		function cetak(no_antrian,perkara,jadwal,ruang) {
			jadwal = jadwal.split("-");
			jadwal = jadwal[2]+"-"+jadwal[1]+"-"+jadwal[0];
			var a;
			$.ajax({
				url: "<?php echo base_url('jadwal/cetak'); ?>",
				data: {no_antrian: no_antrian, perkara: perkara, jadwal: jadwal, ruang: ruang},
				method: "JSON",
				dataType: "TEXT",
				beforeSend: function()
				{
					$(".loader2").show();
				},
				success: function(respon)
				{
					if(respon.success==1)
					{
						a ="ok";
					}
					else
					{
						a = "ok";
						alert("Gagal cetak antrian");
					}
					$(".loader2").hide();
					return a;
				},
				error: function(err)
				{
					console.log(err);
					$(".loader2").hide();
					alert('ada yang salah, harap periksa jaringan');
					return a;
				}
			});
		}
		$(document).ready(function(){
			$("#sidebar_ambil_antrian").addClass("active");
			dt_antrian = $("#dt_antrian").DataTable({
				order: [[1,"asc"]],
				ajax: {
					url: "<?php echo base_url('jadwal/ambil_antrian_hari_ini'); ?>",
					dataSrc: "data_jadwal",
				},
				columns: [
				{data:"id"},
				{data:"perkara"},
				{data:"penggugat"},
				{data:"tergugat"},
				{data:"ruang"},
				{data:"ruang_sidang_id"},
				{data:"tanggal_sidang"},
				{data:"agenda"},
				],
				columnDefs: [
				{
					targets: [0,5,6,7],
					visible: false,
				},
				{
					responsivePriority: 1,
					targets: [1,2],
				}
				],
				responsive: true,
				autoWidth: false,
			});

			$("#dt_antrian tbody").on('click','tr', function(e){
				e.preventDefault();
				var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
				var data = $("#dt_antrian").DataTable().row(currentRow).data();
				$("#modal_title").html('Ambil antrian');
				$("#ambil_modal").modal({backdrop: 'static', keyboard: false});
				$("#modal_footer").show();
				if(data['tergugat'])
				{
				$("#ambil_modal").find('.modal-body').html("<p>Ambil antrian nomor perkara "+data['perkara']+"<br>Penggugat : "+data['penggugat']+"<br>Tergugat : "+data['tergugat']);
				}
				else
				{
				$("#ambil_modal").find('.modal-body').html("<p>Ambil antrian nomor perkara "+data['perkara']+"<br>Penggugat : "+data['penggugat']);
				}
				$("#ambil_modal").find("#ambil_button").attr("onclick", "ambil("+data['id']+",'"+data['perkara']+"','"+data['penggugat']+"','"+data['tergugat']+"','"+data['tanggal_sidang']+"','"+data['agenda']+"',"+data['ruang_sidang_id']+",'"+data['ruang']+"')");
			});

			setInterval(function(){
				dt_antrian.ajax.reload(null,false);
			},30000);
		});
	</script>
</body>
</html>