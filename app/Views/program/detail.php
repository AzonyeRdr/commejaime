<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
</head>

<body>
    <?php
    include __DIR__ . '/../include/navbar.php';

    ?>
    <div class="row">
        <div class="col">
            <h2><?= $programme['nom'] ?></h2>

            <!-- Stats du programme -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stat-box">
                        <div class="number"><?= $programme['nombreJour'] ?></div>
                        <div class="label">Jours</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <div class="number"><?= number_format($programme['poids'], 1) ?></div>
                        <div class="label">kg</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-box">
                        <div class="number"><?= round($programme['poids'] / $programme['nombreJour'], 2) ?></div>
                        <div class="label">kg/jour</div>
                    </div>
                </div>
            </div>

            <!-- Évolution prévue (simple texte, sans graphique) -->
            <div class="mb-4">
                <h5>Évolution Prévue</h5>
                <p>Le programme prévoit une évolution progressive de la consommation de nourriture sur <?= $programme['nombreJour'] ?> jours.</p>
            </div>

            <!-- Planning jour par jour -->
            <div>
                <h5><i class="fas fa-calendar-alt"></i> Planning Détaillé</h5>
                <div class="accordion" id="planningAccordion">
                    <?php foreach ($planning as $jour => $dayPlan): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button
                                    class="accordion-button <?= $jour !== 1 ? 'collapsed' : '' ?>"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#jour<?= $jour ?>">
                                    <strong>Jour <?= $jour ?></strong>
                                    <span class="badge bg-primary ms-2"><?= count($dayPlan['regimes']) ?> repas</span>
                                    <span class="badge bg-success ms-2"><?= count($dayPlan['sports']) ?> exercices</span>
                                </button>
                            </h2>
                            <div id="jour<?= $jour ?>" class="accordion-collapse collapse <?= $jour === 1 ? 'show' : '' ?>" data-bs-parent="#planningAccordion">
                                <div class="accordion-body">
                                    <h6><i class="fas fa-utensils text-primary"></i> Régimes</h6>
                                    <ul class="list-group mb-3">
                                        <?php foreach ($dayPlan['regimes'] as $regime): ?>
                                            <a href="/program/detail/regime/<?= $regime['regimeId'] ?>">
                                                <li class="list-group-item">
                                                    <i class="fas fa-check-circle text-success"></i>
                                                    Plat <?= $regime['regimeId'] ?>
                                                </li>
                                            </a>
                                        <?php endforeach; ?>
                                    </ul>

                                    <h6><i class="fas fa-dumbbell text-danger"></i> Exercices Sportifs</h6>
                                    <ul class="list-group">
                                        <?php foreach ($dayPlan['sports'] as $sport): ?>
                                            <li class="list-group-item">
                                                <i class="fas fa-fire text-warning"></i>
                                                Sport <?= $sport['sportId'] ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
</body>

</html>