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
                                                            <h4 class="waska-block-title">Informasi Personal</h4>
                                                            <div class="waska-block-des">
                                                                <p>Info dasar, seperti nama, nomor telepon dan alamat email yang digunakan.</p>
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
                                                                <label class="form-label" for="login">Nama Pengguna</label>
                                                                <input type="text" class="form-control" id="login" value="<?= logged('login') ?>" disabled="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="name">Nama Lengkap</label>
                                                                <input type="text" class="form-control" name="name" id="name" value="<?= logged('name') ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email">Alamat Surel</label>
                                                                <input type="email" class="form-control" name="email" id="email" value="<?= logged('email') ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="gender">Gender</label>
                                                                <div class="form-control-wrap d-flex" style="gap: 20px;">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="male" value="M" name="gender" class="custom-control-input" required="" <?= logged('gender') === 'M' ? 'checked' : '' ?>>
                                                                        <label class="custom-control-label" for="male">Laki-Laki</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="female" value="F" name="gender" class="custom-control-input" required="" <?= logged('gender') === 'F' ? 'checked' : '' ?>>
                                                                        <label class="custom-control-label" for="female">Perempuan</label>
                                                                    </div>
                                                                </div>
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
