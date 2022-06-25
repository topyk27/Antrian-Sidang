<script>
	const token = "<?php echo $this->session->userdata('tkn'); ?>";
	const nama_pa = "<?php echo $this->session->userdata('nama_pa'); ?>";
	const nama_pa_pendek = "<?php echo $this->session->userdata('nama_pa_pendek'); ?>";
	const base_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url('asset/js/view/_partials/token.min.js') ?>"></script>