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
    </form>
</div><br>

<!-- Table with stripped rows -->
<div class="row">
    <?php foreach ($produk as $key => $item) : ?>
        <div class="col-md-4 mb-3">
            <?= form_open('keranjang') ?>
            <?php
            echo form_hidden('id', $item['id']);
            echo form_hidden('nama', $item['nama']);
            echo form_hidden('harga', $item['harga']);
            echo form_hidden('kontak', $item['kontak'] ?? '');
            echo form_hidden('domisili', $item['domisili'] ?? '');
            echo form_hidden('domisili_nama', $item['domisili_nama'] ?? '');
            echo form_hidden('foto', $item['foto']);
            ?>
            <div class="card h-100">
                <img src="<?php echo base_url() . "img/" . $item['foto'] ?>" class="card-img-top" style="max-height:300px; object-fit:cover" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $item['nama'] ?></h5>
                    <p class="mb-1"><strong>Harga: </strong><?php echo number_to_currency($item['harga'], 'IDR') ?></p>
                    <p class="mb-1"><strong>Kontak: </strong><?php echo $item['kontak'] ?></p>
                    <p class="mb-1"><strong>Domisili: </strong><?php echo $item['domisili_nama'] ?></p>
                </div>
                <div class="card-footer"></div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div>
<!-- End Table with stripped rows -->
<?= $this->endSection() ?>