<?php
require_once("database.php");
require_once("init.php");
require_once("utilities.php");

$title = strtolower(htmlspecialchars($_POST["title"]));
$requester = account(htmlspecialchars($_SESSION["id"]));

if (htmlspecialchars($_POST["type"]) == "series") {
    $stmt = $db->prepare("INSERT INTO Series (Title, Requester, RequestDate) VALUES (?, ?, NOW())");
    $stmt->execute(array($title, $requester["id"]));
    $stmt = $db->prepare("SELECT SeriesID FROM Series WHERE Title = ? AND Requester = ?");
    $stmt->execute(array($title, $requester["id"]));
    $data = $stmt->fetch();
    $id = $data["SeriesID"];
    $type = "série";
} else {
    $stmt = $db->prepare("INSERT INTO Movies (Title, Requester, RequestDate) VALUES (?, ?, NOW())");
    $stmt->execute(array($title, $requester["id"]));
    $stmt = $db->prepare("SELECT MovieID FROM Movies WHERE Title = ? AND Requester = ?");
    $stmt->execute(array($title, $requester["id"]));
    $data = $stmt->fetch();
    $id = $data["MovieID"];
    $type = "film";
}

if (!send($requester["first_name"] . " " . $requester["last_name"] . " <" . $requester["email"] . ">", "Votre proposition de $type sur Mediator.", "Vous avez récemment proposé $title en tant que $type sur Mediator (référence #$id). Votre requête va être prise en compte dans les plus bref délais. Nous vous tiendrons informé de son évolution."))
    header("Location: /library?status=2");

if (!send("Bastien Soucasse <bastien.soucasse@laposte.net>", "Nouvelle proposition de $type sur Mediator.", $requester["first_name"] . " " . $requester["last_name"] . " a proposé $title en tant que $type sur Mediator (référence #$id). Merci de prendre la commande en compte dans les plus brefs délais."))
    header("Location: /library?status=1");

header("Location: /library?status=0");
