<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <?php 
    include __DIR__ . '/include/navbar.php';
    ?>
    Bonjour

    <div class="demande-form">
        <?php include __DIR__ . '/form/demande.php'; ?>
    </div>

    <div class="info-form">
        <?php include __DIR__ . '/form/infoUser.php'; ?>
    </div>
</body>

</html>