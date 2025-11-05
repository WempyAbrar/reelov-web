  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #fffff0">

    <div class="d-flex align-items-center justify-content-between">
      <a href="https://www.instagram.com/reelov.shop/" target="_blank" class="logo d-flex align-items-center">
        <img src="<?= base_url()?>NiceAdmin/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Reelov</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= base_url()?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('username'); ?></span>
          </a><!-- End Profile Iamge Icon -->

          <?php
          if (!session()->has('isLoggedIn')) {
          ?>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6>Pengunjung</h6>
                
              </li>
              
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="login">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <span>Log in</span>
                </a>
              </li>
            </ul>
          <?php
          }
          else {
          ?>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?= session()->get('username'); ?></h6>
                <span>Penjual</span>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li>
                <a class="dropdown-item d-flex align-items-center" href="logout">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Log out</span>
                </a>
              </li>
            </ul><!-- End Profile Dropdown Items -->
          <?php
          }
          ?>

        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->