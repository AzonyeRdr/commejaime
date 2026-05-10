<!DOCTYPE html>
<html>

<head>
    <title>Users</title>
</head>

<body>

    <?php include __DIR__ . '/../include/navbarAdmin.php'; ?>
    <h1>Liste des users</h1>

    <?php foreach ($users as $u): ?>
        <div>
            <p>Email : <?= $u['email'] ?></p>
            <hr>
        </div>
    <?php endforeach; ?>

    <h1>Users Gold</h1>

    <?php foreach ($gold as $g): ?>
        <div>
            <p>Email : <?= $g['email'] ?></p>
            <hr>
        </div>
    <?php endforeach; ?>

</body>

</html>