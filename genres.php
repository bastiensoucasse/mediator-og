<?php
require_once "include/utilities.php";
$genre = $db->get_genre(htmlspecialchars($_GET["id"]));
if (!$genre) relocate("home");
$of_genre = $db->get_of_genre($genre->id);
$page = new Page("genres/" . $genre->id, $genre->name, "Découvrez le genre " . $genre->name . " sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>
    <body>
        <?php require "include/header.php"; ?>
        <main id="main">
            <div id="novelties" class="section">
                <h2 class="section-title"><?= $genre->name ?></h2>
                <div class="section-content card-list overview"><?php foreach ($of_genre as $card) require "include/card.php"; ?></div>
            </div>
        </main>
    </body>
</html>