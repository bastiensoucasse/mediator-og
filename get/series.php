<?php
require_once("../tools/database.php");
$stmt = $db->prepare("SELECT SeriesID,Title,StartYear,PosterPath FROM Series WHERE SeriesID = ?");
$stmt->execute(array($_GET["id"]));
$s = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = null;
if (!$s) exit("Unknown");
?>
<a class="series" href="/browse/series?id=<?= $s["SeriesID"] ?>" aria-label="<?= $s["Title"] ?> (<?= substr($s["ReleaseDate"], 0, 4) ?>)" title="<?= $s["Title"] ?> (<?= substr($s["ReleaseDate"], 0, 4) ?>)">
    <img src="<?= $s["PosterPath"] ?>" alt="<?= $s["Title"] ?> (<?= substr($s["ReleaseDate"], 0, 4) ?>)" />
</a>