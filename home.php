<?php
require_once "include/utilities.php";

$novelties = get_all_data($queries["novelties"]);

$page = array(
    "id" => "home",
    "name" => "Accueil",
    "description" => "Une base de données cinématographique propulsée par Profuder."
);
?>

<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>

    <body>
        <?php require "include/header.php"; ?>

        <main id="main">
            <div id="novelties" class="section">
                <h2 class="section-title">Nouveautés</h2>
                <div class="section-content card-list overview"><?php foreach ($novelties as $card) { $card = (object) $card; require "include/card.php"; } ?></div>
            </div>
        </main>
    </body>
</html>
