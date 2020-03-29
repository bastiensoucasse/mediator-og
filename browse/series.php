<?php
if (!isset($_GET["id"]))
{
    include("series-index.php");
    exit;
}

require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");

$series_id = htmlspecialchars($_GET["id"]);

$stmt = $db->prepare("SELECT * FROM `Series` WHERE `SeriesID` = ?");
$stmt->execute(array($series_id));
$s = $stmt->fetch();

if (!$s)
{
    header("Location: /browse/series");
    exit;
}

$_PAGE = array(
    "TITLE" => $s["Title"] . " (" . substr($s["StartDate"], 0, 4) . ") - Mediator",
    "LINK" => "https://" . $_SERVER["HTTP_HOST"] . "/browse/series?id=$series_id",
    "DESCRIPTION" => "Découvrez la série " . $s["Title"] . " (" . substr($s["StartDate"], 0, 4) . ")" . " sur Mediator."
);

$img_path_1x = "https://image.tmdb.org/t/p/w300_and_h450_bestv2/";
$img_path_2x = "https://image.tmdb.org/t/p/w600_and_h900_bestv2/";

if (is_connected())
{
    $user_id = htmlspecialchars($_SESSION["id"]);

    $stmt = $db->prepare("SELECT `SeriesID` FROM `LikedSeries` WHERE `SeriesID` = ? AND `UserID` = ?");
    $stmt->execute(array($series_id, $user_id));
    $liked = $stmt->fetch() ? true : false;
    
    $stmt = $db->prepare("SELECT `SeriesID` FROM `SeenSeries` WHERE `SeriesID` = ? AND `UserID` = ?");
    $stmt->execute(array($series_id, $user_id));
    $seen = $stmt->fetch() ? true : false;
}
?>

<!DOCTYPE html>
<html lang="fr-fr">

<?php include("../tools/get/head.php"); ?>

<body>
    <?php include("../tools/get/header.php"); ?>
    <main id="title-page">
        <div class="section limited intro">
            <div class="poster-container">
                <div class="section-content poster">
                    <img class="lazyload" alt="" data-sizes="auto" data-src="<?= $img_path_1x . $s["PosterPath"] ?>" data-srcset="<?= $img_path_1x . $s["PosterPath"] ?> 1x, <?= $img_path_2x . $s["PosterPath"] ?> 2x" />
                </div>
            </div>
            <div class="presentation-container">
                <div class="section-content title"><?= $s["Title"] ?></div>
                <div class="section-content info"><?= substr($s["StartDate"], 0, 4) ?><?php if (substr($s["EndDate"], 0, 4) != NULL) echo ("-" . substr($s["EndDate"], 0, 4)); ?> • <?= $s["Genres"] ?></div>
                <div class="section-content synopsis"><?= $s["Synopsis"] ?></div>
                <div class="section-content trailer"><a class="link important" rel="noopener" target="_blank" href="https://youtu.be/<?= $s["TrailerPath"] ?>">Bande-annonce</a></div>
                <div class="section-content grade">
                    <div class="grade-design"><?= floor($s["Grade"]) / 10 ?></div>
                    <div class="grade-help">Note des utilisateurs</div>
                    <?php if (is_connected()) : ?>
                        <?php if ($liked) : ?>
                            <a class="feature checked like" href="<?= "/features/unlike?type=series&id=$series_id&src=$src" ?>" aria-label="Unliker cette série" title="Unliker cette série">
                                <svg viewBox="0 0 426.667 426.667"><path d="M309.333,17.6c-37.12,0-72.747,17.28-96,44.48c-23.253-27.2-58.88-44.48-96-44.48C51.52,17.6,0,69.12,0,134.933 c0,80.533,72.533,146.347,182.4,246.08l30.933,28.053l30.933-28.053c109.867-99.733,182.4-165.547,182.4-246.08 C426.667,69.12,375.147,17.6,309.333,17.6z"/></svg>
                            </a>
                        <?php else : ?>
                            <a class="feature like" href="<?= "/features/like?type=series&id=$series_id&src=$src" ?>" aria-label="Liker cette série" title="Liker cette série">
                                <svg viewBox="0 0 426.667 426.667"><path d="M309.333,17.6c-37.12,0-72.747,17.28-96,44.48c-23.253-27.2-58.88-44.48-96-44.48C51.52,17.6,0,69.12,0,134.933 c0,80.533,72.533,146.347,182.4,246.08l30.933,28.053l30.933-28.053c109.867-99.733,182.4-165.547,182.4-246.08 C426.667,69.12,375.147,17.6,309.333,17.6z"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ($seen) : ?>
                            <a class="feature checked see" href="<?= "/features/unsee?type=series&id=$series_id&src=$src" ?>" aria-label="Marquer cette série comme non vu" title="Marquer cette série comme non vu">
                                <svg viewBox="0 0 375.147 375.147"><polygon points="344.96,44.48 119.147,270.293 30.187,181.333 0,211.52 119.147,330.667 375.147,74.667" /></svg>
                            </a>  
                        <?php else : ?>
                            <a class="feature see" href="<?= "/features/see?type=series&id=$series_id&src=$src" ?>" aria-label="Marquer cette série comme vu" title="Marquer cette série comme vu">
                                <svg viewBox="0 0 375.147 375.147"><polygon points="344.96,44.48 119.147,270.293 30.187,181.333 0,211.52 119.147,330.667 375.147,74.667" /></svg>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
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
            <div class="section-content series-list">
                Cette fonctionnalité est en cours de développement.
            </div>
        </div>
    </main>
</body>

</html>
