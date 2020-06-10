<?php
require_once "include/utilities.php";
$novelties = $db->get_novelties(true);
$page = new Page("home", "Accueil", "Une base de données cinématographique propulsée par Profuder.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="novelties" class="section">
            <h2 class="section-title">Nouveautés</h2>
            <?php if (empty($novelties)) { ?>
                <div class="section-content">
                    <p class="paragraph limited">Il n'y a aucun contenu à afficher.</p>
                </div>
            <?php } else { ?>
                <div class="section-content card-list overview">
                    <?php foreach ($novelties as $card) require "include/card.php"; ?>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>