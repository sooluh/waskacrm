<?php

must_login();

$uid = input_get('uid');
$contact = $db->query(
    "SELECT contacts.*, accounts.name AS account, users.name AS assigned FROM contacts " .
        "LEFT JOIN accounts ON accounts.id = contacts.account " .
        "LEFT JOIN users ON users.id = contacts.assigned " .
        "WHERE contacts.id = '$uid' AND contacts.deleted_at IS NULL"
)->fetch_object();

if (empty($uid) || empty($contact)) {
    go('404');
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Detail Contact') ?></title>
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
                                                <a class="back-to" href="<?= base_url('contacts') ?>">
                                                    <em class="icon ni ni-arrow-left"></em>
                                                    <span>Contact</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="waska-block-head-content mt-1">
                                            <h3 class="title waska-block-title">Detail Contact</h3>
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
                                                            <span>
                                                                <?= salutation($contact->salutation) ?>
                                                                <?= $contact->first_name ?>
                                                                <?= $contact->last_name ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="account">Account</label>
                                                        <div class="d-block">
                                                            <?php if ($contact->account) : ?>
                                                                <span><?= $contact->account ?></span>
                                                                <small class="text-muted">
                                                                    &rsaquo; <?= $contact->title ?>
                                                                </small>
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
                                                            <?php if ($contact->email) : ?>
                                                                <a href="mailto:<?= $contact->email ?>">
                                                                    <?= $contact->email ?>
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
                                                            <?php if ($contact->phone_number) : ?>
                                                                <a href="tel:<?= $contact->phone_number ?>">
                                                                    <?= $contact->phone_number ?>
                                                                </a>
                                                                <small class="text-muted">
                                                                    &rsaquo; <?= phone_type($contact->phone_type) ?>
                                                                </small>
                                                            <?php else : ?>
                                                                <mark>Tidak Ada</mark>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="address" class="form-label text-muted fw-normal mb-0">Alamat</label>
                                                        <?php if ($contact->street || $contact->city || $contact->state || $contact->zip || $contact->country) : ?>
                                                            <?php if ($contact->street) : ?>
                                                                <div class="d-block">
                                                                    <span><?= $contact->street ?></span>
                                                                </div>
                                                            <?php endif ?>
                                                            <div class="d-block">
                                                                <?php if ($contact->city) : ?>
                                                                    <span><?= $contact->city ?></span>
                                                                <?php endif ?>
                                                                <?php if ($contact->state) : ?>
                                                                    <span><?= $contact->state ?></span>
                                                                <?php endif ?>
                                                                <?php if ($contact->zip) : ?>
                                                                    <span><?= $contact->zip ?></span>
                                                                <?php endif ?>
                                                            </div>
                                                            <?php if ($contact->country) : ?>
                                                                <div class="d-block">
                                                                    <span><?= $contact->country ?></span>
                                                                </div>
                                                            <?php endif ?>
                                                        <?php else : ?>
                                                            <div class="d-block">
                                                                <mark>Tidak Ada</mark>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-0">
                                                    <div class="form-group">
                                                        <label class="form-label text-muted fw-normal mb-0" for="description">Deskripsi</label>
                                                        <div class="d-block">
                                                            <?php if ($contact->description) : ?>
                                                                <p><?= $contact->description ?></p>
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
                                                            <?php if ($contact->assigned) : ?>
                                                                <span><?= $contact->assigned ?></span>
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
                                                            <?php if ($contact->role) : ?>
                                                                <span><?= role($contact->role) ?></span>
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
                                                                <?= datenow(strtotime($contact->created_at)) ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php if ($contact->updated_at) : ?>
                                                    <div class="mt-3">
                                                        <div class="form-group">
                                                            <label class="form-label text-muted fw-normal mb-0" for="industry">Terakhir Diperbarui</label>
                                                            <div class="d-block">
                                                                <span>
                                                                    <?= datenow(strtotime($contact->updated_at)) ?>
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
