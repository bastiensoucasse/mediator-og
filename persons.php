<?php
require_once "include/utilities.php";
$person = $db->get_person(htmlspecialchars($_GET["id"]));
if (!$person) relocate("home");
$with_person = $db->get_with_person($person->id);
$page = new Page("persons?id=" . $person->id, $person->name, "Découvrez " . $person->name . " sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="person-<?= $person->id ?>" class="section">
            <h2 class="section-title"><?= $person->name ?></h2>
            <div class="section-content card-list overview"><?php foreach ($with_person as $card) require "include/card.php"; ?></div>
        </div>
    </main>
</body>

</html>