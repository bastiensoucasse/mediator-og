<?php
require_once("database.php");
require_once("init.php");
require_once("utilities.php");

$user = account(htmlspecialchars($_SESSION["id"]));
$type = htmlspecialchars($_POST["type"]) == "series" ? "series" : "movie";
$title = strtolower(htmlspecialchars($_POST["title"]));

if ($type == "series")
{
    $stmt = $db->prepare("INSERT INTO `Series` (`Title`) VALUES (?)");
    $stmt->execute(array($title));

    $stmt = $db->prepare("SELECT `SeriesID` FROM `Series` WHERE `Title` = ?");
    $stmt->execute(array($title));
    $s = $stmt->fetch();

    $id = $s["SeriesID"];
    $typefr = "la série";
}
else
{
    $stmt = $db->prepare("INSERT INTO `Movies` (`Title`) VALUES (?)");
    $stmt->execute(array($title));

    $stmt = $db->prepare("SELECT `MovieID` FROM `Movies` WHERE `Title` = ?");
    $stmt->execute(array($title));
    $m = $stmt->fetch();

    $id = $m["MovieID"];
    $typefr = "le film";
}

$stmt = $db->prepare("INSERT INTO `Commands` (`Type`, `ContentID`, `UserID`, `Date`) VALUES (?, ?, ?, NOW())");
$stmt->execute(array($type, $id, $user["id"]));

$stmt = $db->prepare("SELECT `CommandID` FROM `Commands` WHERE `ContentID` = ?");
$stmt->execute(array($id));
$c = $stmt->fetch();

$id = $c["CommandID"];

$to = $user["id"];
$subject = "Votre commande #$id sur Mediator";
$message = "Vous avez récemment proposé $typefr <b>$title</b> sur Mediator. Votre commande (référencée #$id) va être prise en compte dans les plus brefs délais. Nous vous tiendrons informé de son évolution.";
send($to, $subject, $message);

$to = 1;
$subject = "Nouvelle commande #$id sur Mediator";
$message = $user["first_name"] . " " . $user["last_name"] . " a proposé $typefr <b>$title</b> sur Mediator. Merci de prendre cette commande (référencée #$id) en compte dans les plus brefs délais.";
send($to, $subject, $message);

$n = "Votre commande concernant $typefr $title a été transmise sous la référence #$id.";
setcookie("notification", $n, time() + 60, "/");
header("Location: /library");
exit;
