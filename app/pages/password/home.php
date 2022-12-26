<?php must_login() ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Kelola Pengguna') ?></title>
    <?php render('_layouts/css') ?>
    <?php render('_layouts/flashdata') ?>
</head>

<body class="waska-body bg-lighter npc-general has-sidebar">
    <div class="waska-app-root">
        <div class="waska-main">
            <?php render('_layouts/sidebar') ?>

            <div class="waska-wrap">
                <?php render('_layouts/header') ?>

                <div class="waska-content">
                    <div class="container-fluid">
                        <div class="waska-content-inner">
                            <div class="waska-content-body">
                                <div class="waska-block">
                                    <div class="card card-bordered">
                                        <div class="card-aside-wrap">
                                            <div class="card-inner card-inner-lg">
                                                <div class="waska-block-head waska-block-head-lg">
                                                    <div class="waska-block-between">
                                                        <div class="waska-block-head-content">
                                                            <h4 class="waska-block-title">Kata Sandi</h4>
                                                            <div class="waska-block-des">
                                                                <p>Tetapkan kata sandi unik untuk melindungi akun Anda.</p>
                                                            </div>
                                                        </div>

                                                        <div class="waska-block-head-content align-self-start d-lg-none">
                                                            <a href="javascript:void(0)" class="toggle btn btn-icon btn-trigger mt-n1" data-target="user-aside">
                                                                <em class="icon ni ni-menu-alt-r"></em>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <form action="<?= current_url(true) ?>" method="POST" class="waska-block">
                                                    <div class="row gy-4">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="password">Kata Sandi lama</label>
                                                                <input type="password" class="form-control" name="password" id="password" required="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="alert alert-fill alert-icon alert-info" role="alert">
                                                                <em class="icon ni ni-alert-circle"></em>
                                                                <p class="mb-0">Kata sandi harus terdiri dari minimal 8 karakter, terdiri dari huruf, angka, dan setidaknya satu karakter spesial.</p>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="form-label" for="newpass">Kata Sandi Baru</label>
                                                                <input type="password" class="form-control" name="newpass" id="newpass" required="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="repass">Ulangi Kata Sandi</label>
                                                                <input type="password" class="form-control" name="repass" id="repass" required="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <?php render('_partials/profile/aside') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php render('_layouts/footer') ?>
            </div>
        </div>
    </div>

    <?php render('_layouts/js') ?>
</body>

</html>
