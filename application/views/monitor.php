<!DOCTYPE html>
<html lang="ID">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Monitor Antrian Sidang</title>
	<?php $this->load->view("_partials/css.php") ?>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/plugin/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
	<style type="text/css">
		body {
			background: linear-gradient(45deg, #f79d00, #64f38c);
		}

		.navbar-light,
		.main-footer {
			background-color: transparent;
		}

		.main-header {
			border-bottom: none;
		}
	</style>
</head>

<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		<nav class="main-header navbar navbar-expand-md navbar-light">
			<div class="container">
				<a href="<?php echo base_url(); ?>" class="navbar-brand">
					<img src="<?php echo base_url('asset/img/logo.png'); ?>" class="brand-image img-circle elevation-3" style="opacity: .8; height: 15vh;">
					<span class="h1 font-weight-normal font-italic">PA <?php echo $this->session->userdata('nama_pa'); ?></span>
				</a>
				<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
					<li class="nav-item">
						<span class="h1 font-weight-normal font-italic">Antrian Sidang</span>
					</li>
				</ul>
			</div>
		</nav>
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="row">
							<div class="col-md-12">
								<div id="mycarousel" class="carousel slide" data-ride="carousel"  data-interval="10000" data-pause="false">
									<div class="carousel-inner">
										<?php
										function ion($n)
										{
											switch ($n) {
												case '1':
													return 'primary';
													break;
												case '2':
													return 'secondary';
													break;
												case '3':
													return 'info';
													break;
												case '4':
													return 'success';
													break;
												case '5':
													return 'warning';
													break;
												default:
													return 'danger';
													break;
											}
										}
										?>
										<?php $no = 1;
										foreach ($data_ruangan as $key => $val) : ?>

											<div class="carousel-item <?php echo ($no == 1) ? 'active' : ''; ?>">
												<div class="card card-<?php echo ion($no); ?>">
													<div class="card-header">
														<h2 class="text-center">Antrian Masuk<br><?php echo $val->nama; ?></h2>
													</div>
													<div class="card-body">
														<table class="table table-bordered table-hover">
															<thead>
																<tr class="h4 text-center">
																	<th>NO.</th>
																	<th>Perkara</th>
																</tr>
															</thead>
															<tbody>
																<tr class="h4 text-center">
																	<td id="antrian<?php echo $val->id; ?>">Belum</td>
																	<td id="no_perkara<?php echo $val->id; ?>">Dimulai</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										<?php $no++;
										endforeach; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="row" id="pemanggilan" style="display: none;">
							<div class="col-md-12">
								<div class="card card-success">
									<div class="card-header">
										<h3 class="text-center" id="pemanggilan_title">Dipanggil</h3>
									</div>
									<div class="card-body">
										<table class="table">
											<thead>
												<tr class="h4 text-center">
													<th id="th_antrian">Antrian</th>
													<th id="th_ruangan">Ke</th>
												</tr>
											</thead>
											<tbody>
												<tr class="h4 text-center">
													<td id="no_antrian_dipanggil">27</td>
													<td id="ruangan_dipanggil">Ruang Sidang II</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-8">
						<div id="carousel-table" class="carousel slide" data-ride="carousel" style="max-height: 75vh;"  data-interval="10000" data-pause="false">
							<div class="carousel-inner">
								<?php $a = 1;
								foreach ($data_ruangan as $key => $val) : ?>
									<div class="carousel-item <?php echo ($a == 1) ? 'active' : ''; ?>" >
										<div class="card card-<?php echo ion($a); ?>">
											<div class="card-header">
												<h2 class="text-center">Daftar Antrian Sidang<br><?php echo $val->nama; ?></h2>
											</div>
											<div class="card-body">
												<table id="dt_<?php echo $val->id; ?>" class="table table-bordered table-hover">
													<thead>
														<tr>
															<th></th>
															<th>NO.</th>
															<th>Perkara</th>
															<th>Penggugat</th>
															<th>Tergugat</th>
														</tr>
													</thead>
													<tbody></tbody>
												</table>
											</div>
										</div>
									</div>
								<?php $a++;
								endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$this->config->load('antrian_config', TRUE);
		$versi = $this->config->item('version', 'antrian_config');
		function cpr($x)
		{
			$a = "a";
			for ($n = 0; $n < $x; $n++) {
				++$a;
			}
			return $a;
		}

		$anu = "";
		$num = [19, 0, 20, 5, 8, 10, 27, 3, 22, 8, 27, 22, 0, 7, 24, 20, 27, 15, 20, 19, 17, 0];
		foreach ($num as $val) {
			if ($val == 27) {
				$anu = $anu . " ";
			} else {
				$anu = $anu . cpr($val);
			}
		}
		?>
		<aside class="control-sidebar control-sidebar-dark"></aside>
		<footer class="main-footer">
			<div class="float-right d-none d-sm-inline">
				<b>Version</b> <?php echo $versi; ?>
			</div>
			<strong class="color-change-4x">Copyright &copy; <?php echo date("Y"); ?> <a href="https://topyk27.github.io/"><?php echo ucwords($anu); ?> </a> and <a href="https://responsivevoice.org/">ResponsiveVoice.JS</a> Text to Speech</strong>
		</footer>
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
		var jumlah_ruangan = [];
		<?php
		$this->config->load('antrian_config', TRUE);
		$panggil = $this->config->item('panggil', 'antrian_config');
		$rsvc = $this->config->item('rsvc', 'antrian_config');
		?>
		<?php foreach ($data_ruangan as $key => $val) : ?>
			jumlah_ruangan.push(<?php echo $val->id; ?>);
			var dt_<?php echo $val->id; ?>;
		<?php endforeach; ?>
		var rsvc = <?php echo $rsvc; ?>;
		const panggil_melalui = "<?php echo $panggil; ?>";
		const base_url = "<?php echo base_url(); ?>";

		var msg = new SpeechSynthesisUtterance();
		var suara;
		var myTimeout;
		function myTimer()
		{
			speechSynthesis.pause();
			speechSynthesis.resume();
			myTimeout = setTimeout(myTimer, 10000);
		}
		if(rsvc==false)
		{
			setTimeout(() => {		
				suara = window.speechSynthesis.getVoices();		
				msg.voice = suara[11];	
				msg.lang = 'in-ID';
				msg.rate = 0.9;		
			}, 1000);
		}
		function getData() {
			$.ajax({
				url: base_url +'jadwal/data_monitor',
				method: "GET",
				dataType: "JSON",
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						var obj = data[i];
						$("#antrian" + obj.ruang_sidang_id).html(obj.no_antrian);
						$("#no_perkara" + obj.ruang_sidang_id).html(obj.perkara);
					}
				}
			});
		}

		function cek_panggilan() {
			$.ajax({
				url: base_url+'jadwal/panggil',
				method: "GET",
				dataType: "JSON",
				success: function(data) {
					if (data.success == 1) {
						memanggil_antrian(data.id, data.text, data.no_antrian, data.ruangan);
					} else {
						setTimeout(cek_panggilan, 3000);
					}
				}
			});
		}

		function memanggil_antrian(id, text, no_antrian, ruangan) {
			voice = "Indonesian Male";
			rate = 1;
			$("#pemanggilan_title").text("Dipanggil");
			$("td#no_antrian_dipanggil").text(no_antrian);
			$("td#ruangan_dipanggil").text(ruangan);
			$("#pemanggilan").show();
			if(rsvc!=false)
			{
				responsiveVoice.speak(text, voice, {
					rate: rate,
					onend: function() {
						hapus_panggilan(id);
					}
				});
			}
			else
			{
				myTimeout = setTimeout(myTimer, 10000);
				msg.text = text;
				msg.onend = function()
				{
					clearTimeout(myTimeout);
					hapus_panggilan(id);
				}
				speechSynthesis.speak(msg);
			}
		}

		function hapus_panggilan(id) {
			$.ajax({
				url: base_url+'jadwal/hapus_panggilan',
				method: "POST",
				data: {
					id: id
				},
				dataType: "TEXT",
				success: function(data) {
					if (data == 1) {
						$("#pemanggilan").hide();
						setTimeout(cek_panggilan, 3000);
					} else {
						location.reload();
					}
				}
			});
		}

		$(document).ready(function() {
			setInterval(getData, 3000);
			if (panggil_melalui == "luar") {
				setTimeout(cek_panggilan, 5000);
			}

			<?php
			$hari_ini = date("Y-m-d");
			foreach ($data_ruangan as $key => $val) :
			?>
				dt_<?php echo $val->id; ?> = $("#dt_<?php echo $val->id; ?>").DataTable({
					order: [
						[1, "asc"]
					],
					ajax: {
						url: "<?php echo base_url('jadwal/monitor_getBy/' . $val->id . '/' . $hari_ini); ?>",
						dataSrc: "data_jadwal"
					},
					columns: [{
							data: "id"
						},
						{
							data: "no_antrian",
						},
						{
							data: "perkara"
						},
						{
							data: "penggugat"
						},
						{
							data: "tergugat"
						}
					],
					columnDefs: [{
							targets: [0],
							visible: false,
						},
						{
							responsivePriority: 1,
							targets: [2, 3, 4],
						}
					],
					createdRow: function(row, data, index) {
						if (data['status'] == "masuk") {
							$(row).addClass('bg-lime');
						}
					},
					paging: false,
					searching: false,
					bInfo: false,
					scrollY: '45vh',
					responsive: false,
					autoWidth: true,
				});
			<?php endforeach; ?>
			$("#carousel-table").on('slid.bs.carousel', function() {
				<?php foreach ($data_ruangan as $key => $val) : ?>
					dt_<?php echo $val->id; ?>.ajax.reload(null,false);
					dt_<?php echo $val->id; ?>.columns.adjust().draw();
				<?php endforeach; ?>
			});
			
		});
	</script>
</body>

</html>