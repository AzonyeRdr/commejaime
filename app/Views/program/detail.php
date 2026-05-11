<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body>
    <?php
    include __DIR__ . '/../include/navbar.php';
    $programme = $programme ?? [];
    $planning = $planning ?? [];
    $isInscrit = $isInscrit ?? false;
    $prixProgramme = $prixProgramme ?? 0;
    $isGold = $isGold ?? false;

    ?>
    <div class="program-shell">
        <section class="hero program-hero">
            <div class="hero-grid" style="grid-template-columns: 1.2fr .8fr; align-items:center;">
                <div>
                    <div class="badge-premium">Détail programme</div>
                    <h1 class="hero-title" style="margin-top:.75rem;"><?= esc((string) ($programme['nom'] ?? 'Programme')) ?></h1>
                    <p class="lead">Vue complète du planning, des régimes et des activités.</p>
                </div>
                <div class="metrics">
                    <div class="stat-card">
                        <div class="small-muted">Jours</div>
                        <div class="stat-value"><?= esc((string) ($programme['nombreJour'] ?? '0')) ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="small-muted">Poids cible</div>
                        <div class="stat-value"><?= esc(number_format((float) ($programme['poids'] ?? 0), 1)) ?> kg</div>
                    </div>
                    <div class="stat-card">
                        <div class="small-muted">Variation/jour</div>
                        <div class="stat-value"><?= esc(number_format(((float) ($programme['poids'] ?? 0)) / max(1, (int) ($programme['nombreJour'] ?? 1)), 2)) ?> kg</div>
                    </div>
                </div>
            </div>
        </section>

        <div class="panel">
            <h5>Évolution Prévue</h5>
            <p>Le programme prévoit une évolution progressive de la consommation de nourriture sur <?= esc((string) ($programme['nombreJour'] ?? '0')) ?> jours.</p>
        </div>

        <div class="panel" style="margin-top:1.25rem;">
            <div class="section-title">Accès au programme</div>
            <?php if ($isInscrit): ?>
                <div class="success">Vous êtes déjà inscrit à ce programme.</div>
            <?php else: ?>
                <div class="alert alert-info">Prix du programme: <strong><?= number_format((float) $prixProgramme, 0) ?> Ar</strong><?= $isGold ? ' avec réduction GOLD appliquée' : '' ?></div>
                <button type="button" class="btn btn-warning" id="acheterProgramme" data-id="<?= esc((string) ($programme['id'] ?? '')) ?>" data-prix="<?= esc((string) $prixProgramme) ?>">
                    <i class="fas fa-cart-shopping"></i> Acheter ce programme
                </button>
            <?php endif; ?>
        </div>

        <div class="panel" style="margin-top:1.25rem;">
            <h5><i class="fas fa-calendar-alt"></i> Planning Détaillé</h5>
            <div class="grid" style="display:grid; gap:1rem;">
                <?php foreach ($planning as $jour => $dayPlan): ?>
                    <div class="mini-card">
                        <div class="d-flex justify-content-between align-items-center" style="display:flex; justify-content:space-between; align-items:center; gap:1rem;">
                            <strong>Jour <?= esc((string) $jour) ?></strong>
                            <span class="badge-gold" style="padding:.3rem .65rem; font-size:.85rem;"><?= count($dayPlan['regimes']) ?> repas · <?= count($dayPlan['sports']) ?> exercices</span>
                        </div>

                        <div class="grid" style="grid-template-columns: 1fr 1fr; gap:1rem; margin-top:1rem;">
                            <div class="glass-strip">
                                <div class="section-title" style="margin-bottom:.5rem;">Régimes</div>
                                <?php if (!empty($dayPlan['regimes'])): ?>
                                    <ul style="margin:0; padding-left:1.1rem;">
                                        <?php foreach ($dayPlan['regimes'] as $regime): ?>
                                            <li>Plat <?= esc((string) $regime['regimeId']) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <div class="small-muted">Aucun régime pour ce jour.</div>
                                <?php endif; ?>
                            </div>

                            <div class="glass-strip">
                                <div class="section-title" style="margin-bottom:.5rem;">Exercices</div>
                                <?php if (!empty($dayPlan['sports'])): ?>
                                    <ul style="margin:0; padding-left:1.1rem;">
                                        <?php foreach ($dayPlan['sports'] as $sport): ?>
                                            <li>Sport <?= esc((string) $sport['sportId']) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <div class="small-muted">Aucun exercice pour ce jour.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        const buyButton = document.getElementById('acheterProgramme');
        if (buyButton) {
            buyButton.addEventListener('click', async function() {
                const programmeId = this.getAttribute('data-id');
                const loading = document.createElement('div');
                loading.textContent = 'Enregistrement en cours...';
                loading.style.cssText = 'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #000; color: white; padding: 1rem; border-radius: 8px; z-index: 1000; font-size: 1.1rem;';
                document.body.appendChild(loading);

                try {
                    const response = await fetch('<?= site_url('/program/acheter') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `programmeId=${programmeId}&<?= csrf_token() ?>=<?= csrf_hash() ?>`
                    });

                    const result = await response.json();
                    if (result.success) {
                        window.location.reload();
                    } else {
                        alert(result.message || 'Une erreur est survenue.');
                    }
                } catch (error) {
                    alert('Erreur réseau : veuillez réessayer.');
                } finally {
                    if (loading.parentNode) {
                        loading.remove();
                    }
                }
            });
        }
    </script>
</body>

</html>