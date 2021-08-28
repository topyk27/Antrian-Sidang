<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="<?php echo base_url(); ?>" class="nav-link" id="sidebar_home">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
      </a>
    </li>
    <?php if(!$this->session->userdata("antrian_login")) : ?>
      <li class="nav-item">
        <a href="<?php echo base_url('jadwal/ambil_antrian'); ?>" class="nav-link" id="sidebar_ambil_antrian">
          <i class="nav-icon fas fa-list"></i>
          <p>Ambil Antrian</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('jadwal/monitor'); ?>" class="nav-link" id="sidebar_monitor">
          <i class="nav-icon fas fa-desktop"></i>
          <p>Monitor</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('user/login'); ?>" class="nav-link">
          <i class="nav-icon fas fa-sign-in-alt"></i>
          <p>Sign in</p>
        </a>
      </li>
    <?php endif; ?>
    <?php if($this->session->userdata('antrian_role')=="admin") :
      $list_ruangan = $this->session->userdata('antrian_list_ruangan'); ?>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link" id="sidebar_ruang">
        <i class="nav-icon fas fa-book"></i>
        <p>Daftar Ruangan<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview">
        <?php foreach($list_ruangan as $key=>$val): ?>
        <li class="nav-item">
          <a href="<?php echo base_url('jadwal/ruang/');echo $val->id; ?>" class="nav-link" id="sidebar_ruang_<?php echo $val->id; ?>">
            <i class="nav-icon fas fa-door-closed"></i>
            <p><?php echo $val->nama; ?></p>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </li>
    <?php endif; ?>
    <?php if($this->session->userdata("antrian_role")=="operator") : ?>
      <li class="nav-item">
        <a href="<?php echo base_url('jadwal/ruang/'); echo $this->session->userdata("antrian_ruang_sidang_id"); ?>" class="nav-link" id="sidebar_ruang_<?php echo $this->session->userdata("antrian_ruang_sidang_id"); ?>">
          <i class="nav-icon fas fa-door-closed"></i>
          <p><?php echo $this->session->userdata("antrian_ruangan"); ?></p>
        </a>
      </li>
    <?php endif; ?>
    <?php if($this->session->userdata("antrian_role")=="admin"): ?>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link" id="sidebar_setting">
        <i class="nav-icon fas fa-cog"></i>
        <p>Pengaturan<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="<?php echo base_url('setting/user'); ?>" class="nav-link" id="sidebar_setting_user">
            <i class="nav-icon far fa-user"></i>
            <p>Pengguna</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('setting/sistem'); ?>" class="nav-link" id="sidebar_setting_sistem">
            <i class="nav-icon fas fa-rocket"></i>
            <p>Sistem</p>
          </a>
        </li>
      </ul>
    </li>
    <?php endif; ?>
    <?php if($this->session->userdata("antrian_login")): ?>
      <li class="nav-item">
        <a href="#" class="nav-link" id="sidebar_logout" onclick="modal_logout();">
          <i class="nav-icon fas fa-power-off"></i>
          <p>Sign out</p>
        </a>
      </li>
    <?php endif; ?>
</nav>