<?php
require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");

$page = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$src = urlencode($page);

if (isset($_GET["id"]))
{
    $movieID = htmlspecialchars($_GET["id"]);

    $stmt = $db->prepare("SELECT * FROM Movies WHERE MovieID = ?");
    $stmt->execute(array($movieID));

    $m = $stmt->fetch();
    if (!$m)
    {
        header("Location: /");
        exit;
    }

    if (is_connected())
    {
        $userID = htmlspecialchars($_SESSION["id"]);

        $stmt = $db->prepare("SELECT * FROM LikedMovies WHERE MovieID = ? AND UserID = ?");
        $stmt->execute(array($movieID, $userID));

        $lm = $stmt->fetch();
        if ($lm) $liked = true;
        else $liked = false;

        $stmt = $db->prepare("SELECT * FROM SeenMovies WHERE MovieID = ? AND UserID = ?");
        $stmt->execute(array($movieID, $userID));

        $sm = $stmt->fetch();
        if ($sm) $seen = true;
        else $seen = false;
    }

    $img_path_1x = "https://image.tmdb.org/t/p/w300_and_h450_bestv2/";
    $img_path_2x = "https://image.tmdb.org/t/p/w600_and_h900_bestv2/";
?>
    <!DOCTYPE html>
    <html lang="fr-fr">

    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Découvrez <?= $m["Title"] ?> (<?= substr($m["ReleaseDate"], 0, 4) ?>) sur Mediator." />
        <meta name="theme-color" content="#14AB95" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="/icon.png" />
        <link rel="apple-touch-icon" href="/icon.png" />
        <link rel="manifest" href="/manifest.webmanifest" />
        <link rel="stylesheet" href="/style.css" />
        <script>if ("serviceWorker" in navigator) navigator.serviceWorker.register("/service-worker.js");</script>
        <title><?= $m["Title"] ?> (<?= substr($m["ReleaseDate"], 0, 4) ?>) - Mediator</title>
    </head>

    <body>
        <header>
            <div id="header">
                <a class="logo" href="/" aria-label="Mediator">Mediator</a>
                <?php
                if (!is_connected()) {
                ?>
                    <a class="nav-button" href="<?= "/auth?source=" . urlencode($_SERVER["REQUEST_URI"]) ?>" aria-label="Se connecter">Se connecter</a>
                <?php
                }
                ?>
            </div>
            <div id="nav">
                <a class="nav-link" href="/" aria-label="Accueil">Accueil</a>
                <a class="nav-link active" href="/browse" aria-label="Parcourir">Parcourir</a>
                <a class="nav-link" href="/library" aria-label="Bibliothèque">Bibliothèque</a>
            </div>
        </header>
        <main id="title-page">
            <div class="section limited intro">
                <div class="poster-container">
                    <div class="section-content poster">
                        <img sizes="auto" srcset="<?= $img_path_1x . $m["PosterPath"] ?> 1x, <?= $img_path_2x . $m["PosterPath"] ?> 2x" src="<?= $img_path_1x . $m["PosterPath"] ?>" alt="<?= htmlspecialchars($m["Title"] . " (" . substr($m["ReleaseDate"], 0, 4) . ")") ?>" />
                    </div>
                </div>
                <div class="presentation-container">
                    <div class="section-content title"><?= $m["Title"] ?></div>
                    <div class="section-content info"><?= substr($m["ReleaseDate"], 0, 4) ?> • <?= $m["Genres"] ?> • <?= minutes_to_string($m["Duration"]) ?></div>
                    <div class="section-content synopsis"><?= $m["Synopsis"] ?></div>
                    <div class="section-content trailer"><a class="link important" rel="noopener" target="_blank" href="https://youtu.be/<?= $m["TrailerPath"] ?>">Bande-annonce</a></div>
                    <div class="section-content grade">
                        <div class="grade-design"><?= floor($m["Grade"]) / 10 ?></div>
                        <div class="grade-help">Note des utilisateurs</div>
                        <?php if (is_connected()) { ?>
                            <?php if ($liked) { ?>
                                <a class="feature checked like" href="<?= "/unlike?type=movie&id=$movieID&src=$src" ?>" aria-label="Unliker ce film" title="Unliker ce film">
                                    <svg viewBox="0 0 426.667 426.667"><path d="M309.333,17.6c-37.12,0-72.747,17.28-96,44.48c-23.253-27.2-58.88-44.48-96-44.48C51.52,17.6,0,69.12,0,134.933 c0,80.533,72.533,146.347,182.4,246.08l30.933,28.053l30.933-28.053c109.867-99.733,182.4-165.547,182.4-246.08 C426.667,69.12,375.147,17.6,309.333,17.6z"/></svg>
                                </a>
                            <?php } else { ?>
                                <a class="feature like" href="<?= "/like?type=movie&id=$movieID&src=$src" ?>" aria-label="Liker ce film" title="Liker ce film">
                                    <svg viewBox="0 0 426.667 426.667"><path d="M309.333,17.6c-37.12,0-72.747,17.28-96,44.48c-23.253-27.2-58.88-44.48-96-44.48C51.52,17.6,0,69.12,0,134.933 c0,80.533,72.533,146.347,182.4,246.08l30.933,28.053l30.933-28.053c109.867-99.733,182.4-165.547,182.4-246.08 C426.667,69.12,375.147,17.6,309.333,17.6z"/></svg>
                                </a>
                            <?php } ?>
                            <?php if ($seen) { ?>
                                <a class="feature checked see" href="<?= "/unsee?type=movie&id=$movieID&src=$src" ?>" aria-label="Marquer ce film comme non vu" title="Marquer ce film comme non vu">
                                    <svg viewBox="0 0 375.147 375.147"><polygon points="344.96,44.48 119.147,270.293 30.187,181.333 0,211.52 119.147,330.667 375.147,74.667" /></svg>
                                </a>  
                            <?php } else { ?>
                                <a class="feature see" href="<?= "/see?type=movie&id=$movieID&src=$src" ?>" aria-label="Marquer ce film comme vu" title="Marquer ce film comme vu">
                                    <svg viewBox="0 0 375.147 375.147"><polygon points="344.96,44.48 119.147,270.293 30.187,181.333 0,211.52 119.147,330.667 375.147,74.667" /></svg>
                                </a>
                            <?php } ?>
                        <?php } ?>
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
                <div class="section-content movies-list">
                    Cette fonctionnalité est en cours de développement.
                </div>
            </div>
        </main>
    </body>

    </html>
<?php
}
else
{
    header("Location: /browse");
    exit;
}
?>
