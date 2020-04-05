<?php
require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");

$_PAGE = array(
    "TITLE" => "Bibliothèque - Mediator",
    "LINK" => "https://" . $_SERVER["HTTP_HOST"] . "/browse/library",
    "DESCRIPTION" => "Parcourez votre bibliothèque sur Mediator."
);
?>

<!DOCTYPE html>
<html lang="fr-fr">

<?php require("../tools/get/head.php"); ?>

<body>
    <?php require("../tools/get/header.php"); ?>
    <?php require("../tools/notif.php"); ?>
    <main>
        <?php
        if (!is_connected())
        {
            require("../tools/get/out.php");
            exit;
        }
        ?>
        <div id="liked-movies" class="section">
            <div class="section-name">Films likés</div>
            <div class="section-content movies-list">
                <?php
                $stmt = $db->prepare("SELECT `Movies`.`MovieID`, `Movies`.`Title`, `Movies`.`ReleaseDate`, `Movies`.`PosterPath` FROM `LikedMovies` INNER JOIN `Movies` ON `LikedMovies`.`MovieID` = `Movies`.`MovieID` WHERE `LikedMovies`.`UserID` = ? ORDER BY `LikedMovies`.`Date` DESC");
                $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                $movies = $stmt->fetchAll();
                if (!$movies) echo ("Vous n'avez liké aucun film.");
                else foreach ($movies as $m) require("../tools/get/movie.php");
                ?>
            </div>
        </div>
        <div id="liked-series" class="section">
            <div class="section-name">Séries likées</div>
            <div class="section-content series-list">
                <?php
                $stmt = $db->prepare("SELECT `Series`.`SeriesID`, `Series`.`Title`, `Series`.`StartDate`, `Series`.`PosterPath` FROM `LikedSeries` INNER JOIN `Series` ON `LikedSeries`.`SeriesID` = `Series`.`SeriesID` WHERE `LikedSeries`.`UserID` = ? ORDER BY `LikedSeries`.`Date` DESC");
                $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                $series = $stmt->fetchAll();
                if (!$series) echo ("Vous n'avez liké aucune série.");
                else foreach ($series as $s) require("../tools/get/series.php");
                ?>
            </div>
        </div>
        <div id="seen-movies" class="section">
            <div class="section-name">Films visionnés</div>
            <div class="section-content movies-list">
                <?php
                $stmt = $db->prepare("SELECT `Movies`.`MovieID`, `Movies`.`Title`, `Movies`.`ReleaseDate`, `Movies`.`PosterPath` FROM `SeenMovies` INNER JOIN `Movies` ON `SeenMovies`.`MovieID` = `Movies`.`MovieID` WHERE `SeenMovies`.`UserID` = ? ORDER BY `SeenMovies`.`Date` DESC");
                $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                $movies = $stmt->fetchAll();
                if (!$movies) echo ("Vous n'avez visionné aucun film.");
                else foreach ($movies as $m) require("../tools/get/movie.php");
                ?>
            </div>
        </div>
        <div id="seen-series" class="section">
            <div class="section-name">Séries visionnées</div>
            <div class="section-content series-list">
                <?php
                $stmt = $db->prepare("SELECT `Series`.`SeriesID`, `Series`.`Title`, `Series`.`StartDate`, `Series`.`PosterPath` FROM `SeenSeries` INNER JOIN `Series` ON `SeenSeries`.`SeriesID` = `Series`.`SeriesID` WHERE `SeenSeries`.`UserID` = ? ORDER BY `SeenSeries`.`Date` DESC");
                $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                $series = $stmt->fetchAll();
                if (!$series) echo ("Vous n'avez visionné aucune série.");
                else foreach ($series as $s) require("../tools/get/series.php");
                ?>
            </div>
        </div>
        <div class="section">
            <div class="section-name">Commander</div>
            <div id="commands" class="commands">
                <form class="section-content commands-new" method="post" action="../tools/request">
                    <fieldset class="form-fieldset">
                        <input id="title-text" class="form-fieldset-input" type="text" name="title" required focus />
                        <label class="form-fieldset-legend" for="title-text">Titre</label>
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
    </main>
</body>

</html>
