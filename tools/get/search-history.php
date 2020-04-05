<?php
require_once("../database.php");
require_once("../init.php");

$stmt = $db->prepare("SELECT `SearchID`, `Query` FROM `Searches` WHERE `User` = ? ORDER BY `Date` DESC LIMIT 8");
$stmt->execute(array(htmlspecialchars($_SESSION["id"])));
$searches = $stmt->fetchAll();

if (!$searches) echo("Vous n'avez effectué aucune recherche.");
else foreach ($searches as $s)
{
?>
<div class="suggestion">
    <?= $s["Query"] ?>
</div>
<?php
}
?>
