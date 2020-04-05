<?php
require_once("../database.php");
require_once("../init.php");

$query = htmlspecialchars($_GET["q"]);

$stmt = $db->prepare("SELECT `Query` FROM `Searches` WHERE `Query` LIKE ? GROUP BY `Query` ORDER BY COUNT(*) DESC, `Date` DESC LIMIT 8");
$stmt->execute(array("%$query%"));
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
