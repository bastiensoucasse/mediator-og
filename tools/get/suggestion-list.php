<?php
require_once("../database.php");
require_once("../init.php");

$query = htmlspecialchars($_GET["q"]);
$userID = htmlspecialchars($_SESSION["id"]);
if (!$userID) $userID = 0;

$stmt = $db->prepare("SELECT `SearchID`, `UserID`, `Query` FROM `Searches` WHERE `Query` LIKE ? GROUP BY `Query` HAVING `UserID` IS NULL OR `UserID` = ? ORDER BY `UserID` DESC, COUNT(*) DESC, `Date` DESC LIMIT 12");
$stmt->execute(array("%$query%", $userID));
$searches = $stmt->fetchAll();

if (!$searches) echo("<div class=\"no-suggestion\">Votre recherche ne semble retourner aucun résultat.</div>");
else foreach ($searches as $s)
{
?>
<a class="suggestion" href="/browse/search?q=<?= $s["Query"] ?>">
    <?= $s["Query"] ?>
</a>
<?php
}
?>
