<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programme</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body>
    <?php
    include __DIR__ . '/../include/navbar.php';
    $objectifs = $objectifs ?? [];
    $programmes = $programmes ?? [];
    $estSuggereIMC = $estSuggereIMC ?? false;
    $objectifSuggerE = $objectifSuggerE ?? '';
    $user = session()->get('user') ?? [];

    ?>
    <div class="program-shell">
        <section class="hero program-hero">
            <div class="hero-grid" style="grid-template-columns: 1.25fr .75fr; align-items:center;">
                <div>
                    <div class="badge-premium">Programmes personnalisés</div>
                    <h1 class="hero-title" style="margin-top:.75rem;">Nos programmes</h1>
                    <p class="lead">Découvrez des parcours adaptés à vos objectifs et à votre état de forme.</p>
                </div>
                <div class="glass-strip">
                    <label class="form-label fw-bold">Rechercher</label>
                    <input
                        type="text"
                        class="form-control"
                        id="searchProgrammes"
                        placeholder="Rechercher un programme...">
                </div>
            </div>

            <div class="row mb-4" style="margin-top:1.25rem;">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Filtrer par objectif</label>
                    <select class="form-select" id="filterObjectif">
                        <option value="">Tous les objectifs</option>
                        <?php foreach ($objectifs as $objectif): ?>
                            <option value="<?= $objectif['id'] ?>" <?= ($estSuggereIMC && $objectif['id'] == 3) ? 'selected' : '' ?>>
                                <?= $objectif['lib'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Trier par</label>
                    <select class="form-select mb-3" id="sortProgrammes">
                        <option value="nom">Nom</option>
                        <option value="prix">Prix croissant</option>
                        <option value="prix_desc">Prix décroissant</option>
                    </select>
                    <button class="btn btn-warning w-100" id="atteindreIMC" type="button" style="padding: 0.9rem; font-size: 1.05rem; margin-top: 1.25rem;">
                        <i class="fas fa-bullseye"></i> Voir les programmes suggérés pour moi
                    </button>
                </div>
            </div>

            <?php if ($estSuggereIMC): ?>
                <div class="alert alert-info col-12 mb-4">
                    <i class="fas fa-lightbulb"></i> <strong>Programmes suggérés selon votre IMC :</strong> <?= esc($objectifSuggerE) ?>
                </div>
            <?php endif; ?>
        </section>


        <div class="metrics" style="margin:1.25rem 0;">
            <div class="stat-card">
                <div class="small-muted">Programmes</div>
                <div class="stat-value"><?= count($programmes) ?></div>
            </div>
            <div class="stat-card">
                <div class="small-muted">Utilisateur</div>
                <div class="stat-value"><?= ((int) ($user['roleId'] ?? 3) === 2) ? 'GOLD' : 'STANDARD' ?></div>
            </div>
            <div class="stat-card">
                <div class="small-muted">Suggestion IMC</div>
                <div class="stat-value"><?= $estSuggereIMC ? 'Actif' : 'Tous' ?></div>
            </div>
        </div>

        <!-- Grille de programmes -->
        <div class="programme-grid" id="programmesContainer">
            <?php if (empty($programmes)): ?>
                <div class="alert alert-info col-12">
                    <i class="fas fa-info-circle"></i> Aucun programme disponible pour le moment.
                </div>
            <?php else: ?>
                <?php foreach ($programmes as $programme): ?>
                    <div class="card programme-card" data-objectif="<?= $programme['objId'] ?>" data-prix="<?= $programme['prix'] ?>" data-nom="<?= strtolower($programme['nom']) ?>">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title mb-0"><?= $programme['nom'] ?></h5>
                                    <small class="text-light"><?= $programme['objectif']['lib'] ?? 'Objectif' ?></small>
                                </div>
                                <?php if ((int) ($user['roleId'] ?? 3) == 2): ?>
                                    <span class="badge badge-gold">
                                        <i class="fas fa-crown"></i> GOLD
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="metrics" style="grid-template-columns:repeat(2,1fr); margin-bottom:1rem;">
                                <div class="mini-card">
                                    <div class="small-muted">Durée</div>
                                    <div class="stat-value" style="font-size:1.2rem;"><?= esc((string) $programme['nombreJour']) ?> jours</div>
                                </div>
                                <div class="mini-card">
                                    <div class="small-muted">Poids</div>
                                    <div class="stat-value" style="font-size:1.2rem;"><?= number_format((float) $programme['poids'], 2) ?> kg</div>
                                </div>
                            </div>

                            <div class="glass-strip">
                                <div class="small-muted">Prix</div>
                                <?php if ((int) ($user['roleId'] ?? 3) == 2): ?>
                                    <div class="small-muted"><s><?= number_format($programme['prix'] / 0.85, 0) ?> Ar</s></div>
                                    <div class="stat-value" style="color:var(--success); font-size:1.35rem;"><?= number_format($programme['prix'], 0) ?> Ar</div>
                                <?php else: ?>
                                    <div class="stat-value" style="color:var(--primary); font-size:1.35rem;"><?= number_format($programme['prix'], 0) ?> Ar</div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="d-flex" style="gap: 0.5rem; margin-top: 1rem;">
                            <a href="<?= site_url('program/detail/' . $programme['id']) ?>" class="btn btn-outline flex-grow-1 text-center" style="font-size: 0.95rem;">
                                <i class="fas fa-eye"></i> Détail
                            </a>
                            <button
                                type="button"
                                class="btn btn-primary flex-grow-1 acheter"
                                data-id="<?= $programme['id'] ?>"
                                data-nom="<?= $programme['nom'] ?>"
                                data-prix="<?= $programme['prix'] ?>"
                                style="font-size: 0.95rem;">
                                <i class="fas fa-shopping-cart"></i> Acheter
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const atteindreIMCButton = document.getElementById('atteindreIMC');
        if (atteindreIMCButton) {
            atteindreIMCButton.addEventListener('click', function() {
                window.location.href = '<?= site_url('/program/programmesSuggereesIMC') ?>';
            });
        }

        // Recherche
        document.getElementById('searchProgrammes').addEventListener('keyup', function() {
            filterProgrammes();
        });

        // Filtrage objectif
        document.getElementById('filterObjectif').addEventListener('change', function() {
            if (this.value === '3') {
                window.location.href = '<?= site_url('/program/programmesSuggereesIMC') ?>';
            } else {
                filterProgrammes();
            }
        });

        // Tri
        document.getElementById('sortProgrammes').addEventListener('change', function() {
            sortProgrammes(this.value);
        });

        function filterProgrammes() {
            const searchText = document.getElementById('searchProgrammes').value.toLowerCase();
            const objectifFilter = document.getElementById('filterObjectif').value;
            const cards = document.querySelectorAll('.programme-card');
            const suggestedId = '<?= isset($suggestedObjectifId) ? $suggestedObjectifId : '' ?>';

            cards.forEach(card => {
                const nom = card.dataset.nom;
                const objectif = card.dataset.objectif;

                const searchMatch = nom.includes(searchText);

                let objectifMatch = false;
                if (!objectifFilter) {
                    objectifMatch = true;
                } else if (objectifFilter === '3') {
                    // Si IMC idéal sélectionné, correspond à l'objectif suggéré stocké
                    objectifMatch = (objectif === suggestedId);
                } else {
                    objectifMatch = (objectif === objectifFilter);
                }

                card.style.display = (searchMatch && objectifMatch) ? 'block' : 'none';
            });
        }

        // Si on arrive sur la page "suggérée", on filtre directement 
        <?php if ($estSuggereIMC): ?>
            document.addEventListener('DOMContentLoaded', function() {
                filterProgrammes();
            });
        <?php endif; ?>

        function sortProgrammes(sortBy) {
            const container = document.getElementById('programmesContainer');
            const cards = Array.from(document.querySelectorAll('.programme-card'));

            cards.sort((a, b) => {
                switch (sortBy) {
                    case 'nom':
                        return a.querySelector('.card-title').textContent.localeCompare(b.querySelector('.card-title').textContent);
                    case 'prix':
                        return parseFloat(a.dataset.prix) - parseFloat(b.dataset.prix);
                    case 'prix_desc':
                        return parseFloat(b.dataset.prix) - parseFloat(a.dataset.prix);
                    default:
                        return 0;
                }
            });

            cards.forEach(card => container.appendChild(card));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const buttonsAcheter = document.querySelectorAll('.acheter');

            buttonsAcheter.forEach(button => {
                button.addEventListener('click', async function(e) {
                    e.preventDefault();

                    const programmeId = this.getAttribute('data-id');
                    const nomProgramme = this.getAttribute('data-nom');
                    const prix = parseFloat(this.getAttribute('data-prix'));

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
                            alert('Programme acheté avec succès !');
                            window.location.href = '<?= site_url('/program') ?>';
                        } else {
                            alert('Erreur : ' + result.message);
                        }
                    } catch (error) {
                        alert('Erreur réseau : veuillez réessayer.');
                    } finally {
                        if (loading.parentNode) {
                            loading.remove();
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>