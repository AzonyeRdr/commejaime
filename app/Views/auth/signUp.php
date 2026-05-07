<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<?php $errors = [] ?>

<body>
    <div class="auth-form">
        <form action="/" method="post">
            <div class="champ">
                <div class="champ-item">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="user@gmail.com">
                </div>
                <div class="error">
                    <?= $errors['email'] ?? '' ?>
                </div>
                <div class="champ-item">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" name="mdp" id="mdp">
                </div>
                <div class="error">
                    <?= $errors['mdp'] ?? '' ?>
                </div>
            </div>
            <div class="btn">
                <input type="button" value="S'inscrire">
            </div>
        </form>
    </div>
</body>

</html>