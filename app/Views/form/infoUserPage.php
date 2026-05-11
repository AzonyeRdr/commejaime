<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compléter mon profil</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body>
    <?php include __DIR__ . '/../include/navbar.php'; ?>

    <div class="auth-shell">
        <div class="auth-card" style="width:min(720px,100%);">
            <div class="badge-premium">Profil santé</div>
            <h1 class="auth-title">Compléter mes informations personnelles</h1>
            <p class="auth-subtitle">Ces données servent à calculer votre IMC et à vous proposer des programmes adaptés.</p>

            <?php include __DIR__ . '/infoUser.php'; ?>
        </div>
    </div>
</body>

</html>
