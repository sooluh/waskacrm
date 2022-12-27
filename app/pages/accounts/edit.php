<?php

must_login();

$uid = input_get('uid');
$account = $db->query("SELECT * FROM accounts WHERE id = '$uid' AND deleted_at IS NULL")->fetch_object();

if (!$account) {
    go('404');
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Ubah Account') ?></title>
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
                            <form action="<?= current_url(true) ?>" method="POST" class="waska-content-body form-validate">
                                <div class="wide-md mx-auto">
                                    <div class="waska-block-head waska-block-head-lg wide-sm pb-4">
                                        <div class="waska-block-head-content">
                                            <div class="waska-block-head-sub mb-0">
                                                <a class="back-to" href="<?= base_url('accounts') ?>">
                                                    <em class="icon ni ni-arrow-left"></em>
                                                    <span>Account</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="waska-block-head-content mt-1">
                                            <h3 class="title waska-block-title">Ubah Account</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="waska-block row">
                                    <div class="col-md-8">
                                        <div class="card mb-3">
                                            <div class="card-inner row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="name">
                                                            Nama
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="name" name="name" required="" value="<?= $account->name ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="website">Website</label>
                                                        <div class="form-control-wrap">
                                                            <input type="url" class="form-control" id="website" name="website" value="<?= $account->website ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Surel</label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" class="form-control" id="email" name="email" value="<?= $account->email ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone_number">Telepon</label>
                                                        <div class="form-control-wrap">
                                                            <div class="input-group">
                                                                <span class="input-group-btn">
                                                                    <select name="phone_type" id="phone_type" class="form-control">
                                                                        <?php foreach (phone_type() as $val => $text) : ?>
                                                                            <option value="<?= $val ?>" <?= $account->phone_type == $val ? 'selected=""' : '' ?>><?= $text ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </span>
                                                                <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?= $account->phone_number ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="billing" class="form-label">Alamat Tagihan</label>
                                                        <div class="form-control-wrap mb-1">
                                                            <textarea name="billing_street" id="billing" class="form-control auto-height" placeholder="Alamat" rows="1"><?= $account->billing_street ?></textarea>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="Kota" value="<?= $account->billing_city ?>">
                                                            </div>
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="billing_state" name="billing_state" placeholder="Provinsi" value="<?= $account->billing_state ?>">
                                                            </div>
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="billing_zip" name="billing_zip" placeholder="Kode Pos" value="<?= $account->billing_zip ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="billing_country" name="billing_country" placeholder="Negara" value="<?= $account->billing_country ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="shipping" class="form-label">Alamat Pengiriman</label>
                                                        <div class="form-control-wrap mb-1">
                                                            <textarea name="shipping_street" id="shipping" class="form-control auto-height" placeholder="Alamat" rows="1"><?= $account->shipping_street ?></textarea>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="shipping_city" name="shipping_city" placeholder="Kota" value="<?= $account->shipping_city ?>">
                                                            </div>
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="shipping_state" name="shipping_state" placeholder="Provinsi" value="<?= $account->shipping_state ?>">
                                                            </div>
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="shipping_zip" name="shipping_zip" placeholder="Kode Pos" value="<?= $account->shipping_zip ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="shipping_country" name="shipping_country" placeholder="Negara" value="<?= $account->shipping_country ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="type">Tipe</label>
                                                        <div class="form-control-wrap">
                                                            <select name="type" id="type" class="form-control js-select2" data-placeholder="Pilih">
                                                                <option value=""></option>
                                                                <?php foreach (account_type() as $val => $text) : ?>
                                                                    <option value="<?= $val ?>" <?= $account->type == $val ? 'selected=""' : '' ?>><?= $text ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="industry">Industri</label>
                                                        <div class="form-control-wrap">
                                                            <select name="industry" id="industry" class="form-control js-select2" data-search="on" data-placeholder="Pilih">
                                                                <option value=""></option>
                                                                <?php foreach (industry_type() as $val => $text) : ?>
                                                                    <option value="<?= $val ?>" <?= $account->industry == $val ? 'selected=""' : '' ?>><?= $text ?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-0">
                                                    <div class="form-group">
                                                        <label class="form-label" for="description">Deskripsi</label>
                                                        <div class="form-control-wrap">
                                                            <textarea name="description" id="description" class="form-control"><?= $account->description ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card mb-3">
                                            <div class="card-inner">
                                                <?php if (access_granted(['0', '1'])) : ?>
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="assigned">Pengguna yang Ditugaskan</label>
                                                            <div class="form-control-wrap">
                                                                <select name="assigned" id="assigned" class="form-control js-select2" data-search="on" data-placeholder="Pilih">
                                                                    <option value=""></option>
                                                                    <?php $users = $db->query("SELECT id, name FROM users WHERE deleted_at IS NULL") ?>
                                                                    <?php while ($user = $users->fetch_object()) : ?>
                                                                        <option value="<?= $user->id ?>" <?= $account->assigned == $user->id ? 'selected=""' : '' ?>><?= $user->name ?></option>
                                                                    <?php endwhile ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-0">
                                                        <div class="form-group">
                                                            <label class="form-label" for="role">Peran yang Ditugaskan</label>
                                                            <div class="form-control-wrap">
                                                                <select name="role" id="role" class="form-control js-select2" data-placeholder="Pilih">
                                                                    <option value=""></option>
                                                                    <?php foreach (role() as $val => $text) : ?>
                                                                        <?php if ($val >= 2) : ?>
                                                                            <option value="<?= $val ?>" <?= $account->role == $val ? 'selected=""' : '' ?>><?= $text ?></option>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="assigned">Pengguna yang Ditugaskan</label>
                                                            <div class="d-block">
                                                                <span><?= logged('name') ?></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-0">
                                                        <div class="form-group">
                                                            <label class="form-label" for="role">Peran yang Ditugaskan</label>
                                                            <div class="d-block">
                                                                <span><?= role(logged('role')) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
