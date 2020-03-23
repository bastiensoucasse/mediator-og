<?php
require_once("../../tools/database.php");
require_once("../../tools/init.php");
require_once("../../tools/utilities.php");

$series_id = htmlspecialchars($_GET["id"]);

$stmt = $db->prepare("SELECT `SeriesID`, `Title`, `StartDate`, `PosterPath` FROM `Series` WHERE `SeriesID` = ?");
$stmt->execute(array($series_id));
$s = $stmt->fetch();

if (!$s)
    die("Unknown series.");

$img_path_1x = "https://image.tmdb.org/t/p/w185_and_h278_bestv2/";
$img_path_2x = "https://image.tmdb.org/t/p/w370_and_h556_bestv2/";
?>

<a class="series" href="/browse/series?id=<?= $s["SeriesID"] ?>" aria-label="<?= htmlspecialchars($s["Title"] . " (" . substr($s["StartDate"], 0, 4) . ")") ?>" title="<?= htmlspecialchars($s["Title"] . " (" . substr($s["StartDate"], 0, 4) . ")") ?>">
    <img class="lazyload" alt="" data-sizes="auto" data-src="<?= $img_path_1x . $s["PosterPath"] ?>" data-srcset="<?= $img_path_1x . $s["PosterPath"] ?> 1x, <?= $img_path_2x . $s["PosterPath"] ?> 2x" />
</a>
