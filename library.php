<?php
require_once "include/utilities.php";
if (!$db->is_connected()) die ("Vous devez être connectés.");
$watchlisted = $db->get_watchlisted($user->id, true);
$liked = $db->get_liked($user->id, true);
$page = new Page("library", "Bibliothèque", "Retrouvez votre bibliothèque personnelle sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>
    <body>
        <?php require "include/header.php"; ?>
        <main id="main">
            <div id="watchlisted" class="section">
                <h2 class="section-title">Titres watchlistés</h2>
                <div class="section-content card-list overview"><?php foreach ($watchlisted as $card) require "include/card.php"; ?></div>
            </div>
            <div id="liked" class="section">
                <h2 class="section-title">Titres likés</h2>
                <div class="section-content card-list overview"><?php foreach ($liked as $card) require "include/card.php"; ?></div>
            </div>
            <div id="commands" class="section">
                <h2 class="section-title">Commandes</h2>
                <div class="section-content"></div>
            </div>
        </main>
    </body>
</html>