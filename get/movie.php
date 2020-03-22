<?php
require_once("../tools/database.php");

$stmt = $db->prepare("SELECT MovieID,Title,ReleaseDate,PosterPath FROM Movies WHERE MovieID = ?");
$stmt->execute(array(htmlspecialchars($_GET["id"])));
$m = $stmt->fetch();

if (!$m)
    exit("Unknown");

$img_path_1x = "https://image.tmdb.org/t/p/w185_and_h278_bestv2/";
$img_path_2x = "https://image.tmdb.org/t/p/w370_and_h556_bestv2/";
?>

<a class="movie" href="/browse/movies?id=<?= $m["MovieID"] ?>" aria-label="<?= $m["Title"] ?> (<?= substr($m["ReleaseDate"], 0, 4) ?>)" title="<?= htmlspecialchars($m["Title"] . " (" . substr($m["ReleaseDate"], 0, 4) . ")") ?>">
    <img class="lazyload" data-sizes="auto" data-srcset="<?= $img_path_1x . $m["PosterPath"] ?> 1x, <?= $img_path_2x . $m["PosterPath"] ?> 2x" data-src="<?= $img_path_1x . $m["PosterPath"] ?>" sizes="auto" srcset="<?= $img_path_1x . $m["PosterPath"] ?> 1x, <?= $img_path_2x . $m["PosterPath"] ?> 2x" src="<?= $img_path_1x . $m["PosterPath"] ?>" alt="<?= htmlspecialchars($m["Title"] . " (" . substr($m["ReleaseDate"], 0, 4) . ")") ?>" />
</a>
