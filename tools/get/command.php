<?php
require_once("../../tools/database.php");
require_once("../../tools/init.php");
require_once("../../tools/utilities.php");

$command_id = htmlspecialchars($_GET["id"]);

$stmt = $db->prepare("SELECT `CommandID`, `Type` FROM `Commands` WHERE `CommandID` = ?");
$stmt->execute(array($command_id));
$c = $stmt->fetch();

if (!$c)
    die ("Unknown command.");

$type = $c["Type"];

if ($type == "series")
{
    $stmt = $db->prepare("SELECT `CommandID`, `Type`, `Title`, `Date` FROM `Commands` INNER JOIN `Series` ON `Series`.`SeriesID` = `Commands`.`ContentID` WHERE `CommandID` = ?");
    $stmt->execute(array($command_id));
    $c = $stmt->fetch();
}
else
{
    $stmt = $db->prepare("SELECT `CommandID`, `Type`, `Title`, `Date` FROM `Commands` INNER JOIN `Movies` ON `Movies`.`MovieID` = `Commands`.`ContentID` WHERE `CommandID` = ?");
    $stmt->execute(array($command_id));
    $c = $stmt->fetch();
}
?>

<div class="command">
    <div class="command-id">#<?= $c["CommandID"] ?></div>
    <div class="command-info">
        <div class="command-title"><?= $c["Title"] ?></div>
        <div class="command-desc"><?= ($c["Type"] == "series" ? "Série" : "Film") . " • " . substr($c["Date"], 0, 10) ?></div>
    </div>
</div>
