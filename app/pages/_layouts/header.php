<div class="waska-header waska-header-fixed is-light">
    <div class="container-fluid">
        <div class="waska-header-wrap">
            <div class="waska-menu-trigger d-xl-none ms-n1">
                <a href="javascript:void(0)" class="waska-nav-toggle waska-quick-nav-icon" data-target="sidebar-menu">
                    <em class="icon ni ni-menu"></em>
                </a>
            </div>

            <div class="waska-header-brand d-xl-none">
                <a href="<?= base_url() ?>" class="logo-link">
                    <img class="logo-img" src="<?= base_url('assets/img/waska.png') ?>" alt="<?= APP_NAME ?>">
                </a>
            </div>

            <div class="waska-header-tools">
                <ul class="waska-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>

                                <div class="user-info d-none d-md-block">
                                    <div class="user-status"><?= role(logged('role')) ?></div>
                                    <div class="user-name dropdown-indicator"><?= logged('name') ?></div>
                                </div>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span><?= logged('name')[0] ?></span>
                                    </div>

                                    <div class="user-info">
                                        <span class="lead-text"><?= logged('name') ?></span>
                                        <span class="sub-text"><?= logged('email') ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="<?= base_url('profile') ?>">
                                            <em class="icon ni ni-user-alt"></em>
                                            <span>Profil Saya</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= base_url('password') ?>">
                                            <em class="icon ni ni-lock"></em>
                                            <span>Kata Sandi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="<?= base_url('auth/logout') ?>">
                                            <em class="icon ni ni-signout"></em>
                                            <span>Keluar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
