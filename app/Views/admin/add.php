<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barang Bekas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/add.css') ?>" />
</head>

<body>
    <header class="header-custom shadow-sm">
        <nav class="navbar navbar-expand-lg py-2">
            <div class="container-fluid px-4">
                <a class="navbar-brand text-white fs-4 fw-bold" href="<?= base_url('user') ?>">Barang Bekas</a>
            </div>
        </nav>
    </header>

    <main class="main-content-custom">
        <div class="add-data-card">
            <div class="card-header">
                <h2>Add Data</h2>
                <a href="<?= base_url('admin') ?>" class="btn btn-back-custom">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            <?php if (session()->getFlashdata('validation')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('validation')->listErrors() ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('barang/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="input-group-row">
                    <div class="form-group-item">
                        <label for="namaBarang" class="form-label visually-hidden">Nama Barang</label>
                        <input type="text" class="form-control" id="namaBarang" name="nama_barang" placeholder="Nama Barang" value="<?= old('nama_barang') ?>" />
                    </div>
                    <div class="form-group-item">
                        <label for="harga" class="form-label visually-hidden">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= old('harga') ?>" />
                    </div>
                </div>

                <div class="input-group-row">
                    <div class="form-group-item">
                        <label for="jenisBarang" class="form-label visually-hidden">Jenis Barang</label>
                        <input type="text" class="form-control" id="jenisBarang" name="jenis_barang" placeholder="Jenis Barang" value="<?= old('jenis_barang') ?>" />
                    </div>
                    <div class="form-group-item">
                        <label for="gambar" class="form-label visually-hidden">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" />
                    </div>
                </div>

                <div class="input-group-row">
                    <div class="form-group-item">
                        <label for="deskripsi" class="form-label visually-hidden">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi"><?= old('deskripsi') ?></textarea>
                    </div>
                    <div class="form-group-item">
                        <button type="submit" class="btn btn-save-custom">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer-custom mt-auto">
        <div class="container">
            <span>Barang Bekas -
                <a href="#" class="text-white text-decoration-none">@Sardian</a></span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>