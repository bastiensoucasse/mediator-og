<?php
require_once "include/utilities.php";
$collections = $db->get_all_collections();
$genres = $db->get_all_genres();
$page = new Page("browse", "Parcourir", "Parcourez la base de données cinématographique Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="collections" class="section">
            <h2 class="section-title">Collections</h2>
            <?php if (empty($collections)) { ?>
                <div class="section-content">
                    <p class="paragraph limited">Il n'y a aucun contenu à afficher.</p>
                </div>
            <?php } else { ?>
                <div class="section-content filter-list">
                    <?php foreach ($collections as $filter) require "include/filter.php"; ?>
                </div>
            <?php } ?>
        </div>
        <div id="genres" class="section">
            <h2 class="section-title">Genres</h2>
            <?php if (empty($genres)) { ?>
                <div class="section-content">
                    <p class="paragraph limited">Il n'y a aucun contenu à afficher.</p>
                </div>
            <?php } else { ?>
                <div class="section-content filter-list">
                    <?php foreach ($genres as $filter) require "include/filter.php"; ?>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>