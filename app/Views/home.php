<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<?php $success = session()->getFlashdata('success') ?? '' ?>
<body>
    <div class="success">
        <p><?= $success ?></p>
    </div>
    Bonjour
</body>
</html>