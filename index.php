<?php
require_once("tools/init.php");
require_once("tools/utilities.php");
?>

<!DOCTYPE html>
<html lang="fr-fr">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="La nouvelle base de données cinéatographique de Profuder." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/style.css" />
    <title>Mediator</title>
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
            <a class="nav-link active" href="/home" aria-label="Accueil">Accueil</a>
            <a class="nav-link" href="/browse" aria-label="Parcourir">Parcourir</a>
            <a class="nav-link" href="/library" aria-label="Bibliothèque">Bibliothèque</a>
        </div>
    </header>
    <main>
        <div id="home" class="section">
            <div class="section-name">Bandes originales</div>
            <div class="section-content">
                Écoutez notre playlist orchestrale officielle composée de musiques tirées de films et de séries sur Spotify.
                <a class="link important" rel="noopener" target="_blank" href="https://open.spotify.com/playlist/0xY3Ax7yXSVWIbPk5F4Jy8?si=2CgHw6I0QheRn2YVJAwTJA" aria-label="Bandes originales sur Spotify">Découvrir</a>
            </div>
        </div>
        <div id="movies" class="section">
            <div class="section-name">Nouveaux films</div>
            <div class="section-content movies-list">
                <?php
                require_once("tools/database.php");
                $stmt = $db->prepare("SELECT MovieID FROM Movies WHERE AddDate IS NOT NULL ORDER BY AddDate DESC LIMIT 8");
                $stmt->execute();
                $movies = $stmt->fetchAll();
                if (!$movies)
                    echo ("Il n'y a aucun film à afficher.");
                else {
                    foreach ($movies as $m) {
                ?>
                        <div id="movie-<?= $m["MovieID"] ?>" class="movie-container">
                            <script>
                                xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200)
                                        document.querySelector("#movie-<?= $m["MovieID"] ?>").innerHTML = this.responseText;
                                };
                                xhttp.open("GET", "get/movie.php?id=<?= $m["MovieID"] ?>", true);
                                xhttp.send();
                            </script>
                        </div>
                <?php
                    }
                    $stmt = null;
                }
                ?>
            </div>
        </div>
        <div id="series" class="section">
            <div class="section-name">Nouvelles séries</div>
            <div class="section-content series-list">
                <?php
                require_once("tools/database.php");
                $stmt = $db->prepare("SELECT SeriesID FROM Series WHERE AddDate IS NOT NULL ORDER BY AddDate DESC LIMIT 8");
                $stmt->execute();
                $series = $stmt->fetchAll();
                if (!$series)
                    echo ("Il n'y a aucune série à afficher.");
                else {
                    foreach ($series as $s) {
                ?>
                        <div id="series-<?= $s["SeriesID"] ?>" class="series-container">
                            <script>
                                xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200)
                                        document.querySelector("#series-<?= $s["SeriesID"] ?>").innerHTML = this.responseText;
                                };
                                xhttp.open("GET", "get/series.php?id=<?= $s["SeriesID"] ?>", true);
                                xhttp.send();
                            </script>
                        </div>
                <?php
                    }
                    $stmt = null;
                }
                ?>
            </div>
        </div>
    </main>
</body>

</html>