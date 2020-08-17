<?php
require_once "include/utilities.php";
if (!$db->is_connected()) relocate("library");
$liked = $db->get_liked($user->id);
$page = new Page("liked", "Titres likés", "Retrouvez vos titres likés sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="liked" class="section">
            <h2 class="section-title">Titres likés</h2>
            <?php if (empty($liked)) { ?>
                <div class="section-content">
                    <p class="paragraph limited">Vous n'avez liké aucun titre.</p>
                </div>
            <?php } else { ?>
                <div class="section-content card-list overview">
                    <?php foreach ($liked as $card) require "include/card.php"; ?>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>