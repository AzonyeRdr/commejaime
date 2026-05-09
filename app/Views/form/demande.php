<?php
$error = session()->getFlashdata('CodeNoFound') ?? '';
$success = session()->getFlashdata('CodeSuccess') ?? '';

?>
<div class="form">
    <form action="envoyer-code-requete" method="post">
        <?= csrf_field() ?>
        <div class="champ">
            <div class="champ-item">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" value="<?= old('code') ?>">
            </div>
            <?php
            if ($error != '') { ?>
                <div class="error">
                    <?= $error ?>
                </div>
            <?php } else if ($success != '') { ?>
                <div class="success">
                    <?= $success ?>
                </div>
            <?php } ?>
        </div>
        <div class="btn">
            <input type="submit" value="Envoyer une requête de code">
        </div>
    </form>
</div>