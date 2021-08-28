<!DOCTYPE html>
<html lang="ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Monitor Antrian Sidang</title>
	<?php $this->load->view("_partials/css.php") ?>
	<style type="text/css">
		body{background: linear-gradient(45deg, #f79d00, #64f38c);}
		.navbar-light,.main-footer{background-color: transparent;}
		
		.main-header { border-bottom: none; }
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
								<div id="mycarousel" class="carousel slide" data-ride="carousel">
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
									<?php $no=1; foreach($data_ruangan as $key=>$val): ?>
									
										<div class="carousel-item <?php echo ($no==1) ? 'active' : ''; ?>" data-interval="5000">
											<div class="card card-<?php echo ion($no); ?>">
												<div class="card-header">
													<h3 class="text-center"><?php echo $val->nama; ?></h3>
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
									<?php $no++; endforeach; ?>
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
						<div class="card">
							<div class="card-body">
								<div class="embed-responsive embed-responsive-16by9">
									<!-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/rcWnaydRulo?autoplay=1" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php 
		$this->config->load('antrian_config',TRUE);
		$versi = $this->config->item('version','antrian_config');
		function cpr($x)
		{
			$a = "a";
			for($n=0;$n<$x;$n++)
			{
				++$a;
			}
			return $a;
		}

		$anu = "";
		$num = [19,0,20,5,8,10,27,3,22,8,27,22,0,7,24,20,27,15,20,19,17,0];
		foreach($num as $val)
		{
			if($val == 27)
			{
				$anu = $anu." ";
			}
			else
			{
				$anu = $anu.cpr($val);
			}
		}
	 ?>
	<aside class="control-sidebar control-sidebar-dark"></aside>
	<footer class="main-footer">
		<div class="float-right d-none d-sm-inline">
		  <b>Version</b> <?php echo $versi; ?>
		</div>
		<strong class="color-change-4x">Copyright &copy; <?php echo date("Y"); ?> <a href="https://topyk27.github.io/"><?php echo ucwords($anu); ?> </a></strong>
	</footer>
	</div>
	<!-- jQuery -->
	<script src="<?php echo base_url('asset/js/jquery/jquery.min.js') ?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('asset/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('asset/dist/js/adminlte.min.js') ?>"></script>
	<!-- ResponsiveVoice -->
	<script src="https://code.responsivevoice.org/responsivevoice.js?key=6UoEN13s"></script>
	<script type="text/javascript">
		<?php 
			$this->config->load('antrian_config',TRUE);
			$panggil = $this->config->item('panggil','antrian_config');
		 ?>
		const panggil_melalui = "<?php echo $panggil; ?>"
		function getData() {
			$.ajax({
				url: "<?php echo base_url('jadwal/data_monitor'); ?>",
				method: "GET",
				dataType: "JSON",
				success: function(data)
				{
					for(var i=0;i<data.length;i++)
					{
						var obj = data[i];
						$("#antrian"+obj.ruang_sidang_id).html(obj.no_antrian);
						$("#no_perkara"+obj.ruang_sidang_id).html(obj.perkara);
					}
				}
			});
		}

		function cek_panggilan() {
			$.ajax({
				url: "<?php echo base_url('jadwal/panggil'); ?>",
				method: "GET",
				dataType: "JSON",
				success: function(data)
				{
					if(data.success==1)
					{
						memanggil_antrian(data.id,data.text,data.no_antrian,data.ruangan);
					}
					else
					{
						setTimeout(cek_panggilan,3000);
					}
				}
			});
		}

		function memanggil_antrian(id,text,no_antrian,ruangan) {
			voice = "Indonesian Male";
			rate = 1;
			$("#pemanggilan_title").text("Dipanggil");
			$("td#no_antrian_dipanggil").text(no_antrian);
			$("td#ruangan_dipanggil").text(ruangan);
			$("#pemanggilan").show();
			responsiveVoice.speak(text,voice,{rate: rate, onend: function(){
				hapus_panggilan(id);
			}});
		}

		function hapus_panggilan(id) {
			$.ajax({
				url: "<?php echo base_url('jadwal/hapus_panggilan'); ?>",
				method: "POST",
				data: {id:id},
				dataType: "TEXT",
				success: function(data)
				{
					if(data==1)
					{
						$("#pemanggilan").hide();
						setTimeout(cek_panggilan,3000);
					}
					else
					{
						location.reload();
					}
				}
			});
		}

		$(document).ready(function(){
			setInterval(getData,3000);
			if(panggil_melalui=="luar")
			{
				setTimeout(cek_panggilan,5000);
			}
		});
	</script>
</body>
</html>