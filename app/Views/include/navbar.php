<?php if (session()->get('user')): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url('/index') ?>">
                <i class="fas fa-heartbeat text-danger"></i> CommeJaime
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/index') ?>">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/program') ?>">
                            <i class="fas fa-list"></i> Programmes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('/profil') ?>">
                            <i class="fas fa-wallet"></i>
                            Profil
                        </a>
                    </li>
                    <?php if (session()->get('user')['roleId'] != 2): ?>
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="<?= site_url('/devenir-gold') ?>">
                                <i class="fas fa-crown"></i>Souscrire à GOLD
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                                <i class="fas fa-crown"></i> GOLD
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?= site_url('/logout') ?>">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php endif; ?>