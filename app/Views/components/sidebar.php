  <?php $kategoriAktif = $_GET['kategori'] ?? ''; ?>
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar bg-danger-subtle">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link bg-danger-subtle <?php echo (uri_string() == '') ? "" : "collapsed" ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="/">
          <i class="bi bi-handbag"></i>
          <span>Beranda</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li class="nav-item">
            <a class="<?= $kategoriAktif == '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">
              <i class="bi bi-circle"></i><span>Semua Kategori</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="<?= $kategoriAktif == 'Pakaian' ? 'active' : '' ?>" href="<?= base_url('/?kategori=Pakaian') ?>">
              <i class="bi bi-circle"></i><span>Pakaian</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="<?= $kategoriAktif == 'Elektronik' ? 'active' : '' ?>" href="<?= base_url('/?kategori=Elektronik') ?>">
              <i class="bi bi-circle"></i><span>Elektronik</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="<?= $kategoriAktif == 'Aksesoris' ? 'active' : '' ?>" href="<?= base_url('/?kategori=Aksesoris') ?>">
              <i class="bi bi-circle"></i><span>Aksesoris</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="<?= $kategoriAktif == 'Buku' ? 'active' : '' ?>" href="<?= base_url('/?kategori=Buku') ?>">
              <i class="bi bi-circle"></i><span>Buku</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="<?= $kategoriAktif == 'Peralatan Rumah' ? 'active' : '' ?>" href="<?= base_url('/?kategori=Peralatan Rumah') ?>">
              <i class="bi bi-circle"></i><span>Peralatan Rumah</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="<?= $kategoriAktif == 'Lainnya' ? 'active' : '' ?>" href="<?= base_url('/?kategori=Lainnya') ?>">
              <i class="bi bi-circle"></i><span>Lainnya</span>
            </a>
          </li>
        </ul>
      </li><!-- End Home Nav -->

      <?php
      if (!session()->has('isLoggedIn')) {
      ?>
        <li class="nav-item">
          <a class="nav-link bg-danger-subtle <?php echo (uri_string() == 'login') ? "" : "collapsed" ?>" href="login">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Profil (Log in)</span>
          </a>
        </li>
      <?php
      }
      ?>

      <?php
      if (session()->has('isLoggedIn')) {
      ?>
        <li class="nav-item">
          <a class="nav-link bg-danger-subtle <?php echo (uri_string() == 'profil') ? "" : "collapsed" ?>" href="profil">
            <i class="bi bi-person"></i>
            <span>Profil</span>
          </a>
        </li><!-- End Produk Nav -->
      <?php
      }
      ?>

      <li class="nav-item">
          <a class="nav-link bg-danger-subtle <?php echo (uri_string() == 'kontak') ? "" : "collapsed" ?>" href="kontak">
            <i class="bi bi-envelope"></i>
            <span>Kontak Kami</span>
          </a>
        </li>

    </ul>

  </aside><!-- End Sidebar-->