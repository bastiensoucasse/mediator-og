<?php
require_once "include/utilities.php";
$new = $db->get_new();
$page = new Page("new", "Nouveautés", "Découvrez les nouveautés sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="new" class="section">
            <h2 class="section-title">Nouveautés</h2>
            <?php if (empty($new)) { ?>
                <div class="section-content">
                    <p class="paragraph limited">Il n'y a aucun contenu à afficher.</p>
                </div>
            <?php } else { ?>
                <div class="section-content card-list overview">
                    <?php foreach ($new as $card) require "include/card.php"; ?>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>