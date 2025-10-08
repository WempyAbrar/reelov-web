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

<!-- Table with stripped rows -->
<div class="row">
    <?php foreach ($product as $key => $item) : ?>
        <div class="col-md-4 mb-3">
            <?= form_open('keranjang') ?>
            <?php
            echo form_hidden('id', $item['id']);
            echo form_hidden('nama', $item['nama']);
            echo form_hidden('harga', $item['harga']);
            echo form_hidden('foto', $item['foto']);
            ?>
            <div class="card h-100">
                <img src="<?php echo base_url() . "img/" . $item['foto'] ?>" class="card-img-top" style="max-height:300px; object-fit:cover" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $item['nama'] ?></h5>
                    <p class="mb-1"><strong>Harga: </strong><?php echo number_to_currency($item['harga'], 'IDR') ?></p>
                    <p class="mb-1"><strong>Kontak: </strong></p>
                    <p class="mb-1"><strong>Domisili: </strong></p>
                </div>
                <div class="card-footer"></div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div>
<!-- End Table with stripped rows -->
<?= $this->endSection() ?>