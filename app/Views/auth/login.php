<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<?php
$error = session()->getFlashdata('error') ?? '';
?>

<body>
    <div class="auth-shell login-page">
        <div class="auth-card">
            <div class="badge-premium">CommeJaime</div>
            <h1 class="auth-title">Heureux de vous revoir</h1>
            <p class="auth-subtitle">Connectez-vous pour suivre vos programmes, votre portefeuille et votre évolution.</p>
            <p class="small-muted">
                Compte de test : admin@gmail.com / admin123<br>
                user@gmail.com / admin123
            </p>

            <?php if ($error !== ''): ?>
                <div class="error"><?= esc((string) $error) ?></div>
            <?php endif; ?>

            <form action="<?= site_url('/login') ?>" method="post" class="auth-grid">
                <?= csrf_field() ?>
                <div class="champ-item">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="user@gmail.com" value="<?= old('email') ?>" required>
                </div>

                <div class="champ-item">
                    <label for="mdp">Mot de passe</label>
                    <div class="password-field">
                        <input type="password" name="mdp" id="mdp" required>
                        <button type="button" class="password-toggle" data-target="mdp">Show</button>
                    </div>
                </div>

                <div>
                    <input type="submit" value="Se connecter">
                </div>

                <p class="small-muted">Pas encore de compte ? <a href="<?= site_url('/') ?>">Créer un compte</a></p>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.password-toggle').forEach(function(button) {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const field = document.getElementById(targetId);

                if (!field) {
                    return;
                }

                const isHidden = field.getAttribute('type') === 'password';
                field.setAttribute('type', isHidden ? 'text' : 'password');
                this.textContent = isHidden ? 'Hide' : 'Show';
            });
        });
    </script>
</body>

</html>
