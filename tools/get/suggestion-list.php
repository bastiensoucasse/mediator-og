<?php
require_once("../database.php");

$q = $_GET["q"];

$stmt = $db->prepare("SELECT `MovieID`, `Title` FROM `Movies` WHERE LOWER(`Title`) LIKE ? ORDER BY `AddDate` DESC LIMIT 8");
$stmt->execute(array("%$q%"));
$movies = $stmt->fetchAll();

if (!$movies) echo("");
else foreach ($movies as $m)
{
?>
<a class="suggestion" href="/browse/movies?id=<?= $m["MovieID"] ?>">
    <?= strtolower($m["Title"]) ?>
</a>
<?php
}
?>
