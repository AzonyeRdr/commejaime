<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body>
    <?php include __DIR__ . '/include/navbar.php'; ?>

    <?php $user = $user ?? session()->get('user'); ?>

    <div class="page-wrap" style="padding: 1.5rem 0 3rem;">
        <section class="hero gold-panel">
            <div class="hero-grid" style="grid-template-columns: 1.2fr .8fr; align-items: center;">
                <div>
                    <div class="badge-premium" style="background: rgba(255,255,255,.12); color: #fff; border-color: rgba(255,255,255,.18);">Application nutrition & sport</div>
                    <h1 class="hero-title" style="color:#fff; margin-top:.75rem;">Pilotez votre remise en forme avec des programmes adaptés et un portefeuille intégré.</h1>
                    <p class="lead" style="color: rgba(255,255,255,.8); max-width: 60ch;">Suivez vos objectifs, achetez des programmes ciblés et activez GOLD pour bénéficier de -15% instantanément.</p>
                    <div class="hero-actions">
                        <a class="btn btn-warning" href="<?= site_url('/program') ?>">Voir les programmes</a>
                        <?php if ((int) ($user['roleId'] ?? 3) !== 2): ?>
                            <a class="btn btn-outline" href="<?= site_url('/devenir-gold') ?>">Devenir Gold</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="stat-card" style="background: rgba(255,255,255,.08); color:#fff; border-color: rgba(255,255,255,.12);">
                    <div class="section-title" style="color:#fff;">Votre espace</div>
                    <div class="metrics">
                        <div>
                            <div class="small-muted" style="color: rgba(255,255,255,.75);">Solde</div>
                            <div class="stat-value"><?= esc((string) ($user['montant'] ?? 0)) ?> Ar</div>
                        </div>
                        <div>
                            <div class="small-muted" style="color: rgba(255,255,255,.75);">Statut</div>
                            <div class="stat-value"><?= ((int) ($user['roleId'] ?? 3) === 2) ? 'GOLD' : 'STANDARD' ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="soft-divider"></div>

        <section class="grid" style="display:grid; grid-template-columns: 1.2fr .8fr; gap:1.25rem;">
            <div class="panel">
                <div class="section-title">Actions rapides</div>
                <div class="features">
                    <div class="feature-card">
                        <h3>Programmes ciblés</h3>
                        <p class="small-muted">Accédez aux suggestions selon votre IMC et votre objectif.</p>
                        <a class="btn btn-outline" href="<?= site_url('/program') ?>">Explorer</a>
                    </div>
                    <div class="feature-card">
                        <h3>Portefeuille</h3>
                        <p class="small-muted">Rechargez votre compte avec un code ou un ajout manuel.</p>
                        <a class="btn btn-outline" href="<?= site_url('/profil') ?>">Gérer</a>
                    </div>
                </div>
            </div>

            <div class="panel gold-panel">
                <div class="section-title" style="color:#fff;">Offre GOLD</div>
                <p class="lead">Réduction automatique de 15% sur tous les programmes.</p>
                <div class="badge-gold">Badge premium</div>
                <div class="hero-actions">
                    <?php if ((int) ($user['roleId'] ?? 3) !== 2): ?>
                        <a class="btn btn-warning" href="<?= site_url('/devenir-gold') ?>">Activer GOLD</a>
                    <?php else: ?>
                        <span class="badge-gold">Votre abonnement est actif</span>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <div class="soft-divider"></div>

        <div class="panel">
            <div class="section-title">Demande de code cadeau</div>
            <?php include __DIR__ . '/form/demande.php'; ?>
        </div>

        <?php if ((int) ($user['roleId'] ?? 3) !== 2) { ?>
            <div style="margin-top:1.25rem;">
                <?php include __DIR__ . '/form/gold.php'; ?>
            </div>
        <?php } ?>
    </div>

</body>

</html>