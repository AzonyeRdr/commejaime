<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détail Régime</title>
</head>

<body>
    <?php
    include __DIR__ . '/../include/navbar.php';

    ?>

    <div>

        <div>
            <h1>Détail du régime</h1>
        </div>

        <div>
            <p>Nom : <?= $regime['nomPlat'] ?></p>
            <p>Poids total : <?= $regime['poidsTotalPlat'] ?> g</p>
        </div>

        <hr>

        <div>
            <h2>Ingrédients</h2>

            <?php foreach ($ingredients as $ing): ?>

                <div>

                    <div>
                        <strong><?= $ing['ingredient'] ?></strong>
                    </div>

                    <div>
                        Pourcentage : <?= $ing['pourcentage'] ?> %
                    </div>

                    <div>
                        Poids calculé : <?= $ing['poidsIngredient'] ?> g
                    </div>

                    <div>
                        Prix unitaire (g) : <?= $ing['prixG'] ?>
                    </div>

                    <div>
                        Coût : <?= $ing['cout'] ?> Ar
                    </div>

                    <hr>

                </div>

            <?php endforeach; ?>

        </div>

        <div>
            <h2>Total</h2>
            <p><?= $prixTotal ?>Ar</p>
        </div>

    </div>

</body>

</html>