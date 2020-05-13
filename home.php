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
                <div class="section-content card-list overview"><?php foreach ($novelties as $card) require "include/card.php"; ?></div>
            </div>
        </main>
    </body>
</html>
