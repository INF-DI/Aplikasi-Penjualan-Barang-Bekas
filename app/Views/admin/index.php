<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Bekas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/index-admin.css') ?>">
</head>

<body>

    <header class="header-custom shadow-sm">
        <nav class="navbar navbar-expand-lg py-2">
            <div class="container-fluid px-4">
                <a class="navbar-brand text-white fs-4 fw-bold" href="<?= base_url('user') ?>">Barang Bekas</a>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </nav>
    </header>

    <main class="main-content-custom">
        <div class="container">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <form action="<?= base_url('admin') ?>" method="get" class="search-input-container me-3">
                    <input type="text" class="form-control" name="search" placeholder="cari sesuatu..." value="<?= esc($searchKeyword ?? '') ?>"> <i class="fas fa-search"></i>
                </form>
                <a href="<?= base_url('barang/add') ?>" class="btn btn-add-custom">
                    <i class="fas fa-plus-circle fa-lg"></i> Add
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover table-custom">
                    <thead>
                        <tr>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jenis Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($barang)) : ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data barang.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($barang as $item) : ?>
                                <tr>
                                    <td><?= esc($item['nama_barang']) ?></td>
                                    <td><?= esc($item['jenis_barang']) ?></td>
                                    <td>Rp <?= number_format(esc($item['harga']), 0, ',', '.') ?></td>
                                    <td><?= esc(substr($item['deskripsi'], 0, 100)) . (strlen($item['deskripsi']) > 100 ? '...' : '') ?></td>
                                    <td>
                                        <?php if ($item['gambar']) : ?>
                                            <img src="<?= base_url('uploads/' . esc($item['gambar'])) ?>" alt="<?= esc($item['nama_barang']) ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;">
                                        <?php else : ?>
                                            <div class="product-image-placeholder">
                                                <i class="fas fa-times"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?= base_url('barang/edit/' . esc($item['id_barang'])) ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="<?= base_url('barang/delete/' . esc($item['id_barang'])) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="footer-custom mt-auto">
        <div class="container">
            <span>Barang Bekas - <a href="#" class="text-white text-decoration-none">@Sardian</a></span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>