<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<?php
$errors = session()->getFlashdata('errors') ?? [];
$success = (string) (session()->getFlashdata('success') ?? '');
?>

<body>
    <div class="auth-shell signup-page">
        <div class="auth-card">
            <div class="badge-premium">CommeJaime</div>
            <h1 class="auth-title">Créer un compte</h1>
            <p class="auth-subtitle">Inscription rapide pour accéder à l’application nutrition et sport.</p>
            <p class="small-muted">
                Compte de test : admin@gmail.com / admin123<br>
                user@gmail.com / admin123
            </p>

            <?php if ($success !== '') { ?>
                <div class="success">
                    <?= esc((string) $success) ?>
                </div>
            <?php } ?>

            <form action="<?= site_url('/') ?>" method="post" class="auth-grid">
                <?= csrf_field() ?>
                <div class="champ-item">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="user@gmail.com" value="<?= old('email') ?>" required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="error"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="champ-item">
                    <label for="mdp">Mot de passe</label>
                    <div class="password-field">
                        <input type="password" name="mdp" id="mdp" required>
                        <button type="button" class="password-toggle" data-target="mdp">Show</button>
                    </div>
                    <?php if (isset($errors['mdp'])): ?>
                        <div class="error"><?= $errors['mdp'] ?></div>
                    <?php endif; ?>
                </div>

                <div>
                    <input type="submit" value="S'inscrire">
                </div>
                <div class="small-muted">
                    Déjà un compte ? <a href="<?= site_url('/login') ?>">Se connecter</a>
                </div>
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