<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codes</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body>
    <?php
    $success = '';
    $errorMessage = (string) (session()->getFlashdata('error') ?? '');
    if (session()->getFlashdata('ValidationSuccess')):
            $success = (string) session()->getFlashdata('ValidationSuccess');
    elseif (session()->getFlashdata('RefusSuccess')):
        $success = (string) session()->getFlashdata('RefusSuccess');
    endif; ?>

    <div class="admin-shell">
        <?php if ($errorMessage !== ''): ?>
            <div class="error"><?= esc($errorMessage) ?></div>
        <?php endif; ?>
        <?php if ($success !== ''): ?>
            <div class="success"><?= esc((string) $success) ?></div>
        <?php endif; ?>

        <?php include __DIR__ . '/../include/navbarAdmin.php'; ?>
        <div class="panel" style="margin-top:1.25rem;">
            <div class="section-title">Codes en validation</div>
            <div class="table-card">
            <table>
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
                                <td><?= esc((string) ($code['lib'] ?? $code->lib ?? '')) ?></td>
                                <td><?= esc((string) ($code['montant'] ?? $code->montant ?? '')) ?> Ar</td>
                                <td><?= esc((string) ($code['userId'] ?? $code->userId ?? '')) ?></td>
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

        <div class="panel" style="margin-top:1.25rem;">
            <div class="section-title">Codes disponibles</div>
            <div class="table-card">
            <table>
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
                                <td><?= esc((string) ($code['lib'] ?? $code->lib ?? '')) ?></td>
                                <td><?= esc((string) ($code['montant'] ?? $code->montant ?? '')) ?> €</td>
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

        <div class="panel" style="margin-top:1.25rem;">
            <div class="section-title">Codes utilisés</div>
            <div class="table-card">
            <table>
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
                                <td><?= esc((string) ($code['lib'] ?? $code->lib ?? '')) ?></td>
                                <td><?= esc((string) ($code['montant'] ?? $code->montant ?? '')) ?> €</td>
                                <td><?= esc((string) ($code['userId'] ?? $code->userId ?? '')) ?></td>
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
    </div>
</body>

</html>