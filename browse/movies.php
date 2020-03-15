<?php
require_once("../tools/init.php");
require_once("../tools/utilities.php");

if (isset($_GET["id"])) {
    require_once("../tools/database.php");
    $stmt = $db->prepare("SELECT * FROM Movies WHERE MovieID = ?");
    $stmt->execute(array(htmlspecialchars($_GET["id"])));
    $m = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    if (!$m) header("Location: /");
    require_once("../tools/utilities.php");
?>
    <!DOCTYPE html>
    <html lang="fr-fr">

    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Découvrez <?= $m["Title"] ?> (<?= substr($m["ReleaseDate"], 0, 4) ?>) sur Mediator." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="/style.css" />
        <title><?= $m["Title"] ?> (<?= substr($m["ReleaseDate"], 0, 4) ?>) - Mediator</title>
    </head>

    <body>
        <header>
            <div id="header">
                <a class="logo" href="/" aria-label="Mediator">Mediator</a>
                <a class="nav-button" href="/auth" aria-label="Se connecter">Se connecter</a>
            </div>
            <div id="nav">
                <a class="nav-link" href="/home" aria-label="Accueil">Accueil</a>
                <a class="nav-link active" href="/browse" aria-label="Parcourir">Parcourir</a>
                <a class="nav-link" href="/library" aria-label="Bibliothèque">Bibliothèque</a>
            </div>
        </header>
        <main id="title-page">
            <div class="section intro">
                <div class="poster-container">
                    <div class="poster"><img src="<?= $m["PosterPath"] ?>" alt="" /></div>
                </div>
                <div class="presentation-container">
                    <div class="title"><?= $m["Title"] ?></div>
                    <div class="section-content info"><?= substr($m["ReleaseDate"], 0, 4) ?> • <?= $m["Genres"] ?> • <?= minutes_to_string($m["Duration"]) ?></div>
                    <div class="section-content synopsis"><?= $m["Synopsis"] ?></div>
                    <div class="section-content trailer"><a class="link important" rel="noopener" target="_blank" href="<?= $m["TrailerPath"] ?>">Bande-annonce</a></div>
                    <div class="section-content grade">
                        <div class="grade-design"><?= floor($m["Grade"]) / 10 ?></div>
                        <div class="grade-help">Note des utilisateurs</div>
                    </div>
                </div>
            </div>
            <div class="section people">
                <div class="section-name">Tête d'affiche</div>
                <div class="section-content people-list">
                    Cette fonctionnalité est en cours de développement.
                </div>
            </div>
            <div class="section recommendations">
                <div class="section-name">Recommandations</div>
                <div class="section-content movies-list">
                    Cette fonctionnalité est en cours de développement.
                </div>
            </div>
        </main>
    </body>

    </html>
<?php
} else {
    header("Location: /");
}
?>