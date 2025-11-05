<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<?php
if (session()->getFlashData('failed')) {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="<?= base_url()?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?= session()->get('username'); ?></h2>
              <h3>Penjual</h3>
              <div class="social-links mt-2">
                <?php if (!empty($user['wa'])) : ?>
                  <a href="<?= esc($user['wa']) ?>" target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
                <?php endif; ?>

                <?php if (!empty($user['fb'])) : ?>
                  <a href="<?= esc($user['fb']) ?>" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                <?php endif; ?>

                <?php if (!empty($user['ig'])) : ?>
                  <a href="<?= esc($user['ig']) ?>" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                <?php endif; ?>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <div class="scroll-x">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-product">Produk</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Password</button>
                </li>

              </ul>
              </div>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active scroll-x profile-product" id="profile-product">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Barang
</button>

<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Foto</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($product as $index => $produk) : ?>
            <tr>
                <th scope="row"><?php echo $index + 1 ?></th>
                <td><?php echo $produk['nama'] ?></td>
                <td><?php echo $produk['harga'] ?></td>
                <td>
                    <?php if ($produk['foto'] != '' and file_exists("img/" . $produk['foto'] . "")) : ?>
                        <img src="<?php echo base_url() . "img/" . $produk['foto'] ?>" width="100px">
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id'] ?>">
                      Ubah
                    </button>
                    <a href="<?= base_url('produk/delete/' . $produk['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                      Hapus
                    </a>
                </td>
            </tr>
<!-- Edit Modal Begin -->
<div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Keterangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('produk/edit/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="<?= esc($produk['nama']) ?>" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <div>
                          <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                            <option selected><?= esc($produk['kategori']) ?></option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Aksesoris">Aksesoris</option>
                            <option value="Buku">Buku</option>
                            <option value="Peralatan Rumah">Peralatan Rumah</option>
                            <option value="Lainnya">Lainnya</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" name="deskripsi" class="form-control" id="deskripsi" style="height: 100px" required><?= esc($produk['deskripsi']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" class="form-control" id="harga" value="<?= esc($produk['harga']) ?>" placeholder="Harga Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <input type="text" name="kontak" class="form-control" id="kontak" value="<?= esc($produk['kontak']) ?>" placeholder="Kontak Pemilik" required>
                    </div>
                    <img src="<?php echo base_url() . "img/" . $produk['foto'] ?>" width="100px">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                        <label class="form-check-label" for="check">
                            Ceklis jika ingin mengganti foto
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal End -->
        <?php endforeach ?>
    </tbody>
</table>
<!-- End Table with stripped rows --> 

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="<?= base_url('profil/update') ?>" method="post">
                    <div class="row mb-3">
                      <label class="col-md-4 col-lg-3 col-form-label">Gambar Profil</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?= base_url()?>NiceAdmin/assets/img/profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nama_lengkap" type="text" class="form-control" id="fullName" value="<?= esc($user['nama_lengkap'] ?? '') ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?= esc($user['email'] ?? '') ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Whatsapp" class="col-md-4 col-lg-3 col-form-label">Link Whatsapp</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="wa" type="text" class="form-control" id="Whatsapp" value="<?= esc($user['wa'] ?? '') ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Link Facebook</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fb" type="text" class="form-control" id="Facebook" value="<?= esc($user['fb'] ?? '') ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Link Instagram</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="ig" type="text" class="form-control" id="Instagram" value="<?= esc($user['ig'] ?? '') ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Saat Ini</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Masukkan Kembali Password Baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
<?= $this->endSection() ?>

<?= $this->section('modals') ?>
<!-- Add Modal Begin -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <div>
                          <select class="form-select" name="kategori" id="kategori" aria-label="Default select example" required>
                            <option selected>Pilih kategori barang</option>
                            <option value="Pakaian">Pakaian</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Aksesoris">Aksesoris</option>
                            <option value="Buku">Buku</option>
                            <option value="Peralatan Rumah">Peralatan Rumah</option>
                            <option value="Lainnya">Lainnya</option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text" name="deskripsi" class="form-control" id="deskripsi" style="height: 100px" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <input type="text" name="kontak" class="form-control" id="kontak" placeholder="Kontak Pemilik" required>
                    </div>
                    <div class="form-group">
                        <label for="domisili">Domisili</label>
                        <select type="text" class="form-control" id="domisili" name="domisili" required></select>
                        <input type="hidden" name="domisili_nama" id="domisili_nama">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Modal End -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    $('#domisili').select2({
    placeholder: 'Ketik nama kecamatan...',
    ajax: {
        url: '<?= base_url('get-location') ?>',
        dataType: 'json',
        delay: 1500,
        data: function (params) {
            return {
                search: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data.map(function(item) {
                return {
                    id: item.id,
                    text: item.district_name + ", " + item.city_name + ", " + item.province_name
                };
                })
            };
        },
        cache: true
    },
    minimumInputLength: 3,
    allowClear: true,
    dropdownParent: $('#addModal')
    });
    
    $('#domisili').on('select2:select', function (e) {
    var data = e.params.data;
    console.log('Dipilih:', data.text); // debug
    $('#domisili_nama').val(data.text); // isi input hidden
    });
});

const modals = document.querySelectorAll('.modal');
modals.forEach(modal => {
  modal.addEventListener('show.bs.modal', () => {
    document.querySelectorAll('.wavy').forEach(el => el.style.webkitMask = 'none');
  });
  modal.addEventListener('hidden.bs.modal', () => {
    document.querySelectorAll('.wavy').forEach(el => el.style.webkitMask = '');
  });
});

</script>
<?= $this->endSection() ?>