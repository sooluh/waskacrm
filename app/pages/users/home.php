<?php bouncer(['0', '1']) ?>
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
                                <div class="waska-block-head waska-block-head-sm">
                                    <div class="waska-block-between">
                                        <div class="waska-block-head-content">
                                            <h3 class="waska-block-title page-title">
                                                Kelola Pengguna
                                            </h3>
                                        </div>

                                        <a href="javascript:void(0)" class="btn btn-icon btn-primary d-md-none add-button" data-bs-toggle="modal" data-bs-target="#form-modal" data-title="Pengguna">
                                            <em class="icon ni ni-plus"></em>
                                        </a>

                                        <a href="javascript:void(0)" class="btn btn-primary d-none d-md-inline-flex add-button" data-bs-toggle="modal" data-bs-target="#form-modal" data-title="Pengguna">
                                            <em class="icon ni ni-plus"></em>
                                            <span>Tambah</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="waska-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner">
                                            <table class="datatable-init nowrap waska-tb-list waska-tb-ulist" data-auto-responsive="false" data-serverside="<?= current_url(true) ?>">
                                                <thead>
                                                    <tr class="waska-tb-item waska-tb-head">
                                                        <th class="waska-tb-col" data-column="num">
                                                            <span class="sub-text">#</span>
                                                        </th>
                                                        <th class="waska-tb-col" data-column="name">
                                                            <span class="sub-text">Nama</span>
                                                        </th>
                                                        <th class="waska-tb-col tb-col-md" data-column="login">
                                                            <span class="sub-text">Nama Pengguna</span>
                                                        </th>
                                                        <th class="waska-tb-col tb-col-lg" data-column="role">
                                                            <span class="sub-text">Peran</span>
                                                        </th>
                                                        <th class="waska-tb-col tb-col-sm" data-column="active">
                                                            <span class="sub-text">Status</span>
                                                        </th>
                                                        <th class="waska-tb-col tb-col-xl" data-column="created_at">
                                                            <span class="sub-text">Ditambahkan</span>
                                                        </th>
                                                        <th class="waska-tb-col waska-tb-col-tools text-end" data-column="action" data-features="edit,delete"></th>
                                                    </tr>
                                                </thead>
                                            </table>
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

    <div class="modal fade zoom" id="form-modal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengguna</h5>
                    <a href="javascript:void(0)" class="close" data-bs-dismiss="modal">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>

                <div class="modal-body">
                    <form action="<?= base_url('users/insert') ?>" class="form-validate row" method="POST" data-page="Pengguna">
                        <div class="form-group mb-3">
                            <label for="login" class="form-label">Nama Pengguna</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="login" name="login" required="" spellcheck="false">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" name="name" required="" spellcheck="false">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Surel</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" id="email" name="email" spellcheck="false">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <div class="form-control-wrap d-flex" style="gap: 20px;">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="male" value="M" name="gender" class="custom-control-input" required="">
                                    <label class="custom-control-label" for="male">Laki-Laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="female" value="F" name="gender" class="custom-control-input" required="">
                                    <label class="custom-control-label" for="female">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Peran</label>
                            <div class="form-control-wrap">
                                <select name="role" id="role" class="form-control js-select2" data-placeholder="Pilih" required="">
                                    <option value="">Pilih</option>
                                    <?php foreach (role() as $val => $text) : ?>
                                        <?php if ($val >= 1) : ?>
                                            <option value="<?= $val ?>"><?= $text ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="active" class="form-label">Status</label>
                            <div class="form-control-wrap">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active" name="active">
                                    <label class="custom-control-label" for="active">Aktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="alert alert-fill alert-icon alert-info mb-0" role="alert">
                                <em class="icon ni ni-alert-circle"></em>
                                <p class="mb-0">Secara default kata sandi akan disetel menjadi (perhatikan besar kecilnya huruf): <strong>Waska.123</strong></p>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script defer="defer">
        window.constants = {
            columns: [{
                data: 'num',
                orderable: false,
                searchable: false,
                rowClass: 'waska-tb-col-check'
            }, {
                data: 'name',
                rowTemplate: '<div class="user-card"><div class="user-avatar d-none d-sm-flex"><span>${data.name[0]}</span></div><div class="user-info"><span class="tb-lead">${data.name}</span><span>${data.email}</span></div></div>'
            }, {
                data: 'login',
                rowClass: 'tb-col-md'
            }, {
                data: 'role',
                rowClass: 'tb-col-lg'
            }, {
                data: 'active',
                rowClass: 'tb-col-sm'
            }, {
                data: 'created_at',
                rowClass: 'tb-col-xl'
            }]
        };
    </script>

    <?php render('_layouts/js') ?>
</body>

</html>
