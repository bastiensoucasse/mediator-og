<?php
require_once("tools/init.php");
require_once("tools/utilities.php");
?>

<!DOCTYPE html>
<html lang="fr-fr">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Parcourez votre bibliothèque sur Mediator." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/style.css" />
    <title>Bibliothèque - Mediator</title>
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
            <a class="nav-link" href="/browse" aria-label="Parcourir">Parcourir</a>
            <a class="nav-link active" href="/library" aria-label="Bibliothèque">Bibliothèque</a>
        </div>
    </header>
    <main>
        <?php
        if (!is_connected()) {
        ?>
            <div id="auth" class="section">
                <div class="section-name">Votre bibliothèque</div>
                <div class="section-content">
                    Veuillez vous connecter pour parcourir votre bibliothèque.
                    <a class="button" href="/auth" aria-label="Se connecter">Se connecter</a>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div id="request" class="section">
                <div class="section-name">Proposer un titre</div>
                <form class="section-content request-form" method="get" action="tools/request">
                    <fieldset class="form-fieldset">
                        <input class="form-fieldset-input" type="text" name="title" required focus />
                        <legend class="form-fieldset-legend">Titre</legend>
                    </fieldset>
                    <div class="request-switcher">
                        <div class="switch-el">
                            <input id="movie-radio" name="type" type="radio" required />
                            <label for="movie-radio">Film</label>
                        </div>
                        <div class="switch-el">
                            <input id="tv-radio" name="type" type="radio" required />
                            <label for="tv-radio">Série</label>
                        </div>
                    </div>
                    <input class="button" type="submit" name="submit" value="Demander" />
                </form>
            </div>
            <div id="movies-ordered" class="section">
                <div class="section-name">Vos films commandés</div>
                <div class="section-content movies-list">
                    <?php
                    require_once("tools/database.php");
                    $stmt = $db->prepare("SELECT * FROM Movies WHERE AddDate IS NOT NULL AND Requester = ? ORDER BY AddDate DESC");
                    $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                    $movies = $stmt->fetchAll();
                    if (!$movies)
                        echo ("Vous n'avez commandé aucun film.");
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
            <div id="series-ordered" class="section">
                <div class="section-name">Vos séries commandés</div>
                <div class="section-content series-list">
                    <?php
                    require_once("tools/database.php");
                    $stmt = $db->prepare("SELECT * FROM Series WHERE AddDate IS NOT NULL AND Requester = ? ORDER BY AddDate DESC");
                    $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                    $series = $stmt->fetchAll();
                    if (!$series)
                        echo ("Vous n'avez commandé aucune série.");
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
        <?php
        }
        ?>
    </main>
</body>

</html>