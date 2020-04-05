<?php
require_once("../database.php");
require_once("../init.php");

$userID = htmlspecialchars($_SESSION["id"]);

$stmt = $db->prepare("SELECT `SearchID`, `Query` FROM `Searches` WHERE `UserID` = ? ORDER BY `Date` DESC LIMIT 8");
$stmt->execute(array($userID));
$searches = $stmt->fetchAll();

if (!$searches) echo("<div stule=\"padding: 10px 20px;\">Vous n'avez effectué aucune recherche.</div>");
else foreach ($searches as $s)
{
?>
<div class="suggestion">
    <?= $s["Query"] ?>
</div>
<?php
}
?>
