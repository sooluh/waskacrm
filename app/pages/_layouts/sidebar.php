<div class="waska-sidebar waska-sidebar-fixed is-dark" data-content="sidebar-menu">
    <div class="waska-sidebar-element waska-sidebar-head">
        <div class="waska-menu-trigger">
            <a href="javascript:void(0)" class="waska-nav-toggle waska-quick-nav-icon d-xl-none" data-target="sidebar-menu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="javascript:void(0)" class="waska-nav-compact waska-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebar-menu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>

        <div class="waska-sidebar-brand">
            <a href="<?= base_url() ?>" class="logo-link waska-sidebar-logo">
                <img class="logo-img" src="<?= base_url('assets/img/waska-white.png') ?>" alt="<?= APP_NAME ?>">
            </a>
        </div>
    </div>

    <div class="waska-sidebar-element waska-sidebar-body">
        <div class="waska-sidebar-content">
            <div class="waska-sidebar-menu" data-simplebar>
                <ul class="waska-menu">
                    <?php foreach (sidebar() as $menu) : ?>
                        <?php if (property_exists($menu, 'children') && access_granted($menu->permission)) : ?>
                            <li class="waska-menu-item has-sub">
                                <a href="javascript:void(0)" class="waska-menu-link waska-menu-toggle">
                                    <span class="waska-menu-icon">
                                        <em class="icon ni ni-<?= $menu->icon ?>"></em>
                                    </span>
                                    <span class="waska-menu-text"><?= $menu->title ?></span>
                                </a>

                                <ul class="waska-menu-sub">
                                    <?php foreach ($menu->children as $child) : ?>
                                        <?php if (access_granted($child->permission)) : ?>
                                            <li class="waska-menu-item">
                                                <a href="<?= $child->link ?>" class="waska-menu-link">
                                                    <span class="waska-menu-text"><?= $child->title ?></span>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                        <?php elseif (access_granted($menu->permission)) : ?>
                            <li class="waska-menu-item">
                                <a href="<?= $menu->link ?>" class="waska-menu-link">
                                    <span class="waska-menu-icon">
                                        <em class="icon ni ni-<?= $menu->icon ?>"></em>
                                    </span>
                                    <span class="waska-menu-text"><?= $menu->title ?></span>
                                </a>
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>
