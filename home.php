<?php
require_once "include/utilities.php";

$page = array(
    "id" => "home",
    "name" => "Accueil",
    "description" => "Une base de données cinématographique propulsée par Profuder."
);

$novelties = get_all_data($queries["novelties"]);
?>

<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>

    <body>
        <?php require "include/header.php"; ?>

        <main id="main">
            <div id="novelties" class="section">
                <h1 class="section-title">Nouveautés</h1>
                <div class="section-content card-list overview"><?php foreach ($novelties as $card) { $card = (object) $card; require "include/card.php"; } ?></div>
            </div>
        </main>
    </body>
</html>
