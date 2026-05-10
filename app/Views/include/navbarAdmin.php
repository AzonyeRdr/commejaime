<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= site_url('/index') ?>">
            <i class="fas fa-heartbeat text-danger"></i> CommeJaime
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('admin') ?>">
                        <i class="fas fa-home"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('admin/codes') ?>">
                        <i class="fas fa-home"></i> Codes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('admin/users') ?>">
                        <i class="fas fa-home"></i> users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('admin/programs') ?>">
                        <i class="fas fa-home"></i> programmes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="<?= site_url('/logout') ?>">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>