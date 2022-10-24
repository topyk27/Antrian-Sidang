<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
    </li>
    <?php if(!$this->session->userdata("antrian_login") || $this->session->userdata("antrian_role")=="petugas")  : ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('jadwal/ambil_antrian'); ?>" class="nav-link">Ambil Antrian</a>
      </li>      
    <?php endif; ?>
    <?php if(!$this->session->userdata("antrian_login")) : ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('jadwal/monitor'); ?>" class="nav-link">Monitor</a>
      </li>
    <?php endif; ?>
    <?php if($this->session->userdata('antrian_role')=="admin") :
      $list_ruangan = $this->session->userdata('antrian_list_ruangan'); ?>
      <li class="nav-item dropdown">
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Daftar Ruangan</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
          <?php foreach($list_ruangan as $key=>$val): ?>
          <li class="dropdown-item">
            <a href="<?php echo base_url('jadwal/ruang/');echo $val->id; ?>" class="nav-link"><?php echo $val->nama; ?></a>
          </li>
        <?php endforeach; ?>
        </ul>
      </li>
    <?php endif;?>
    <?php if($this->session->userdata("antrian_role")=="operator") : ?>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('jadwal/ruang/'); echo $this->session->userdata("antrian_ruang_sidang_id"); ?>" class="nav-link"><?php echo $this->session->userdata("antrian_ruangan"); ?></a>
      </li>
    <?php endif; ?>
  </ul>
  <?php if($this->session->userdata("antrian_login")) : ?>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block text-right">
      <a href="#" id="btn-logout">
        <i class="fas fa-power-off"></i>
        <?php print_r($this->session->userdata('antrian_nama'));
        echo "<br>";
        print_r($this->session->userdata('antrian_ruangan')); ?>
      </a>
    </li>
  </ul>
  <!-- Right navbar links End-->
  <?php endif; ?>
</nav>
<?php if($this->session->userdata("antrian_login")) : ?>
<div id="modal-logout" class="modal fade" tabindex="-1" role="dialog" data-backdrop="false">
  <div class="modal-dialog modal-dialog-centered modal-confirm">
    <div class="modal-content">
      <div class="modal-header flex-column">
        <div class="icon-box">
          <i class="material-icons">exit_to_app</i>
        </div>
        <h4 class="modal-title w-100">Sign Out</h4>
      </div>
      <div class="modal-body">
        <p>Apakah anda ingin keluar?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <div class="row">
          <div class="col-6">
            <a href="<?php echo(base_url('user/logout')); ?>" class="btn btn-success btn-block" style="color:#FFF;">Keluar</a>
          </div>
          <div class="col-6">
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Batal
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    function modal_logout()
    {
      $("#modal-logout").modal('show');
    }
    document.getElementById('btn-logout').onclick=modal_logout; 
</script>
<?php endif; ?>