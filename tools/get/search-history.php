<?php
require_once("../database.php");
require_once("../init.php");

$userID = htmlspecialchars($_SESSION["id"]);

$stmt = $db->prepare("SELECT `SearchID`, `Query` FROM `Searches` WHERE `UserID` = ? ORDER BY `Date` DESC LIMIT 8");
$stmt->execute(array($userID));
$searches = $stmt->fetchAll();

if (!$searches) echo("<div class=\"no-suggestion\">Vous n'avez effectué aucune recherche.</div>");
else foreach ($searches as $s)
{
?>
<a class="suggestion" href="/browse/search?q=<?= $s["Query"] ?>">
    <?= $s["Query"] ?>
</a>
<?php
}
?>
