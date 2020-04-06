<?php
require_once("../database.php");
require_once("../init.php");

$query = htmlspecialchars($_GET["q"]);
$userID = htmlspecialchars($_SESSION["id"]);
if (!$userID) $userID = 0;

$stmt = $db->prepare("SELECT `Query` FROM `Searches` WHERE `Query` LIKE ? AND `Query` IN (SELECT `Query` FROM `Searches` WHERE `UserID` IS NULL OR `UserID` = ?) GROUP BY `Query` ORDER BY COUNT(*) DESC, `Date` DESC LIMIT 12");
$stmt->execute(array("%$query%", $userID));
$searches = $stmt->fetchAll();

if (!$searches) echo("<div class=\"no-suggestion\">Votre recherche ne semble retourner aucun résultat.</div>");
else foreach ($searches as $s)
{
?>
<a class="suggestion" href="/search?q=<?= urlencode($s["Query"]) ?>">
    <?= $s["Query"] ?>
</a>
<?php
}
?>
