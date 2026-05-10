<?php
$success = session()->getFlashdata('InfoSuccess') ?? '';
$errors = session()->getFlashdata('errors') ?? [];
?>
<div class="form">
    <form action="<?= site_url('/inserer-Info-User') ?>" method="post">
        <?= csrf_field() ?>

        <?php if ($success != '') { ?>
            <div class="success">
                <?= esc($success) ?>
            </div>
        <?php } ?>

        <div class="champ">
            <div class="champ-item">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" value="<?= old('prenom') ?>">
            </div>
            <?php if (isset($errors['prenom'])) : ?>
                <div class="error"><?= esc($errors['prenom']) ?></div>
            <?php endif ?>
        </div>

        <div class="champ">
            <div class="champ-item">
                <label for="age">Âge</label>
                <input type="number" name="age" id="age" value="<?= old('age') ?>">
            </div>
            <?php if (isset($errors['age'])) : ?>
                <div class="error"><?= esc($errors['age']) ?></div>
            <?php endif ?>
        </div>

        <div class="champ">
            <div class="champ-item">
                <label for="poids">Poids (kg)</label>
                <input type="number" step="0.1" name="poids" id="poids" value="<?= old('poids') ?>">
            </div>
            <?php if (isset($errors['poids'])) : ?>
                <div class="error"><?= esc($errors['poids']) ?></div>
            <?php endif ?>
        </div>

        <div class="champ">
            <div class="champ-item">
                <label for="taille">Taille (cm)</label>
                <input type="number" step="0.1" name="taille" id="taille" value="<?= old('taille') ?>">
            </div>
            <?php if (isset($errors['taille'])) : ?>
                <div class="error"><?= esc($errors['taille']) ?></div>
            <?php endif ?>
        </div>

        <div class="btn">
            <input type="submit" value="Enregistrer vos informations personnelles">
        </div>
    </form>
</div>