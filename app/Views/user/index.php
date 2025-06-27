<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Bekas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
</head>

<body>

    <header class="header-custom shadow-sm">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid px-4">
                <a class="navbar-brand text-white fs-4 fw-bold me-auto" href="<?= base_url('user') ?>">Barang Bekas</a>
                <div class="d-flex align-items-center" style="max-width: 250px;">
                    <form action="<?= base_url('user') ?>" method="get" class="search-input-container">
                        <input type="text" class="form-control" name="search" placeholder="cari jenis/nama barang" value="<?= esc($searchKeyword ?? '') ?>">
                        <i class="fas fa-search"></i>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-content-custom">
        <div class="container">
            <?php if (empty($barang)) : ?>
                <div class="alert alert-info text-center" role="alert">
                    Tidak ada barang yang tersedia saat ini.
                </div>
            <?php else : ?>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach ($barang as $item) : ?>
                        <div class="col">
                            <div class="product-card">
                                <?php if ($item['gambar']) : ?>
                                    <img src="<?= base_url('uploads/' . esc($item['gambar'])) ?>" class="card-img-top" alt="<?= esc($item['nama_barang']) ?>">
                                <?php else : ?>
                                    <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="No Image">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($item['nama_barang']) ?></h5>
                                    <p class="card-text"><b>Rp <?= number_format(esc($item['harga']), 0, ',', '.') ?></b> | <?= esc($item['jenis_barang']) ?></p>
                                    <p class="card-text description">
                                        <?= esc($item['deskripsi']) ?>
                                    </p>
                                    <?php
                                    $phone_number = '6281254349674';
                                    $nama_barang = $item['nama_barang'];
                                    $harga_barang = 'Rp' . number_format($item['harga'], 0, ',', '.');
                                    $message_text = "Halo, saya tertarik untuk membeli produk *{$nama_barang}* dengan harga {$harga_barang}. Mohon informasinya lebih lanjut.";
                                    $whatsapp_link = "https://wa.me/{$phone_number}?text=" . urlencode($message_text);
                                    ?>
                                    <a href="<?= $whatsapp_link ?>" class="btn btn-beli" target="_blank">Beli</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer-custom mt-auto">
        <div class="container">
            <span>Barang Bekas - <a href="<?= base_url('auth') ?>" class="text-white text-decoration-none">@Sardian</a></span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>