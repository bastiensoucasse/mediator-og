<?php
require_once "include/utilities.php";
$new = $db->get_new(true);
$best = $db->get_best(true);
$page = new Page("home", "Accueil", "Une base de données cinématographique propulsée par Profuder.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="new" class="section">
            <h2 class="section-title">Nouveautés<a class="section-title-link" href="/new" aria-label="Nouveautés"><span>Voir plus</span> ›</a></h2>
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
        <div id="best" class="section">
            <h2 class="section-title">Meilleurs titres<a class="section-title-link" href="/best" aria-label="Meilleurs titres"><span>Voir plus</span> ›</h2>
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