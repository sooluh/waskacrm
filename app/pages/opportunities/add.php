<?php must_login() ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Tambah Contact') ?></title>
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
                                                <a class="back-to" href="<?= base_url('contacts') ?>">
                                                    <em class="icon ni ni-arrow-left"></em>
                                                    <span>Contact</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="waska-block-head-content mt-1">
                                            <h3 class="title waska-block-title">Tambah Contact</h3>
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
                                                        <div class="row gap-yey">
                                                            <div class="col-sm-2 col-xs-2">
                                                                <select name="salutation" id="salutation" class="form-control">
                                                                    <option value=""></option>
                                                                    <?php foreach (salutation() as $val => $text) : ?>
                                                                        <option value="<?= $val ?>"><?= $text ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-5 col-xs-5">
                                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nama Depan">
                                                            </div>
                                                            <div class="col-sm-5 col-xs-5">
                                                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nama Belakang">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="account">Account</label>
                                                        <div class="row gap-yey">
                                                            <div class="col-sm-8 col-xs-8">
                                                                <select name="account" id="account" class="form-control js-select2" data-placeholder="Pilih">
                                                                    <option value=""></option>
                                                                    <?php $accounts = $db->query("SELECT * FROM accounts WHERE deleted_at IS NULL") ?>
                                                                    <?php while ($account = $accounts->fetch_object()) : ?>
                                                                        <option value="<?= $account->id ?>"><?= $account->name ?></option>
                                                                    <?php endwhile ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="title" name="title" placeholder="Jabatan">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email">Surel</label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" class="form-control" id="email" name="email">
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
                                                                            <option value="<?= $val ?>"><?= $text ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </span>
                                                                <input type="tel" class="form-control" id="phone_number" name="phone_number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="billing" class="form-label">Alamat</label>
                                                        <div class="form-control-wrap mb-1">
                                                            <textarea name="street" id="billing" class="form-control auto-height" placeholder="Alamat" rows="1"></textarea>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="city" name="city" placeholder="Kota">
                                                            </div>
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="state" name="state" placeholder="Provinsi">
                                                            </div>
                                                            <div class="col-sm-4 col-xs-4">
                                                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Kode Pos">
                                                            </div>
                                                        </div>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" id="country" name="country" placeholder="Negara">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-0">
                                                    <div class="form-group">
                                                        <label class="form-label" for="description">Deskripsi</label>
                                                        <div class="form-control-wrap">
                                                            <textarea name="description" id="description" class="form-control"></textarea>
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
                                                                        <option value="<?= $user->id ?>"><?= $user->name ?></option>
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
                                                                            <option value="<?= $val ?>"><?= $text ?></option>
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
