<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codes</title>
</head>

<body>
    <?php
    $success = '';
    if (session()->getFlashdata('ValidationSuccess')):
        $success = session()->getFlashdata('ValidationSuccess');
    elseif (session()->getFlashdata('RefusSuccess')):
        $success = session()->getFlashdata('RefusSuccess');
    endif; ?>

    <div class="error">
        <p><?= session()->getFlashdata('error') ?></p>
    </div>
    <div class="success">
        <p><?= $success ?></p>
    </div>

    <div class="list">
        <h3>Listes des codes non validés</h3>
        <div class="tab">
            <table border="1">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Montant</th>
                        <th>Utilisateur ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($codeEnCoursDeValidation)): ?>
                        <?php foreach ($codeEnCoursDeValidation as $code): ?>
                            <tr>
                                <td><?= esc($code['lib'] ?? $code->lib) ?></td>
                                <td><?= esc($code['montant'] ?? $code->montant) ?> Ar</td>
                                <td><?= esc($code['userId'] ?? $code->userId) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/valider-code/' . ($code['id'] ?? $code->id)) ?>">Valider</a>
                                    <a href="<?= site_url('admin/refuser-code/' . ($code['id'] ?? $code->id)) ?>">Refuser</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Aucun code en cours de validation.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="list">
        <h3>Listes des codes disponibles</h3>
        <div class="tab">
            <table border="1">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($codeDisponible)): ?>
                        <?php foreach ($codeDisponible as $code): ?>
                            <tr>
                                <td><?= esc($code['lib'] ?? $code->lib) ?></td>
                                <td><?= esc($code['montant'] ?? $code->montant) ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2">Aucun code disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="list">
        <h3>Listes des codes déjà utilisés</h3>
        <div class="tab">
            <table border="1">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Montant</th>
                        <th>Utilisateur ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($codeUtilise)): ?>
                        <?php foreach ($codeUtilise as $code): ?>
                            <tr>
                                <td><?= esc($code['lib'] ?? $code->lib) ?></td>
                                <td><?= esc($code['montant'] ?? $code->montant) ?> €</td>
                                <td><?= esc($code['userId'] ?? $code->userId) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Aucun code utilisé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>