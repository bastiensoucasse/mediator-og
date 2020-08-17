<?php
require_once "include/utilities.php";
$collection = $db->get_collection(htmlspecialchars($_GET["id"]));
if (!$collection) relocate("home");
$lists = $db->get_lists($collection->id);
$page = new Page("collections?id=" . $collection->id, $collection->name, "Découvrez la collection " . $collection->name . " sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="collection-<?= $collection->id ?>" class="section">
            <h2 class="section-title"><?= $collection->name ?></h2>
            <div class="section-content"><p class="paragraph"><?= $collection->description ?></p></div>
        </div>
        <?php foreach ($lists as $list) { ?>
            <?php $of_list = $db->get_of_list($list->id); ?>
            <?php if ($of_list) { ?>
                <div id="list-<?= $list->id ?>" class="section">
                    <h2 class="section-title"><?= $list->name ?></h2>
                    <div class="section-content card-list overview"><?php foreach ($of_list as $card) require "include/card.php"; ?></div>
                </div>
            <?php } ?>
        <? } ?>
    </main>
</body>

</html>