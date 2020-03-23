<?php
require_once("database.php");
require_once("utilities.php");

setlocale(LC_TIME, "fr_FR");
session_start();

if (!is_connected() && isset($_COOKIE["user"]))
    auth(htmlspecialchars($_COOKIE["user"]));

$page = "https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$src = urlencode($page);
