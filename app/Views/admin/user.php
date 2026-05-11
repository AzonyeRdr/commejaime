<!DOCTYPE html>
<html>

<head>
    <title>Users</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>

<body>

    <?php include __DIR__ . '/../include/navbarAdmin.php'; ?>
    <div class="admin-shell">
        <div class="admin-grid">
            <div class="panel">
                <div class="section-title">Liste des users</div>
                <div class="table-card">
                    <table>
                        <thead>
                            <tr><th>Email</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u): ?>
                                <tr><td><?= esc($u['email']) ?></td></tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel gold-panel">
                <div class="section-title" style="color:#fff;">Users Gold</div>
                <div class="table-card" style="background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.14); color:#fff;">
                    <table>
                        <thead>
                            <tr><th>Email</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($gold as $g): ?>
                                <tr><td><?= esc($g['email']) ?></td></tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>