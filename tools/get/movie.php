<?php
require_once("../../tools/database.php");
require_once("../../tools/init.php");
require_once("../../tools/utilities.php");

$movie_id = htmlspecialchars($_GET["id"]);

$stmt = $db->prepare("SELECT `MovieID`, `Title`, `ReleaseDate`, `PosterPath` FROM `Movies` WHERE `MovieID` = ?");
$stmt->execute(array($movie_id));
$m = $stmt->fetch();

if (!$m)
    die("Unknown movie.");

$img_path_1x = "https://image.tmdb.org/t/p/w185_and_h278_bestv2/";
$img_path_2x = "https://image.tmdb.org/t/p/w370_and_h556_bestv2/";
?>

<a class="movie" href="/browse/movies?id=<?= $m["MovieID"] ?>" aria-label="<?= htmlspecialchars($m["Title"] . " (" . substr($m["ReleaseDate"], 0, 4) . ")") ?>" title="<?= htmlspecialchars($m["Title"] . " (" . substr($m["ReleaseDate"], 0, 4) . ")") ?>">
    <img class="lazyload" alt="" data-sizes="auto" data-src="<?= $img_path_1x . $m["PosterPath"] ?>" data-srcset="<?= $img_path_1x . $m["PosterPath"] ?> 1x, <?= $img_path_2x . $m["PosterPath"] ?> 2x" />
</a>
