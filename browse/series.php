<?php
if (isset($_GET["id"])) {
    require_once("../tools/database.php");
    $stmt = $db->prepare("SELECT * FROM Series WHERE SeriesID = ?");
    $stmt->execute(array($_GET["id"]));
    $s = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    if (!$s) header("Location: /");
    require_once("../tools/utilities.php");
?>
    <!DOCTYPE html>
    <html lang="fr-fr">

    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Découvrez <?= $s["Title"] ?> (<?= $s["StartYear"] ?>) sur Mediator." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="/style.css" />
        <title><?= $s["Title"] ?> (<?= $s["StartYear"] ?>) - Mediator</title>
    </head>

    <body>
        <header>
            <div id="header">
                <a class="logo" href="/" aria-label="Mediator">Mediator</a>
                <a class="button" href="/auth" aria-label="Se connecter">Se connecter</a>
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
                    <div class="poster"><img src="<?= $s["PosterPath"] ?>" alt="" /></div>
                </div>
                <div class="presentation-container">
                    <div class="title"><?= $s["Title"] ?></div>
                    <div class="section-content info"><?= $s["StartYear"] ?><?php if ($s["EndYear"] != NULL) echo ("-" . $s["EndYear"]); ?> • <?= $s["Genres"] ?></div>
                    <div class="section-content synopsis"><?= $s["Synopsis"] ?></div>
                    <div class="section-content trailer"><a class="link important" rel="noopener" target="_blank" href="<?= $s["TrailerPath"] ?>">Bande-annonce</a></div>
                    <div class="section-content grade">
                        <div class="grade-design"><?= floor($s["Grade"]) / 10 ?></div>
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
                <div class="section-content series-list">
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