<?php
require_once "include/utilities.php";
if ($db->is_connected()) {
    $watchlisted = $db->get_watchlisted($user->id, true);
    $liked = $db->get_liked($user->id, true);
}
$page = new Page("library", "Bibliothèque", "Retrouvez votre bibliothèque personnelle sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
<?php require "include/head.php"; ?>

<body>
    <?php require "include/header.php"; ?>
    <main id="main">
        <?php if (!$db->is_connected()) { ?>
            <div id="library" class="section">
                <h2 class="section-title">Connexion requise</h2>
                <div class="section-content">
                    <p class="paragraph limited">Pour accéder à votre bibliothèque ainsi que personaliser votre expérience sur Mediator, vous devez avoir un compte Mediator. Vous pouvez <a class="link" href="/login?src=library" aria-label="Se connecter">vous connecter</a> ou <a class="link" href="signin?src=library" aria-label="S'inscrire">vous en créer un</a>.</p>
                </div>
            </div>
        <?php } else { ?>
            <div id="watchlisted" class="section">
                <h2 class="section-title">Titres watchlistés<a class="section-title-link" href="/watchlisted" aria-label="Titres watchlistés"><span>Voir plus</span> ›</a></h2>
                <?php if (empty($watchlisted)) { ?>
                    <div class="section-content">
                        <p class="paragraph limited">Vous n'avez watchlisté aucun titre.</p>
                    </div>
                <?php } else { ?>
                    <div class="section-content card-list overview">
                        <?php foreach ($watchlisted as $card) require "include/card.php"; ?>
                    </div>
                <?php } ?>
            </div>
            <div id="liked" class="section">
                <h2 class="section-title">Titres likés<a class="section-title-link" href="/liked" aria-label="Titres likés"><span>Voir plus</span> ›</a></h2>
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
        <?php } ?>
    </main>
</body>

</html>