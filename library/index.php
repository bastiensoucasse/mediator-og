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
                <a class="nav-button" href="<?= "/auth?source=" . urlencode("https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]) ?>" aria-label="Se connecter">Se connecter</a>
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
        if (!is_connected()) {
        ?>
            <div id="auth" class="section">
                <div class="section-name">Votre bibliothèque</div>
                <div class="section-content">
                    Veuillez vous connecter pour parcourir votre bibliothèque.
                    <a class="button" href="<?= "/auth?source=" . urlencode("https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]) ?>" aria-label="Se connecter">Se connecter</a>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div id="request" class="section">
                <div class="section-name">Proposer un nouveau titre</div>
                <form class="section-content request-form" method="post" action="../tools/request">
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
            </div>
            <div id="movies-ordered" class="section">
                <div class="section-name">Vos derniers films proposés</div>
                <div class="section-content movies-list">
                    <?php
                    $stmt = $db->prepare("SELECT MovieID FROM Movies WHERE AddDate IS NOT NULL AND Requester = ? ORDER BY AddDate DESC LIMIT 8");
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
            <div id="series-ordered" class="section">
                <div class="section-name">Vos dernières séries proposées</div>
                <div class="section-content series-list">
                    <?php
                    $stmt = $db->prepare("SELECT SeriesID FROM Series WHERE AddDate IS NOT NULL AND Requester = ? ORDER BY AddDate DESC LIMIT 8");
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
            <div id="orders" class="section">
                <div class="section-name">Toutes vos commandes</div>
                <div class="section-content commands-list">
                    <?php
                    $stmt = $db->prepare("SELECT CommandID FROM Commands WHERE UserID = ? ORDER BY Date DESC");
                    $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                    $commands = $stmt->fetchAll();
                    if (!$commands)
                        echo ("Vous n'avez effectué aucune commande.");
                    else {
                        foreach ($commands as $c) {
                    ?>
                            <div id="command-<?= $c["CommandID"] ?>" class="command-container">
                                <script>
                                    xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200)
                                            document.querySelector("#command-<?= $c["CommandID"] ?>").innerHTML = this.responseText;
                                    };
                                    xhttp.open("GET", "../get/command.php?id=<?= $c["CommandID"] ?>", true);
                                    xhttp.send();
                                </script>
                            </div>
                    <?php
                        }
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