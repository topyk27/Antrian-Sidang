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
							<?php foreach($data_ruangan as $key=>$val): ?>
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
	<script type="text/javascript">
		<?php 
			$this->config->load('antrian_config',TRUE);
			$panggil = $this->config->item('panggil','antrian_config');
		 ?>
		const panggil_melalui = "<?php echo $panggil; ?>"
		var path = window.location.pathname; //"/antrian_baru/jadwal/ruang/1"
		var namanya = path.split("/"); //["", "antrian_baru", "jadwal", "ruang", "1"]
		var ruang_sidang = namanya[namanya.length-1]; //"1"
		var jadwal_sidang = "<?php echo date("Y-m-d"); ?>";
		// var jadwal_sidang = "<?php echo date("2021-08-02"); ?>";
		var svr = "<?php echo base_url(); ?>";
		var dt_antrian;

		function nama_ruang(ruang_sidang) {
			switch(ruang_sidang)
			{
				case 'ruang sidang i':
				ruang_sidang = 'ruang sidang 1';
				break;
				case 'ruang sidang ii':
				ruang_sidang = 'ruang sidang 2';
				break;
				case 'ruang sidang iii':
				ruang_sidang = 'ruang sidang 3';
				break;
				case 'ruang sidang iv':
				ruang_sidang = 'ruang sidang 4';
				break;
				case 'ruang sidang v':
				ruang_sidang = 'ruang sidang 5';
				break;
				case 'ruang sidang vi':
				ruang_sidang = 'ruang sidang 6';
				break;
				case 'ruang sidang vii':
				ruang_sidang = 'ruang sidang 7';
				break;
				case 'ruang sidang viii':
				ruang_sidang = 'ruang sidang 8';
				break;
				case 'ruang sidang ix':
				ruang_sidang = 'ruang sidang 9';
				break;
				case 'ruang sidang x':
				ruang_sidang = 'ruang sidang 10';
				break;
			}
			return ruang_sidang;
		}

		function panggil(id,no_antrian,perkara,penggugat,tergugat, ruang_sidang, ruang_sidang_id)
		{
			voice = "Indonesian Male";
			rate = 1;
			perkara = perkara.split("PA.");
			penggugat = penggugat.replace("<br />"," ");
			tergugat = tergugat.replace("<br />"," ");
			ruang_sidang = ruang_sidang.toLowerCase();
			ruang_sidang = nama_ruang(ruang_sidang);
			$.ajax({
				url: "<?php echo base_url('jadwal/ubah_status'); ?>",
				method: "POST",
				data: {id: id, ruang_sidang_id: ruang_sidang_id},
				dataType: "json",
				beforeSend: function(){
					$(".loader2").show();
				},
				success: function(data)
				{
					if(panggil_melalui=="pc")
					{
						if(data)
						{
							if(tergugat)
							{
							responsiveVoice.speak("Dipanggil nomor antrian "+no_antrian+". Nomor perkara "+perkara[0]+"P,A."+perkara[1]+". "+penggugat+". Dan "+tergugat+". Silahkan ke "+ruang_sidang,voice,{rate: rate, onend: function(){$(".loader2").hide();}});
							}
							else
							{
								responsiveVoice.speak("Dipanggil nomor antrian "+no_antrian+". Nomor perkara "+perkara[0]+"P,A."+perkara[1]+". "+penggugat+". Silahkan ke "+ruang_sidang,voice,{rate: rate, onend: function(){$(".loader2").hide();}});
							}
							dt_antrian.ajax.reload(null,false);
						}
					}
					else
					{
						if(tergugat)
						{
							insert_panggilan("Dipanggil nomor antrian "+no_antrian+". Nomor perkara "+perkara[0]+"P,A."+perkara[1]+". "+penggugat+". Dan "+tergugat+". Silahkan ke "+ruang_sidang, no_antrian, ruang_sidang);
						}
						else
						{
							insert_panggilan("Dipanggil nomor antrian "+no_antrian+". Nomor perkara "+perkara[0]+"P,A."+perkara[1]+". "+penggugat+". Silahkan ke "+ruang_sidang, no_antrian, ruang_sidang);
						}
					}
					$(".loader2").hide();
				},
				error: function(err)
				{
					console.log(err);
					$(".loader2").hide();
					$("#responModalIcon").text('error');
					$("#responModalTitle").text('Error');
					$("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
					$("#responModal").modal({backdrop: 'static', keyboard: false});
					setTimeout(function(){$("#responModal").modal('hide');},3000);
				}
			});
		}

		function insert_panggilan(text,no_antrian,ruang_sidang) {
			$.ajax({
				url: "<?php echo base_url('jadwal/insert_panggilan'); ?>",
				method: "POST",
				data: {text: text, no_antrian: no_antrian, ruang_sidang: ruang_sidang},
				dataType: "TEXT",
				beforeSend: function()
				{
					$(".loader2").show();
				},
				success: function(data)
				{
					
					if(data!=0)
					{
						cek_panggilan(data);
					}
				},
				error: function(err)
				{
					console.log(err);
					$(".loader2").hide();
					$("#responModalIcon").text('error');
					$("#responModalTitle").text('Error');
					$("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
					$("#responModal").modal({backdrop: 'static', keyboard: false});
					setTimeout(function(){$("#responModal").modal('hide');},3000);
				}
			});
		}

		function cek_panggilan(id) {
			$.ajax({
				url: "<?php echo base_url('jadwal/cek_panggilan'); ?>",
				method: "POST",
				data: {id,id},
				dataType: "TEXT",
				beforeSend: function()
				{
					$(".loader2").show();
				},
				success: function(data)
				{
					
					if(data=="sudah")
					{
						$(".loader2").hide();
					}
					else
					{
						setTimeout(function(){
							cek_panggilan(id);
						},3000);
					}
				},
				error: function(err)
				{
					console.log(err);
					$(".loader2").hide();
					$("#responModalIcon").text('error');
					$("#responModalTitle").text('Error');
					$("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
					$("#responModal").modal({backdrop: 'static', keyboard: false});
					setTimeout(function(){$("#responModal").modal('hide');},3000);
				}
			});
		}

		function panggil_saksi(penggugat,tergugat,ruang_sidang,no_antrian) {
			voice = "Indonesian Male";
			rate = 1;
			penggugat = penggugat.replace("<br />"," ");
			tergugat = tergugat.replace("<br />"," ");
			ruang_sidang = ruang_sidang.toLowerCase();
			ruang_sidang = nama_ruang(ruang_sidang);
			if(panggil_melalui=="pc")
			{
				if(tergugat)
				{
					responsiveVoice.speak("Dipanggil saksi-saksi dari "+penggugat+". Atau "+tergugat+". Silahkan ke "+ruang_sidang,voice,{rate: rate, onstart: function(){$(".loader2").show();}, onend: function(){$(".loader2").hide();}});
				}
				else
				{
					responsiveVoice.speak("Dipanggil saksi-saksi dari "+penggugat+". Silahkan ke "+ruang_sidang,voice,{rate: rate, onstart: function(){$(".loader2").show();}, onend: function(){$(".loader2").hide();}});
				}
			}
			else
			{
				if(tergugat)
				{
					insert_panggilan("Dipanggil saksi-saksi dari "+penggugat+". Atau "+tergugat+". Silahkan ke "+ruang_sidang,no_antrian, ruang_sidang);
				}
				else
				{
					insert_panggilan("Dipanggil saksi-saksi dari "+penggugat+". Silahkan ke "+ruang_sidang,no_antrian, ruang_sidang);
				}
			}
		}

		function hapusData(id)
		{
			$.ajax({
				url: "<?php echo base_url('jadwal/hapus'); ?>",
				method: "POST",
				data: {id: id},
				dataType: "json",
				beforeSend: function(){
					$(".loader2").show();
				},
				success: function(data){
					$(".loader2").hide();
					if(data)
					{
						$("#responModalIcon").text('done');
						$("#responModalTitle").text('Berhasil');
						$("#responModalBody").html("<p>Data berhasil dihapus</p>");
					}
					else
					{
						$("#responModalIcon").text('close');
						$("#responModalTitle").text('Gagal');
						$("#responModalBody").html("<p>Data gagal dihapus, harap refresh halaman</p>");
					}
					dt_antrian.ajax.reload(null,false);
					$("#responModal").modal({backdrop: 'static', keyboard: false});
					setTimeout(function(){$("#responModal").modal('hide');},3000);
				},
				error: function(err)
				{
					console.log(err);
					$(".loader2").hide();
					$("#responModalIcon").text('error');
					$("#responModalTitle").text('Error');
					$("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
					$("#responModal").modal({backdrop: 'static', keyboard: false});
					setTimeout(function(){$("#responModal").modal('hide');},3000);
				}
			});
		}

		function ubahData(id)
		{
			var ruang_sidang_id = $("select[name='ruang_sidang_id']").val();
			console.log(ruang_sidang_id);
			$.ajax({
				url: "<?php echo base_url('jadwal/ubah'); ?>",
				method: "POST",
				data: {id: id, ruang_sidang_id: ruang_sidang_id},
				dataType: "json",
				beforeSend: function(){
					$(".loader2").show();
				},
				success: function(data){
					$(".loader2").hide();
					if(data.success)
					{
						$("#responModalIcon").text('done');
						$("#responModalTitle").text('Berhasil');
						$("#responModalBody").html("<p>Data berhasil diubah</p>");
					}
					else
					{
						$("#responModalIcon").text('close');
						$("#responModalTitle").text('Gagal');
						$("#responModalBody").html("<p>Data gagal diubah</p>");
					}
					dt_antrian.ajax.reload(null,false);
					$("#responModal").modal({backdrop: 'static', keyboard: false});
					setTimeout(function(){$("#responModal").modal('hide');},3000);
				},
				error: function(err)
				{
					console.log(err);
					$(".loader2").hide();
					$("#responModalIcon").text('error');
					$("#responModalTitle").text('Error');
					$("#responModalBody").html("<p>Ada kesalahan, harap refresh halaman</p>");
					$("#responModal").modal({backdrop: 'static', keyboard: false});
					setTimeout(function(){$("#responModal").modal('hide');},3000);
				}
			});
		}
		
		$(document).ready(function(){
			<?php if($this->session->userdata("antrian_role")=="admin"): ?>
				$("#sidebar_ruang").addClass("active");
			<?php endif; ?>
			$("#sidebar_ruang_"+ruang_sidang).addClass("active");
			dt_antrian = $("#dt_antrian").DataTable({
				order: [[2,"asc"]],
				ajax: {
					url: "<?php echo base_url('jadwal/getby/'); ?>"+ruang_sidang+"/"+jadwal_sidang,
					// url: svr+"jadwal/getby/"+ruang_sidang+"/"+jadwal_sidang,
					dataSrc: "data_jadwal",
				},
				columns: [
				{data : "id"},
				{data : null,sortable: false,render: function(data,type,row,meta){
					return "<a href='#' class='btn btn-primary panggilBtnRow'><i class='fas fa-bullhorn'></i> Pihak</a><a href='#' class='btn btn-secondary panggil_saksiBtnRow'><i class='fas fa-bullhorn'></i> Saksi</a>";
				}},
				{data : "no_antrian"},
				{data : "perkara"},
				{data : "penggugat"},
				{data : "tergugat"},
				{data : "agenda"},
				{data : "status"},
				{data : "ruang_sidang_id"},
				{data : "ruang_sidang"},
				{data : null,sortable: false,render: function(data,type,row,meta){
					return "<a href='#' class='btn btn-warning ubahBtnRow'><i class='fas fa-edit'></i>Ubah</a>";
				}},
				{data: null,sortable: false, render: function(data,type,row,meta){
					return "<a href='#' class='btn btn-danger deleteButton'><i class='fas fa-trash'></i>Hapus</a>";
				}}
				],
				columnDefs : [
				{
					targets: [0,7,8,9],
					visible: false,
				},
				{
					responsivePriority: 1,
					targets: [1,2,3],
				},
				{
					targets: [4,5,6],
					orderable: false,
				}
				],
				createdRow: function(row,data,index)
				{
					if(data['status']=="masuk")
					{
						$(row).addClass('bg-lime');
					}
				},
				responsive: true,
				autoWidth: false,
			});

			setInterval(function(){
				dt_antrian.ajax.reload(null,false);
			},30000);

			// ubah antrian
			$("#dt_antrian tbody").on("click", "tr .ubahBtnRow", function(e){
				e.preventDefault();
				var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
				var data = $("#dt_antrian").DataTable().row(currentRow).data();
				$("#ubahTitle").html("Ubah ruang sidang nomor perkara "+data['perkara']);
				$("select[name='ruang_sidang_id']").val(data['ruang_sidang_id']).change();
				$("#ubahModal").find("#ubahButton").attr("onclick","ubahData("+data['id']+")");
				$("#ubahModal").modal({backdrop: 'static', keyboard: false});
			});
			// end ubah

			// hapus antrian
			$("#dt_antrian tbody").on("click", "tr .deleteButton", function(e){
				e.preventDefault();
				// var currentRow = $(this).closest("tr");
				// var currentRow = $(this).parents("tr");
				// if(currentRow.hasClass('child'))
				// {
				// 	currentRow = currentRow.prev();
				// }
				var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
				var data = $("#dt_antrian").DataTable().row(currentRow).data();
				$("#hapusModal").find(".modal-title").text("Hapus antrian nomor perkara "+data['perkara']+"?");
				$("#hapusModal").find(".modal-body").html("<p>Nomor perkara akan muncul kembali pada menu ambil antrian untuk pihak</p>");
				$("#hapusModal").find("#deleteButton").attr("onclick", "hapusData("+data['id']+")");
				$("#hapusModal").modal({backdrop: 'static', keyboard: false});
			});
			// end hapus antrian

			// panggil pihak
			$("#dt_antrian tbody").on("click", "tr .panggilBtnRow", function(e){
				e.preventDefault();
				var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
				var data = $("#dt_antrian").DataTable().row(currentRow).data();
				panggil(data['id'],data['no_antrian'],data['perkara'], data['penggugat'], data['tergugat'],data['ruang_sidang'],data['ruang_sidang_id']);
			});
			// end panggil pihak

			// panggil saksi
			$("#dt_antrian tbody").on("click", "tr .panggil_saksiBtnRow", function(e){
				e.preventDefault();
				var currentRow = $(this).closest('li').length ? $(this).closest('li') : $(this).closest('tr');
				var data = $("#dt_antrian").DataTable().row(currentRow).data();
				panggil_saksi(data['penggugat'], data['tergugat'],data['ruang_sidang'],data['no_antrian']);
			});
			// end panggil saksi
		});
	</script>
</body>
</html>