<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>
    <?php include __DIR__ . '/../include/navbarAdmin.php'; ?>
    <div class="content">
        <div class="link">
            <a href="<?= site_url('admin/codes') ?>">
                <div class="card">
                    <div class="title">
                        Codes
                    </div>
                    <div class="desc">
                        <p>Voir la liste des codes</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

</body>

</html>