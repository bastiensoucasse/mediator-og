<?php
require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");

$query = htmlspecialchars($_GET["q"]);
$userID = htmlspecialchars($_SESSION["id"]);

if (!$query)
{
    header("Location: /browse");
    exit;
}

$_PAGE = array(
    "TITLE" => "$query - Mediator",
    "LINK" => "https://" . $_SERVER["HTTP_HOST"] . "/search?q=$query",
    "DESCRIPTION" => "Recherche de $query sur Mediator."
);

if ($userID)
{
    $stmt = $db->prepare("INSERT INTO `Searches`(`UserID`, `Query`, `Date`) VALUES (?, ?, NOW())");
    $stmt->execute(array($userID, $query));
}

$stmt = $db->prepare("SELECT `MovieID`, `Title`, `ReleaseDate`, `PosterPath` FROM `Movies` WHERE `AddDate` IS NOT NULL AND `Title` LIKE ? ORDER BY `AddDate` DESC LIMIT 8");
$stmt->execute(array("%$query%"));
$movies = $stmt->fetchAll();

$stmt = $db->prepare("SELECT `SeriesID`, `Title`, `StartDate`, `PosterPath` FROM `Series` WHERE `AddDate` IS NOT NULL AND `Title` LIKE ? ORDER BY `AddDate` DESC LIMIT 8");
$stmt->execute(array("%$query%"));
$series = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr-fr">

<?php require("../tools/get/head.php"); ?>

<body>
    <?php require("../tools/get/header.php"); ?>
    <?php require("../tools/notif.php"); ?>
    <main>
        <div id="search" class="section">
            <?php if (!$movies && !$series): ?>
                <div class="section-name">Recherche</div>
                <div class="section-content">
                    Votre recherche ne retourne aucun résultat.
                </div>
            <?php endif; ?>

            <?php if ($movies): ?>
                <div class="section-name">Films</div>
                <div class="section-content movies-list">
                    <?php foreach ($movies as $m) require("../tools/get/movie.php"); ?>
                </div>
            <?php endif; ?>

            <?php if ($series): ?>
                <div class="section-name">Séries</div>
                <div class="section-content series-list">
                    <?php foreach ($series as $s) require("../tools/get/series.php"); ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>
