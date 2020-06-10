<?php
require_once "include/utilities.php";
if (!$db->is_connected()) die("Vous devez être connectés.");
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
    <?php require "include/header.php"; ?>
    <main id="main">
        <div id="order" class="section limited">
            <h2 class="section-title">Commander</h2>
            <form class="section-content form" action="order?src=<?= $src ?>" method="post">
                <h3>Indiquez le titre et le type de votre commande</h3>
                <input type="text" class="text-input" name="query" aria-label="Titre" placeholder="Titre" required />
                <div class="radio-input-container">
                    <div class="radio-input">
                        <input type="radio" id="request-type-movie" name="type" value="movie" required />
                        <label for="request-type-movie">Film</label>
                    </div>
                    <div class="radio-input">
                        <input type="radio" id="request-type-series" name="type" value="series" required />
                        <label for="request-type-series">Série</label>
                    </div>
                </div>
                <input type="submit" class="button" aria-label="Commander" value="Commander" />
            </form>
        </div>
    </main>
</body>

</html>