<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<?php $success = session()->getFlashdata('CodeSuccess') ?? '' ?>

<body>
    <?php if ($success != '') { ?>
        <div class="success">
            <p><?= $success ?></p>
        </div>
    <?php } ?>
    Bonjour

    <div class="demande-form">
        <?php include __DIR__ . '/form/demande.php'; ?>
    </div>
</body>

</html>