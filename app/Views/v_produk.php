<?= $this->extend('layout') ?>
<?= $this->section('content') ?> 
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
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
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>
<a type="button" class="btn btn-success" href="<?= base_url() ?>produk/download">
    Download data
</a>

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
                        <label for="name">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $produk['nama'] ?>" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                          <select class="form-select" name="kategori" id="kategori" aria-label="Default select example">
                            <option selected><?= $produk['kategori'] ?></option>
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
                        <label for="name">Deskripsi</label>
                        <textarea type="text" name="deskripsi" class="form-control" id="deskripsi" style="height: 100px" required><?= $produk['deskripsi'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Harga</label>
                        <input type="text" name="harga" class="form-control" id="harga" value="<?= $produk['harga'] ?>" placeholder="Harga Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Kontak</label>
                        <input type="text" name="kontak" class="form-control" id="kontak" value="<?= $produk['kontak'] ?>" placeholder="Kontak Pemilik" required>
                    </div>
                    <img src="<?php echo base_url() . "img/" . $produk['foto'] ?>" width="100px">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                        <label class="form-check-label" for="check">
                            Ceklis jika ingin mengganti foto
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="name">Foto</label>
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
                        <label for="name">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
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
                        <label for="name">Deskripsi</label>
                        <textarea type="text" name="deskripsi" class="form-control" id="deskripsi" style="height: 100px" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Harga</label>
                        <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga Barang" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Kontak</label>
                        <input type="text" name="kontak" class="form-control" id="kontak" placeholder="Kontak Pemilik" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Foto</label>
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