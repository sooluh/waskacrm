<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="user-aside" data-toggle-screen="lg" data-toggle-overlay="true">
    <div class="card-inner-group" data-simplebar>
        <div class="card-inner">
            <div class="user-card">
                <div class="user-avatar bg-primary">
                    <?= logged('name')[0] ?>
                </div>

                <div class="user-info">
                    <span class="lead-text"><?= logged('name') ?></span>
                    <span class="sub-text"><?= logged('email') ?></span>
                </div>
            </div>
        </div>

        <div class="card-inner p-0">
            <ul class="link-list-menu">
                <li>
                    <a href="<?= base_url('profile') ?>">
                        <em class="icon ni ni-user-fill-c"></em>
                        <span>Informasi Personal</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('password') ?>">
                        <em class="icon ni ni-lock-alt-fill"></em>
                        <span>Kata Sandi</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
