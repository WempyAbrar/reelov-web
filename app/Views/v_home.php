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

<div class="search-bar">
    <form method="get" action="<?= base_url('/') ?>">
        <div class="row g-2">
            <div class="col-md-6">
              <input type="text" name="nama" value="<?= esc($nama ?? '') ?>" placeholder="Nama barang" class="form-control">
            </div>
            <div class="col-md-4">
              <input type="text" name="domisili" value="<?= esc($domisili_nama ?? '') ?>" placeholder="Domisili (Kecamatan)" class="form-control">
            </div>
            <div class="col-md-2">
              <button class="btn btn-primary w-100" type="submit">Cari <i class="bi bi-search"></i></button>
            </div>
        </div>
        <?php if (!empty($kategori_aktif)): ?>
            <input type="hidden" name="kategori" value="<?= esc($kategori_aktif) ?>">
        <?php endif; ?>
    </form>
</div><br>

<!-- Table with stripped rows -->
<div class="row">
  <?php if (!empty($produk)): ?>
    <?php foreach ($produk as $key => $item) : ?>
        <div class="col-md-4 mb-3">
            <?php
            echo form_hidden('id', $item['id']);
            echo form_hidden('nama', $item['nama']);
            echo form_hidden('harga', $item['harga']);
            echo form_hidden('deskripsi', $item['deskripsi']);
            echo form_hidden('kontak', $item['kontak'] ?? '');
            echo form_hidden('domisili', $item['domisili'] ?? '');
            echo form_hidden('domisili_nama', $item['domisili_nama'] ?? '');
            echo form_hidden('foto', $item['foto']);
            ?>
            <div class="card h-100">
                <img src="<?php echo base_url() . "img/" . $item['foto'] ?>" class="card-img-top" style="max-height:300px; object-fit:cover" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $item['nama'] ?></h5>
                    <p class="mb-1"><strong>Harga: </strong>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></p>
                    <p class="mb-1"><strong>Kontak: </strong><?php echo $item['kontak'] ?></p>
                    <p class="mb-1"><strong>Domisili: </strong><?php echo $item['domisili_nama'] ?></p>
                </div>
                <div class="card-footer text-center">
                  <?php if (!empty($item['wa'])): ?>
                    <a href="<?= esc($item['wa']); ?>" target="_blank" class="btn btn-success btn-sm">
                      <i class="bi bi-whatsapp"></i>
                    </a>
                  <?php endif; ?>

                  <?php if (!empty($item['fb'])): ?>
                    <a href="<?= esc($item['fb']); ?>" target="_blank" class="btn btn-primary btn-sm">
                      <i class="bi bi-facebook"></i>
                    </a>
                  <?php endif; ?>

                  <?php if (!empty($item['ig'])): ?>
                    <a href="<?= esc($item['ig']); ?>" target="_blank" class="btn btn-danger btn-sm">
                      <i class="bi bi-instagram"></i>
                    </a>
                  <?php endif; ?>
                    <button 
                        type="button" 
                        class="btn text-light btn-sm btn-deskripsi"
                        style="background-color: #2e324d;"
                        data-nama="<?= esc($item['nama']); ?>"
                        data-harga="Rp <?= number_format($item['harga'], 0, ',', '.'); ?>"
                        data-kategori="<?= esc($item['kategori']); ?>"
                        data-deskripsi="<?= esc($item['deskripsi']); ?>"
                        data-username="<?= esc($item['username'] ?? ''); ?>"
                        data-wa="<?= esc($item['wa'] ?? ''); ?>"
                        data-fb="<?= esc($item['fb'] ?? ''); ?>"
                        data-ig="<?= esc($item['ig'] ?? ''); ?>"
                        data-bs-toggle="modal" 
                        data-bs-target="#deskripsiModal">
                        <i class="bi bi-card-text"></i> Detail
                    </button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
  <?php else: ?>
    <p>Tidak ada produk ditemukan.</p><br><br><br>
  <?php endif; ?>
</div>
<!-- End Table with stripped rows -->

<!-- Modal Deskripsi Dinamis -->
<div class="modal fade" id="deskripsiModal" tabindex="-1" aria-labelledby="deskripsiLabel">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger-subtle text-white">
        <h5 class="modal-title text-dark" id="deskripsiLabel">Deskripsi Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6 id="modalNama"></h6>
        <p><strong>Harga:</strong> <span id="modalHarga"></span></p>
        <p><strong>Kategori:</strong> <span id="modalKategori"></span></p>
        <p><strong>Penjual:</strong> @<span id="modalUsername"></span></p>
        <hr>
        <p id="modalDeskripsi"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const buttons = document.querySelectorAll('.btn-deskripsi');

  const modalNama = document.getElementById('modalNama');
  const modalHarga = document.getElementById('modalHarga');
  const modalKategori = document.getElementById('modalKategori');
  const modalDeskripsi = document.getElementById('modalDeskripsi');
  const modalUsername = document.getElementById('modalUsername');
  const modalSosmed = document.getElementById('modalSosmed');

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      modalNama.textContent = btn.getAttribute('data-nama');
      modalHarga.textContent = btn.getAttribute('data-harga');
      modalKategori.textContent = btn.getAttribute('data-kategori');
      modalDeskripsi.textContent = btn.getAttribute('data-deskripsi');
      modalUsername.textContent = btn.getAttribute('data-username');
    });
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