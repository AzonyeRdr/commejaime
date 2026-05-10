<!DOCTYPE html>
<html>

<head>
    <title>Programmes</title>
</head>

<body>

    <?php include __DIR__ . '/../include/navbarAdmin.php'; ?>

    <h1>Liste des programmes</h1>

    <?php foreach ($programmes as $p): ?>

        <div>

            <div>
                <strong><?= $p['nom'] ?></strong>
            </div>

            <div>
                Objectif :
                <?= $p['objectif'] ?>
            </div>

            <div>
                Nombre de jours :
                <?= $p['nombreJour'] ?>
            </div>

            <div>
                Poids cible :
                <?= $p['poids'] ?> kg
            </div>

            <div>
                Nombre d'inscriptions :
                <?= $p['nbInscription'] ?>
            </div>

            <hr>

        </div>

    <?php endforeach; ?>

</body>

</html>