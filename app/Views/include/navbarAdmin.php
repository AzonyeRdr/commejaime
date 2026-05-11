<?php $activeUri = service('uri')->getPath(); ?>
<nav class="site-navbar" id="adminNavbar">
    <div class="navbar-inner">
        <a class="navbar-brand" href="<?= site_url('/index') ?>">
            <i class="fas fa-heartbeat text-danger"></i>
            <span>CommeJaime Admin</span>
        </a>

        <button type="button" class="navbar-toggle" id="adminNavbarToggle" aria-label="Ouvrir le menu admin">
            <i class="fas fa-bars"></i>
        </button>

        <div class="navbar-menu" id="adminNavbarMenu">
            <a class="nav-link <?= str_contains($activeUri, 'admin') && !str_contains($activeUri, 'codes') && !str_contains($activeUri, 'users') && !str_contains($activeUri, 'programs') ? 'active' : '' ?>" href="<?= site_url('admin') ?>">
                <i class="fas fa-chart-line"></i> Accueil
            </a>
            <a class="nav-link <?= str_contains($activeUri, 'codes') ? 'active' : '' ?>" href="<?= site_url('admin/codes') ?>">
                <i class="fas fa-ticket"></i> Codes
            </a>
            <a class="nav-link <?= str_contains($activeUri, 'users') ? 'active' : '' ?>" href="<?= site_url('admin/users') ?>">
                <i class="fas fa-users"></i> Users
            </a>
            <a class="nav-link <?= str_contains($activeUri, 'programs') ? 'active' : '' ?>" href="<?= site_url('admin/programs') ?>">
                <i class="fas fa-clipboard-list"></i> Programmes
            </a>
            <a class="nav-link text-danger" href="<?= site_url('/logout') ?>">
                <i class="fas fa-right-from-bracket"></i> Déconnexion
            </a>
        </div>
    </div>
</nav>

<script>
    (function() {
        const navbar = document.getElementById('adminNavbar');
        const toggle = document.getElementById('adminNavbarToggle');
        if (!navbar || !toggle) return;

        toggle.addEventListener('click', function() {
            navbar.classList.toggle('is-open');
        });
    })();
</script>
