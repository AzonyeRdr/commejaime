<?php
$user = session()->get('user');
$activeUri = service('uri')->getPath();
?>
<?php if ($user): ?>
<nav class="site-navbar" id="siteNavbar">
    <div class="navbar-inner">
        <a class="navbar-brand" href="<?= site_url('/index') ?>">
            <i class="fas fa-heartbeat text-danger"></i>
            <span>CommeJaime</span>
        </a>

        <button type="button" class="navbar-toggle" id="navbarToggle" aria-label="Ouvrir le menu">
            <i class="fas fa-bars"></i>
        </button>

        <div class="navbar-menu" id="navbarMenu">
            <a class="nav-link <?= str_contains($activeUri, 'index') && !str_contains($activeUri, 'admin') ? 'active' : '' ?>" href="<?= site_url('/index') ?>">
                <i class="fas fa-home"></i> Accueil
            </a>
            <a class="nav-link <?= str_contains($activeUri, 'program') ? 'active' : '' ?>" href="<?= site_url('/program') ?>">
                <i class="fas fa-list-check"></i> Programmes
            </a>
            <a class="nav-link <?= str_contains($activeUri, 'profil') ? 'active' : '' ?>" href="<?= site_url('/profil') ?>">
                <i class="fas fa-wallet"></i> Profil
            </a>
            <?php if ((int) ($user['roleId'] ?? 3) !== 2): ?>
                <a class="nav-link" href="<?= site_url('/devenir-gold') ?>">
                    <i class="fas fa-crown"></i> Devenir Gold
                </a>
            <?php else: ?>
                <span class="navbar-badge"><i class="fas fa-crown"></i> GOLD</span>
            <?php endif; ?>
            <a class="nav-link text-danger" href="<?= site_url('/logout') ?>">
                <i class="fas fa-right-from-bracket"></i> Déconnexion
            </a>
        </div>
    </div>
</nav>

<script>
    (function() {
        const navbar = document.getElementById('siteNavbar');
        const toggle = document.getElementById('navbarToggle');
        if (!navbar || !toggle) return;

        toggle.addEventListener('click', function() {
            navbar.classList.toggle('is-open');
        });
    })();
</script>
<?php endif; ?>
