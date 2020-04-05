<?php
require_once("tools/database.php");
require_once("tools/init.php");
require_once("tools/utilities.php");

$_PAGE = array(
    "TITLE" => "Mediator",
    "LINK" => "https://" . $_SERVER["HTTP_HOST"],
    "DESCRIPTION" => "La nouvelle base de données cinéatographique de Profuder."
);
?>

<!DOCTYPE html>
<html lang="fr-fr">

<?php require("tools/get/head.php"); ?>

<body>
    <?php require("tools/get/header.php"); ?>
    <?php require("tools/notif.php"); ?>
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
                if (is_connected())
                {
                    $stmt = $db->prepare("SELECT `MovieID`, `Title`, `ReleaseDate`, `PosterPath` FROM `Movies` WHERE `AddDate` IS NOT NULL AND `MovieID` NOT IN( SELECT `MovieID` FROM `SeenMovies` WHERE `UserID` = ? ) ORDER BY `AddDate` DESC LIMIT 8");
                    $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                }
                else
                {
                    $stmt = $db->prepare("SELECT `MovieID`, `Title`, `ReleaseDate`, `PosterPath` FROM `Movies` WHERE `AddDate` IS NOT NULL ORDER BY `AddDate` DESC LIMIT 8");
                    $stmt->execute();
                }
                $movies = $stmt->fetchAll();
                if (!$movies) echo ("Il n'y a aucun film à afficher.");
                else foreach ($movies as $m) require("tools/get/movie.php");
                ?>
            </div>
        </div>
        <div id="series" class="section">
            <div class="section-name">Nouvelles séries</div>
            <div class="section-content series-list">
                <?php
                if (is_connected())
                {
                    $stmt = $db->prepare("SELECT `SeriesID`, `Title`, `StartDate`, `PosterPath` FROM `Series` WHERE `AddDate` IS NOT NULL AND `SeriesID` NOT IN( SELECT `SeriesID` FROM `SeenSeries` WHERE `UserID` = ? ) ORDER BY `AddDate` DESC LIMIT 8");
                    $stmt->execute(array(htmlspecialchars($_SESSION["id"])));
                }
                else
                {
                    $stmt = $db->prepare("SELECT `SeriesID`, `Title`, `StartDate`, `PosterPath` FROM `Series` WHERE `AddDate` IS NOT NULL ORDER BY `AddDate` DESC LIMIT 8");
                    $stmt->execute();
                }
                $series = $stmt->fetchAll();
                if (!$series) echo ("Il n'y a aucune série à afficher.");
                else foreach ($series as $s) require("tools/get/series.php");
                ?>
            </div>
        </div>
    </main>
</body>

</html>
