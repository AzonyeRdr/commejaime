<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programme</title>
</head>

<body>
    <?php
    include __DIR__ . '/../include/navbar.php';

    ?>
    <div class="container my-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <h1><i class="fas fa-list-check text-primary"></i> Nos Programmes</h1>
                <p class="lead text-muted">Découvrez nos programmes adaptés à vos objectifs</p>
            </div>

            <div class="filtre">
                <div class="col-lg-4">
                    <input
                        type="text"
                        class="form-control"
                        id="searchProgrammes"
                        placeholder="Rechercher un programme...">
                </div>
            </div>

            <!-- Filtres -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Filtrer par objectif</label>
                    <select class="form-select" id="filterObjectif">
                        <option value="">Tous les objectifs</option>
                        <?php foreach ($objectifs as $objectif): ?>
                            <option value="<?= $objectif['id'] ?>">
                                <?= $objectif['lib'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Trier par</label>
                    <select class="form-select" id="sortProgrammes">
                        <option value="nom">Nom</option>
                        <option value="prix">Prix croissant</option>
                        <option value="prix_desc">Prix décroissant</option>
                    </select>
                </div>
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
                                <?php if (session()->get('user')['roleId'] == 2): ?>
                                    <span class="badge badge-gold">
                                        <i class="fas fa-crown"></i> GOLD
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">
                                <i class="fas fa-calendar-days"></i>
                                <strong><?= $programme['nombreJour'] ?></strong> jours
                            </p>

                            <p class="text-muted mb-3">
                                <i class="fas fa-weight"></i>
                                <strong><?= number_format($programme['poids'], 2) ?></strong> kg à perdre/gagner
                            </p>

                            <div class="mb-3">
                                <div class="text-muted small">Prix:</div>
                                <?php if (session()->get('user')['roleId'] == 2): ?>
                                    <div class="text-muted small">
                                        <s><?= number_format($programme['prix'] / 0.85, 0) ?> Ar</s>
                                    </div>
                                    <div class="text-success fw-bold fs-5">
                                        <?= number_format($programme['prix'], 0) ?> Ar
                                    </div>
                                <?php else: ?>
                                    <div class="text-primary fw-bold fs-5">
                                        <?= number_format($programme['prix'], 0) ?> Ar
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="btn-group">
                            <div class="btn detail">
                                <a href="<?= site_url('program/detail/' . $programme['id']) ?>" class="btn detail">
                                    <i class="fas fa-eye"></i> Détails
                                </a>
                                <?php if (session()->getFlashdata('NonInscrit')) { ?>
                                    <div class="error">
                                        <?= session()->getFlashdata('NonInscrit') ?>
                                    </div>
                                <?php } ?>
                                <button
                                    type="button"
                                    class="btn acheter"
                                    data-id="<?= $programme['id'] ?>"
                                    data-nom="<?= $programme['nom'] ?>"
                                    data-prix="<?= $programme['prix'] ?>">
                                    <i class="fas fa-shopping-cart"></i> Acheter
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Recherche
        document.getElementById('searchProgrammes').addEventListener('keyup', function() {
            filterProgrammes();
        });

        // Filtrage objectif
        document.getElementById('filterObjectif').addEventListener('change', function() {
            filterProgrammes();
        });

        // Tri
        document.getElementById('sortProgrammes').addEventListener('change', function() {
            sortProgrammes(this.value);
        });

        function filterProgrammes() {
            const searchText = document.getElementById('searchProgrammes').value.toLowerCase();
            const objectifFilter = document.getElementById('filterObjectif').value;
            const cards = document.querySelectorAll('.programme-card');

            cards.forEach(card => {
                const nom = card.dataset.nom;
                const objectif = card.dataset.objectif;

                const searchMatch = nom.includes(searchText);
                const objectifMatch = !objectifFilter || objectif === objectifFilter;

                card.style.display = (searchMatch && objectifMatch) ? 'block' : 'none';
            });
        }

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