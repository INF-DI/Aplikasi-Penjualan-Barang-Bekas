<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang Bekas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
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
        <div class="login-card">
            <h2>Login Admin</h2>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('auth/processLogin') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label visually-hidden">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= old('username') ?>">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label visually-hidden">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('user') ?>" class="btn btn-light border">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-login-submit">
                        Login <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
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