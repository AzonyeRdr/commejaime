<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body>
    <?php include __DIR__ . '/../include/navbarAdmin.php'; ?>
    <div class="admin-shell">
        <div class="hero gold-panel" style="margin-bottom:1.25rem;">
            <div class="hero-grid" style="grid-template-columns: 1.2fr .8fr; align-items:center;">
                <div>
                    <div class="badge-premium" style="background: rgba(255,255,255,.12); color:#fff; border-color: rgba(255,255,255,.18);">Admin Dashboard</div>
                    <h1 class="hero-title" style="color:#fff; margin-top:.75rem;">Pilotage de la plateforme</h1>
                    <p class="lead" style="color: rgba(255,255,255,.8);">Vue synthétique sur les codes, utilisateurs, programmes et revenus.</p>
                </div>
                <div class="stat-card" style="background: rgba(255,255,255,.08); color:#fff; border-color: rgba(255,255,255,.12);">
                    <div class="section-title" style="color:#fff;">Raccourcis</div>
                    <div class="hero-actions">
                        <a class="btn btn-warning" href="<?= site_url('admin/codes') ?>">Gérer les codes</a>
                        <a class="btn btn-outline" href="<?= site_url('admin/users') ?>">Voir les users</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-grid">
            <div class="admin-card">
                <div class="section-title">Modules disponibles</div>
                <div class="features">
                    <a class="feature-card" href="<?= site_url('admin/codes') ?>">
                        <h3>Codes</h3>
                        <p class="small-muted">Validation et suivi des codes cadeaux.</p>
                    </a>
                    <a class="feature-card" href="<?= site_url('admin/users') ?>">
                        <h3>Utilisateurs</h3>
                        <p class="small-muted">Consultation des profils et des comptes GOLD.</p>
                    </a>
                    <a class="feature-card" href="<?= site_url('admin/programs') ?>">
                        <h3>Programmes</h3>
                        <p class="small-muted">Statistiques d’inscription et performance.</p>
                    </a>
                </div>
            </div>

            <div class="admin-card gold-panel">
                <div class="section-title" style="color:#fff;">Statut</div>
                <p class="lead">Interface admin prête pour un suivi rapide et lisible.</p>
            </div>
        </div>
    </div>

</body>

</html>