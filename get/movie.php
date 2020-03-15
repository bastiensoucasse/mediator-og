<?php
require_once("../tools/database.php");
$stmt = $db->prepare("SELECT MovieID,Title,ReleaseDate,PosterPath FROM Movies WHERE MovieID = ?");
$stmt->execute(array($_GET["id"]));
$m = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = null;
if (!$m) exit("Unknown");
?>
<a class="movie" href="/browse/movies?id=<?= $m["MovieID"] ?>" aria-label="<?= $m["Title"] ?> (<?= substr($m["ReleaseDate"], 0, 4) ?>)" title="<?= $m["Title"] ?> (<?= substr($m["ReleaseDate"], 0, 4) ?>)">
    <img src="<?= $m["PosterPath"] ?>" alt="<?= $m["Title"] ?> (<?= substr($m["ReleaseDate"], 0, 4) ?>)" />
</a>