<?php
require_once "include/utilities.php";
$best = $db->get_best();
$page = best Page("best", "Meilleurs titres", "Découvrez les meilleurs titres sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="best" class="section">
            <h2 class="section-title">Meilleurs titres</h2>
            <?php if (empty($best)) { ?>
                <div class="section-content">
                    <p class="paragraph limited">Il n'y a aucun contenu à afficher.</p>
                </div>
            <?php } else { ?>
                <div class="section-content card-list overview">
                    <?php foreach ($best as $card) require "include/card.php"; ?>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>