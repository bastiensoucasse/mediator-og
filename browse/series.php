<?php
require_once("../tools/init.php");
require_once("../tools/utilities.php");

if (isset($_GET["id"])) {
    require_once("../tools/database.php");
    $stmt = $db->prepare("SELECT * FROM Series WHERE SeriesID = ?");
    $stmt->execute(array(htmlspecialchars($_GET["id"])));
    $s = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    if (!$s) header("Location: /");
    $img_path_1x = "https://image.tmdb.org/t/p/w300_and_h450_bestv2/";
    $img_path_2x = "https://image.tmdb.org/t/p/w600_and_h900_bestv2/";
?>
    <!DOCTYPE html>
    <html lang="fr-fr">

    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Découvrez <?= $s["Title"] ?> (<?= substr($s["StartDate"], 0, 4) ?>) sur Mediator." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="/style.css" />
        <title><?= $s["Title"] ?> (<?= substr($s["StartDate"], 0, 4) ?>) - Mediator</title>
    </head>

    <body>
        <header>
            <div id="header">
                <a class="logo" href="/" aria-label="Mediator">Mediator</a>
                <?php
                if (!is_connected()) {
                ?>
                    <a class="nav-button" href="/auth" aria-label="Se connecter">Se connecter</a>
                <?php
                }
                ?>
            </div>
            <div id="nav">
                <a class="nav-link" href="/home" aria-label="Accueil">Accueil</a>
                <a class="nav-link active" href="/browse" aria-label="Parcourir">Parcourir</a>
                <a class="nav-link" href="/library" aria-label="Bibliothèque">Bibliothèque</a>
            </div>
        </header>
        <main id="title-page">
            <div class="section limited intro">
                <div class="poster-container">
                    <div class="poster">
                        <img sizes="auto" srcset="<?= $img_path_1x . $s["PosterPath"] ?> 1x, <?= $img_path_2x . $s["PosterPath"] ?> 2x" src="<?= $img_path_1x . $s["PosterPath"] ?>" alt="<?= htmlspecialchars($m["Title"] . " (" . substr($m["StartDate"], 0, 4) . ")") ?>" />
                    </div>
                </div>
                <div class="presentation-container">
                    <div class="title"><?= $s["Title"] ?></div>
                    <div class="section-content info"><?= substr($s["StartDate"], 0, 4) ?><?php if (substr($s["EndDate"], 0, 4) != NULL) echo ("-" . substr($s["EndDate"], 0, 4)); ?> • <?= $s["Genres"] ?></div>
                    <div class="section-content synopsis"><?= $s["Synopsis"] ?></div>
                    <div class="section-content trailer"><a class="link important" rel="noopener" target="_blank" href="https://youtu.be/<?= $s["TrailerPath"] ?>">Bande-annonce</a></div>
                    <div class="section-content grade">
                        <div class="grade-design"><?= floor($s["Grade"]) / 10 ?></div>
                        <div class="grade-help">Note des utilisateurs</div>
                    </div>
                </div>
            </div>
            <div class="section limited people">
                <div class="section-name">Tête d'affiche</div>
                <div class="section-content people-list">
                    Cette fonctionnalité est en cours de développement.
                </div>
            </div>
            <div class="section limited recommendations">
                <div class="section-name">Recommandations</div>
                <div class="section-content series-list">
                    Cette fonctionnalité est en cours de développement.
                </div>
            </div>
        </main>
    </body>

    </html>
<?php
} else {
    header("Location: /browse");
}
?>