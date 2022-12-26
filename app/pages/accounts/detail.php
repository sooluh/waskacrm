<?php

must_login();

$uid = input_get('uid');
$account = $db->query(
    "SELECT accounts.*, users.name AS assigned FROM accounts " .
        "LEFT JOIN users ON users.id = accounts.assigned " .
        "WHERE accounts.id = '$uid' AND accounts.deleted_at IS NULL"
)->fetch_object();

if (empty($uid) || empty($account)) {
    go('404');
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Detail Account') ?></title>
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
                                <div class="wide-md mx-auto">
                                    <div class="waska-block-head waska-block-head-lg wide-sm pb-4">
                                        <div class="waska-block-head-content">
                                            <div class="waska-block-head-sub mb-0">
                                                <a class="back-to" href="<?= base_url('accounts') ?>">
                                                    <em class="icon ni ni-arrow-left"></em>
                                                    <span>Accounts</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="waska-block-head-content mt-1">
                                            <h3 class="title waska-block-title">Detail Account</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="waska-block row">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-inner row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="name">Nama</label>
                                                        <div class="d-block">
                                                            <span><?= $account->name ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="website">Website</label>
                                                        <div class="d-block">
                                                            <?php if ($account->website) : ?>
                                                                <a href="<?= $account->website ?>" target="_blank">
                                                                    <?= $account->website ?>
                                                                </a>
                                                            <?php else : ?>
                                                                <mark>Tidak Ada</mark>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="email">Surel</label>
                                                        <div class="d-block">
                                                            <?php if ($account->email) : ?>
                                                                <a href="mailto:<?= $account->email ?>">
                                                                    <?= $account->email ?>
                                                                </a>
                                                            <?php else : ?>
                                                                <mark>Tidak Ada</mark>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="phone_number">Telepon</label>
                                                        <div class="d-block">
                                                            <?php if ($account->phone_number) : ?>
                                                                <a href="tel:<?= $account->phone_number ?>">
                                                                    <?= $account->phone_number ?>
                                                                </a>
                                                                <small class="text-muted">
                                                                    <?= phone_type($account->phone_type) ?>
                                                                </small>
                                                            <?php else : ?>
                                                                <mark>Tidak Ada</mark>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="billing" class="form-label text-muted fw-normal mb-0">Alamat Tagihan</label>
                                                        <?php if ($account->billing_street) : ?>
                                                            <div class="d-block">
                                                                <span><?= $account->billing_street ?></span>
                                                            </div>
                                                        <?php endif ?>
                                                        <div class="d-block">
                                                            <?php if ($account->billing_city) : ?>
                                                                <span><?= $account->billing_city ?></span>
                                                            <?php endif ?>
                                                            <?php if ($account->billing_state) : ?>
                                                                <span><?= $account->billing_state ?></span>
                                                            <?php endif ?>
                                                            <?php if ($account->billing_zip) : ?>
                                                                <span><?= $account->billing_zip ?></span>
                                                            <?php endif ?>
                                                        </div>
                                                        <?php if ($account->billing_country) : ?>
                                                            <div class="d-block">
                                                                <span><?= $account->billing_country ?></span>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="shipping" class="form-label text-muted fw-normal mb-0">Alamat Pengiriman</label>
                                                        <?php if ($account->shipping_street) : ?>
                                                            <div class="d-block">
                                                                <span><?= $account->shipping_street ?></span>
                                                            </div>
                                                        <?php endif ?>
                                                        <div class="d-block">
                                                            <?php if ($account->shipping_city) : ?>
                                                                <span><?= $account->shipping_city ?></span>
                                                            <?php endif ?>
                                                            <?php if ($account->shipping_state) : ?>
                                                                <span><?= $account->shipping_state ?></span>
                                                            <?php endif ?>
                                                            <?php if ($account->shipping_zip) : ?>
                                                                <span><?= $account->shipping_zip ?></span>
                                                            <?php endif ?>
                                                        </div>
                                                        <?php if ($account->shipping_country) : ?>
                                                            <div class="d-block">
                                                                <span><?= $account->shipping_country ?></span>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="type">Tipe</label>
                                                        <div class="d-block">
                                                            <?php if ($account->type) : ?>
                                                                <span><?= account_type($account->type) ?></span>
                                                            <?php else : ?>
                                                                <mark>Tidak Ada</mark>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="industry">Industri</label>
                                                        <div class="d-block">
                                                            <?php if ($account->industry) : ?>
                                                                <span><?= industry_type($account->industry) ?></span>
                                                            <?php else : ?>
                                                                <mark>Tidak Ada</mark>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-0">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="description">Deskripsi</label>
                                                        <div class="d-block">
                                                            <?php if ($account->description) : ?>
                                                                <p><?= $account->description ?></p>
                                                            <?php else : ?>
                                                                <mark>Tidak Ada</mark>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-inner">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="industry">Pengguna yang Ditugaskan</label>
                                                        <div class="d-block">
                                                            <?php if ($account->assigned) : ?>
                                                                <span><?= $account->assigned ?></span>
                                                            <?php else : ?>
                                                                <mark>Tidak Ada</mark>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="industry">Peran yang Ditugaskan</label>
                                                        <div class="d-block">
                                                            <?php if ($account->role) : ?>
                                                                <span><?= role($account->role) ?></span>
                                                            <?php else : ?>
                                                                <mark>Tidak Ada</mark>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-0">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="industry">Dibuat Pada</label>
                                                        <div class="d-block">
                                                            <span>
                                                                <?= datenow(strtotime($account->created_at)) ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if ($account->updated_at) : ?>
                                                    <div class="mt-3">
                                                        <div class="form-group">
                                                            <label class="form-label text-muted fw-normal mb-0" for="industry">Terakhir Diperbarui</label>
                                                            <div class="d-block">
                                                                <span>
                                                                    <?= datenow(strtotime($account->updated_at)) ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            </div>
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
