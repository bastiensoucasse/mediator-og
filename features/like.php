<?php
require_once("../tools/database.php");
require_once("../tools/init.php");
require_once("../tools/utilities.php");

if (isset($_GET["src"]))
    $src = htmlspecialchars($_GET["src"]);
else
    $src = "/";

if (!isset($_GET["type"]) || !isset($_GET["id"]) || !isset($_SESSION["id"]))
{
    header("Location: $src");
    exit;
}

$type = htmlspecialchars($_GET["type"]);
$id = htmlspecialchars($_GET["id"]);
$user = htmlspecialchars($_SESSION["id"]);

if ($type == "series")
    $stmt = $db->prepare("INSERT INTO `LikedSeries` (`SeriesID`, `UserID`, `Date`) VALUES (?, ?, NOW())");
else
    $stmt = $db->prepare("INSERT INTO `LikedMovies` (`MovieID`, `UserID`, `Date`) VALUES (?, ?, NOW())");

$stmt->execute(array($id, $user));

header("Location: $src");
exit;
