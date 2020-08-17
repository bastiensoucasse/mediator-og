<?php
require_once "include/utilities.php";
$collections = $db->get_collections();
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
                <div class="section-content card-list overview">
                    <?php foreach ($collections as $collection) require "include/collection.php"; ?>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>