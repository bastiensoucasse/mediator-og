<?php
require_once("init.php");

$type = htmlspecialchars($_GET["type"]) == "Série" ? "tv" : "movie";

require_once("database.php");
if ($type == "tv")
    $sql = "INSERT INTO Series (Title, Requester, RequestDate) VALUES (?, ?, NOW())";
else
    $sql = "INSERT INTO Movies (Title, Requester, RequestDate) VALUES (?, ?, NOW())";
$stmt = $db->prepare($sql);
$stmt->execute(array(htmlspecialchars($_GET["title"]), htmlspecialchars($_SESSION["id"])));

// send_mail();
header("Location: /library?status=1");
