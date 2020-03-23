<?php
require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");
?>

<!DOCTYPE html>
<html lang="fr-fr">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Parcourez votre bibliothèque sur Mediator." />
    <meta name="theme-color" content="#14AB95" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="/icon.png" />
    <link rel="apple-touch-icon" href="/icon.png" />
    <link rel="manifest" href="/manifest.webmanifest" />
    <link rel="stylesheet" href="/style.css" />
    <script>if ("serviceWorker" in navigator) navigator.serviceWorker.register("/service-worker.js");</script>
    <title>Bibliothèque - Mediator</title>
</head>

<body>
    <header>
        <div id="header">
            <a class="logo" href="/" aria-label="Mediator">Mediator</a>
            <?php
            if (!is_connected())
            {
            ?>
                <a class="nav-button" href="<?= "/auth?source=" . urlencode($_SERVER["REQUEST_URI"]) ?>" aria-label="Se connecter">Se connecter</a>
            <?php
            }
            ?>
        </div>
        <div id="nav">
            <a class="nav-link" href="/" aria-label="Accueil">Accueil</a>
            <a class="nav-link" href="/browse" aria-label="Parcourir">Parcourir</a>
            <a class="nav-link active" href="/library" aria-label="Bibliothèque">Bibliothèque</a>
        </div>
    </header>
    <main>
        <?php
        if (!is_connected())
        {
        ?>
            <div id="auth" class="section">
                <div class="section-name">Bibliothèque</div>
                <div class="section-content">
                    Veuillez vous connecter pour parcourir votre bibliothèque.
                    <a class="button" href="<?= "/auth?source=" . urlencode($_SERVER["REQUEST_URI"]) ?>" aria-label="Se connecter">Se connecter</a>
                </div>
            </div>
        <?php
        }
        else
        {
        ?>
            <div id="liked-movies" class="section">
                <div class="section-name">Films likés</div>
                <div class="section-content movies-list">
                    <?php
                    $stmt = $db->prepare("SELECT `MovieID` FROM `LikedMovies` WHERE `UserID` = ? ORDER BY `Date` DESC");
                    $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                    $movies = $stmt->fetchAll();
                    if (!$movies)
                    {
                        echo ("Vous n'avez liké aucun film.");
                    }
                    else
                    {
                        foreach ($movies as $m)
                        {
                    ?>
                            <div id="movie-<?= $m["MovieID"] ?>" class="movie-container">
                                <script>
                                    xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200)
                                            document.querySelector("#movie-<?= $m["MovieID"] ?>").innerHTML = this.responseText;
                                    };
                                    xhttp.open("GET", "../get/movie.php?id=<?= $m["MovieID"] ?>", true);
                                    xhttp.send();
                                </script>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div id="liked-series" class="section">
                <div class="section-name">Séries likées</div>
                <div class="section-content series-list">
                    <?php
                    $stmt = $db->prepare("SELECT `SeriesID` FROM `LikedSeries` WHERE `UserID` = ? ORDER BY `Date` DESC");
                    $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                    $series = $stmt->fetchAll();
                    if (!$series)
                    {
                        echo ("Vous n'avez liké aucune série.");
                    }
                    else
                    {
                        foreach ($series as $s)
                        {
                    ?>
                            <div id="series-<?= $s["SeriesID"] ?>" class="series-container">
                                <script>
                                    xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200)
                                            document.querySelector("#series-<?= $s["SeriesID"] ?>").innerHTML = this.responseText;
                                    };
                                    xhttp.open("GET", "../get/series.php?id=<?= $s["SeriesID"] ?>", true);
                                    xhttp.send();
                                </script>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="section">
                <div class="section-name">Commander</div>
                <div id="commands" class="commands">
                    <form class="section-content commands-new" method="post" action="../tools/request">
                        <fieldset class="form-fieldset">
                            <input class="form-fieldset-input" type="text" name="title" required focus />
                            <legend class="form-fieldset-legend">Titre</legend>
                        </fieldset>
                        <div class="request-switcher">
                            <div class="switch-el">
                                <input id="movie-radio" type="radio" name="type" value="movie" required />
                                <label for="movie-radio">Film</label>
                            </div>
                            <div class="switch-el">
                                <input id="series-radio" type="radio" name="type" value="series" required />
                                <label for="series-radio">Série</label>
                            </div>
                        </div>
                        <input class="button" type="submit" name="submit" value="Demander" />
                    </form>
                    <div class="section-content commands-go">
                        Retrouvez toutes vos commandes effectuées en détail.
                        <a class="link important" href="/library/commands" aria-label="Commandes">Commandes</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </main>
</body>

</html>
