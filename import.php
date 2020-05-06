<?php
require_once "include/utilities.php";
$src = get_source();
if (!empty($_POST)) {
    if (!$db->import(htmlspecialchars($_POST["command_id"]), htmlspecialchars($_POST["tmdb_id"]), htmlspecialchars($_POST["poster"]), htmlspecialchars($_POST["tile"]), htmlspecialchars($_POST["backdrop"]))) relocate("import?src=$src");
    relocate($src);
}
$page = new Page("import", "Importer", "Importez un film ou une série sur Mediator.");
?>
<!doctype html>
<html lang="fr-fr">
    <?php require "include/head.php"; ?>
    <body>
        <main id="main" class="fullscreen">
            <form id="import" class="form" action="import" method="post">
                <a class="logo" href="home" aria-label="Mediator">
                    <span class="logo-icon"><?php require "include/icons/stadia.svg"; ?></span>
                </a>
                <h3>Importez une commande dans la base de données</h3>
                <input type="text" class="text-input" name="command_id" aria-label="Numéro de commande" placeholder="Numéro de commande" required />
                <input type="text" class="text-input" name="tmdb_id" aria-label="Identifiant TMDb" placeholder="Identifiant TMDb" required />
                <input type="text" class="text-input" name="poster" aria-label="Affiche" placeholder="Affiche" required />
                <input type="text" class="text-input" name="tile" aria-label="Carte" placeholder="Carte" required />
                <input type="text" class="text-input" name="backdrop" aria-label="Arrière-plan" placeholder="Arrière-plan" required />
                <input type="submit" class="button" aria-label="Importer" value="Importer" />
            </form>
        </main>
    </body>
</html>