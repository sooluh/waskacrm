<?php must_login() ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= title('Kelola Opportunity') ?></title>
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
                                                Kelola Opportunity
                                            </h3>
                                        </div>

                                        <a href="<?= base_url('opportunities/add') ?>" class="btn btn-icon btn-primary d-md-none">
                                            <em class="icon ni ni-plus"></em>
                                        </a>

                                        <a href="<?= base_url('opportunities/add') ?>" class="btn btn-primary d-none d-md-inline-flex">
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
                                                        <th class="waska-tb-col" data-column="account">
                                                            <span class="sub-text">Account</span>
                                                        </th>
                                                        <th class="waska-tb-col tb-col-md" data-column="stage">
                                                            <span class="sub-text">Stage</span>
                                                        </th>
                                                        <th class="waska-tb-col" data-column="assigned">
                                                            <span class="sub-text">Ditugaskan</span>
                                                        </th>
                                                        <th class="waska-tb-col tb-col-md" data-column="created_at">
                                                            <span class="sub-text">Ditambahkan</span>
                                                        </th>
                                                        <th class="waska-tb-col tb-col-lg" data-column="amount">
                                                            <span class="sub-text">Amount</span>
                                                        </th>
                                                        <th class="waska-tb-col waska-tb-col-tools text-end" data-column="action" data-features="detail-page,edit-page,delete"></th>
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

    <script defer="defer">
        window.constants = {
            columns: [{
                data: 'num',
                orderable: false,
                searchable: false,
                rowClass: 'waska-tb-col-check'
            }, {
                data: 'name'
            }, {
                data: 'account'
            }, {
                data: 'stage'
            }, {
                data: 'email',
                rowClass: 'tb-col-md'
            }, {
                data: 'phone',
                rowClass: 'tb-col-lg'
            }, {
                data: 'created_at',
                rowClass: 'tb-col-md'
            }]
        };
    </script>

    <?php render('_layouts/js') ?>
</body>

</html>
