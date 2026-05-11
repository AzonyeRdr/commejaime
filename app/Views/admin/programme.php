<!DOCTYPE html>
<html>

<head>
    <title>Programmes</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body>

    <?php include __DIR__ . '/../include/navbarAdmin.php'; ?>
    <div class="admin-shell">
        <div class="panel">
            <div class="section-title">Liste des programmes</div>
            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Objectif</th>
                            <th>Jours</th>
                            <th>Poids cible</th>
                            <th>Inscriptions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($programmes as $p): ?>
                            <tr>
                                <td><strong><?= esc($p['nom']) ?></strong></td>
                                <td><?= esc($p['objectif']) ?></td>
                                <td><?= esc($p['nombreJour']) ?></td>
                                <td><?= esc($p['poids']) ?> kg</td>
                                <td><?= esc($p['nbInscription']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>