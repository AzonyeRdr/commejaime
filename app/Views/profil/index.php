<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>

<?php
$errorMontant = session()->getFlashdata('error') ?? '';
$succesMontant = session()->getFlashdata('succes') ?? '';

?>

<body>

    <?php include __DIR__ . '/../include/navbar.php'; ?>
    <?php if (empty($infoUser)) : ?>
        <?php include __DIR__ . '/../form/infoUser.php'; ?>
    <?php endif; ?>
    <div>

        <h1>Mon Profil</h1>

        <div>
            <h2>Utilisateur</h2>
            <p>Email : <?= $user['email'] ?></p>
            <p>Montant : <?= $user['montant'] ?> €</p>
        </div>

        <hr>

        <div>
            <h2>Informations personnelles</h2>

            <?php if (!empty($infoUser)) : ?>
                <div>
                    <p>Prénom : <?= $infoUser['prenom'] ?></p>
                    <p>Âge : <?= $infoUser['age'] ?></p>
                    <p>Poids : <?= $infoUser['poids'] ?> kg</p>
                    <p>Taille : <?= $infoUser['taille'] ?> cm</p>
                </div>
            <?php else : ?>
                <p>Aucune information utilisateur enregistrée</p>
            <?php endif; ?>

        </div>

        <hr>

        <div>
            <h2>Mes programmes</h2>

            <?php if (!empty($program)) : ?>

                <?php foreach ($program as $p) : ?>
                    <a href="<?= site_url('/program/detail/'). $p['id'] ?>">
                        <div>
                            <p><strong><?= $p['nom'] ?></strong></p>
                            <p>Nombre de jours : <?= $p['nombreJour'] ?></p>
                            <p>Poids objectif : <?= $p['poids'] ?> kg</p>
                            <hr>
                        </div>
                    </a>
                <?php endforeach; ?>

            <?php else : ?>
                <p>Aucun programme inscrit</p>
            <?php endif; ?>

        </div>

        <div>
            <h2>Charger un code cadeau</h2>

            <?php include __DIR__ . '/../form/demande.php'; ?>
        </div>

        <div>
            <h2>Charger le compte</h2>

            <form action="<?= site_url('/profil/charger') ?>" method="post">
                <?= csrf_field() ?>
                <label for="montant">Montant</label>
                <input type="number" name="montant" id="montant" value="<?= old('montant') ?>">
                <?php
                if ($errorMontant != '') { ?>
                    <div class="error">
                        <?= $errorMontant ?>
                    </div>
                <?php } else if ($succesMontant != '') { ?>
                    <div class="success">
                        <?= $succesMontant ?>
                    </div>
                <?php } ?>

                <input type="submit" value="Charger le compte">
            </form>
        </div>

    </div>

</body>

</html>