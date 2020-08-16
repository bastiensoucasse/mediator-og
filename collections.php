<?php
require_once "include/utilities.php";
$collection = $db->get_collection(htmlspecialchars($_GET["id"]));
if (!$collection) relocate("home");
$lists = $db->get_lists($collection->id);
$page = new Page("collection?id=" . $collection->id, $collection->name, "Découvrez la collection " . $collection->name . " sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="collection" class="section">
            <h2 class="section-title"><?= $collection->name ?></h2>
            <div class="section-content">
                <?php foreach ($lists as $l) { ?>
                    <h3><?= $l->name ?></h3>
                <? } ?>
            </div>
        </div>
    </main>
</body>

</html>