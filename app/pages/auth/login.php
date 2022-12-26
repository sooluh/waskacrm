<?php must_login(true) ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Masuk') ?></title>
    <?php render('_layouts/css') ?>
</head>

<body class="waska-body bg-white npc-general pg-auth">
    <div class="waska-app-root">
        <div class="waska-main">
            <div class="waska-wrap waska-wrap-nosidebar">
                <div class="waska-content">
                    <div class="waska-block waska-block-middle waska-auth-body wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="<?= base_url() ?>" class="logo-link">
                                <img class="logo-img logo-img-lg" src="<?= base_url('assets/img/waska.png') ?>" alt="<?= APP_NAME ?>">
                            </a>
                        </div>

                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="waska-block-head">
                                    <div class="waska-block-head-content">
                                        <h4 class="waska-block-title">Masuk</h4>
                                        <div class="waska-block-des">
                                            <p>Akses <?= APP_NAME ?> dengan nama pengguna dan kata sandi.</p>
                                        </div>
                                    </div>
                                </div>

                                <?php if (flashdata('error')) : ?>
                                    <div class="alert alert-fill alert-icon alert-danger" role="alert">
                                        <em class="icon ni ni-cross-circle"></em>
                                        <?= flashdata('error') ?>
                                    </div>
                                <?php endif ?>

                                <form action="<?= current_url(true) ?>" method="POST">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="username">Nama pengguna</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Masukkan nama pengguna" autofocus="" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Kata Sandi</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="javascript:void(0)" class="form-icon form-icon-right passcode-switch lg" data-target="password" tabindex="-1">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Masukkan kata sandi" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember" name="remember" value="1">
                                            <label class="custom-control-label" for="remember">Ingat saya</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php render('_layouts/js') ?>
</body>

</html>
