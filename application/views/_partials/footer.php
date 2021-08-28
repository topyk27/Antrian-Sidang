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
<footer class="main-footer">
	<div class="float-right d-none d-sm-block">
	  <b>Version</b> <?php echo $versi; ?>
	</div>
	<strong class="color-change-4x">Copyright &copy; <?php echo date("Y"); ?> <a href="https://topyk27.github.io/"><?php echo ucwords($anu); ?> </a></strong>
</footer>