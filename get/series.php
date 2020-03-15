<?php
require_once("../tools/database.php");
$stmt = $db->prepare("SELECT SeriesID,Title,StartYear,PosterPath FROM Series WHERE SeriesID = ?");
$stmt->execute(array(htmlspecialchars($_GET["id"])));
$s = $stmt->fetch(PDO::FETCH_ASSOC);
$stmt = null;
if (!$s) exit("Unknown");
?>
<a class="series" href="/browse/series?id=<?= $s["SeriesID"] ?>" aria-label="<?= $s["Title"] ?> (<?= $s["StartYear"] ?>)" title="<?= $s["Title"] ?> (<?= $s["StartYear"] ?>)">
    <img src="<?= $s["PosterPath"] ?>" alt="<?= $s["Title"] ?> (<?= $s["StartYear"] ?>)" />
</a>