<?php
require_once "include/utilities.php";
if (!$db->is_connected()) die ("Vous devez être connectés.");
$src = get_source();
if (!empty($_POST)) {
    if (!$db->order(htmlspecialchars($_POST["query"]), htmlspecialchars($_POST["type"]), $user->id)) relocate("order?src=" . urlencode($src));
    relocate($src);
}
$page = new Page("order", "Commander", "Commandez un film ou une série sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>
    <body>
        <main id="main" class="fullscreen">
            <form id="order" class="form" action="order" method="post">
                <a class="logo" href="/home" aria-label="Mediator">
                    <span class="logo-icon"><?php require "include/icons/stadia.svg"; ?></span>
                </a>
                <h3>Commandez un titre sur Mediator</h3>
                <input type="text" class="text-input" name="query" aria-label="Titre" placeholder="Titre" required />
                <div class="radio-input">
                    <input type="radio" id="request-type-movie" name="type" value="movie" />
                    <label for="request-type-movie">Film</label>
                </div>
                <div class="radio-input">
                    <input type="radio" id="request-type-series" name="type" value="series" />
                    <label for="request-type-series">Série</label>
                </div>
                <input type="submit" class="button" aria-label="Commander" value="Commander" />
            </form>
        </main>
    </body>
</html>