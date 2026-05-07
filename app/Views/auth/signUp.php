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
                    <input type="email" name="email">
                </div>
                <div class="error">
                    <?= $errors['email'] ?>
                </div>
                <div class="champ-item">
                    <input type="password" name="mdp">
                </div>
                <div class="error">
                    <?= $errors['mdp'] ?>
                </div>
            </div>
            <div class="btn">
                <input type="button" value="S'inscrire">
            </div>
        </form>
    </div>
</body>

</html>