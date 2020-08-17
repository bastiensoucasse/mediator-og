<?php
require_once "include/utilities.php";
if (!$db->is_connected()) relocate("library");
$watchlisted = $db->get_watchlisted($user->id);
$page = new Page("watchlisted", "Titres watchlistés", "Retrouvez vos titres watchlistés sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="watchlisted" class="section">
            <h2 class="section-title">Titres watchlistés</h2>
            <?php if (empty($watchlisted)) { ?>
                <div class="section-content">
                    <p class="paragraph limited">Vous n'avez liké aucun titre.</p>
                </div>
            <?php } else { ?>
                <div class="section-content card-list overview">
                    <?php foreach ($watchlisted as $card) require "include/card.php"; ?>
                </div>
            <?php } ?>
        </div>
    </main>
</body>

</html>