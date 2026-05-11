<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<?php
$errorMontant = session()->getFlashdata('error') ?? '';
$succesMontant = session()->getFlashdata('succes') ?? '';
$user = $user ?? session()->get('user');
$infoUser = $infoUser ?? [];
$program = $program ?? [];
$imc = $imc ?? null;
$poidsIdeal = $poidsIdeal ?? null;
$variationPoids = $variationPoids ?? null;

?>

<body>

    <?php include __DIR__ . '/../include/navbar.php'; ?>
    <div class="profile-shell">
        <div class="profile-grid">
            <div class="profile-card">
                <div class="badge-premium" style="margin-bottom:.85rem;">Espace utilisateur</div>
                <h1 class="page-title">Mon profil</h1>
                <p class="page-subtitle">Vos informations, vos abonnements et vos programmes actifs au même endroit.</p>

                <div class="metrics">
                    <div class="stat-card">
                        <div class="small-muted">Email</div>
                        <div class="stat-value" style="font-size:1.15rem;"><?= esc((string) ($user['email'] ?? '')) ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="small-muted">Portefeuille</div>
                        <div class="stat-value" style="font-size:1.15rem;"><?= esc((string) ($user['montant'] ?? 0)) ?> Ar</div>
                    </div>
                    <div class="stat-card">
                        <div class="small-muted">Statut</div>
                        <div class="stat-value" style="font-size:1.15rem;"><?= ((int) ($user['roleId'] ?? 3) === 2) ? 'GOLD' : 'STANDARD' ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="small-muted">IMC</div>
                        <div class="stat-value" style="font-size:1.15rem;"><?= $imc !== null ? esc($imc) : 'N/A' ?></div>
                    </div>
                </div>

                <div class="soft-divider"></div>

                <div class="section-title">Informations personnelles</div>
                <?php if (!empty($infoUser)) : ?>
                    <div class="panel">
                        <p><strong>Prénom :</strong> <?= esc((string) ($infoUser['prenom'] ?? '')) ?></p>
                        <p><strong>Âge :</strong> <?= esc((string) ($infoUser['age'] ?? '')) ?></p>
                        <p><strong>Poids :</strong> <?= esc((string) ($infoUser['poids'] ?? '')) ?> kg</p>
                        <p><strong>Taille :</strong> <?= esc((string) ($infoUser['taille'] ?? '')) ?> cm</p>
                        <p><strong>Poids idéal :</strong> <?= $poidsIdeal !== null ? esc($poidsIdeal) . ' kg' : 'N/A' ?></p>
                        <p><strong>Variation :</strong> <?= $variationPoids !== null ? esc($variationPoids) . ' kg' : 'N/A' ?></p>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info">Aucune information utilisateur enregistrée. Complétez le formulaire ci-dessous pour activer les suggestions.</div>
                    <div class="panel" style="margin-top:1rem;">
                        <?php include __DIR__ . '/../form/infoUser.php'; ?>
                    </div>
                <?php endif; ?>

                <div class="soft-divider"></div>

                <div class="section-title">Mes programmes</div>
                <?php if (!empty($program)) : ?>
                    <div class="grid" style="display:grid; gap:1rem;">
                        <?php foreach ($program as $p) : ?>
                            <a href="<?= site_url('/program/detail/' . $p['id']) ?>" class="panel" style="display:block;">
                                <strong><?= esc((string) ($p['nom'] ?? '')) ?></strong>
                                <div class="small-muted">Nombre de jours : <?= esc((string) ($p['nombreJour'] ?? '')) ?></div>
                                <div class="small-muted">Poids objectif : <?= esc((string) ($p['poids'] ?? '')) ?> kg</div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info">Aucun programme inscrit</div>
                <?php endif; ?>
            </div>

            <div class="profile-card">
                <div class="badge-premium" style="margin-bottom:.85rem;">Portefeuille</div>
                <h2 class="page-title" style="font-size:1.8rem;">Recharge et code cadeau</h2>
                <p class="page-subtitle">Ajoutez du solde ou saisissez un code pour alimenter votre compte.</p>

                <div class="panel">
                    <form action="<?= site_url('/profil/charger') ?>" method="post" class="auth-grid">
                        <?= csrf_field() ?>
                        <label for="montant">Montant à ajouter</label>
                        <input type="number" name="montant" id="montant" value="<?= old('montant') ?>" min="1" required>
                        <?php if ($errorMontant != '') { ?>
                            <div class="error"><?= esc((string) $errorMontant) ?></div>
                        <?php } else if ($succesMontant != '') { ?>
                            <div class="success"><?= esc((string) $succesMontant) ?></div>
                        <?php } ?>
                        <input type="submit" value="Charger le compte">
                    </form>
                </div>

                <div class="soft-divider"></div>

                <div class="section-title">Code cadeau</div>
                <div class="panel">
                    <?php include __DIR__ . '/../form/demande.php'; ?>
                </div>

                <div class="soft-divider"></div>

                <div class="panel gold-panel">
                    <div class="badge-gold" style="margin-bottom:.75rem;">GOLD</div>
                    <h3 style="margin:0 0 .5rem; color:#fff;">Votre réduction premium</h3>
                    <p class="lead" style="margin:0;">Si vous êtes GOLD, tous vos programmes sont automatiquement réduits de 15%.</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>