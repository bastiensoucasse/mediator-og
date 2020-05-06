<?php
ini_set("display_startup_errors", "1");
ini_set("display_errors", "1");
session_start();

require_once "tools/database.class.php";
require_once "tools/page.class.php";

function relocate($id) {
    header("Location: /" . urldecode($id));
    exit;
}

function get_source() {
    $src = null;
    if (isset($_GET["src"])) $src = strtolower(htmlspecialchars($_GET["src"]));
    if (!$src) $src = "home";
    return $src;
}

function get_poster($poster) {
    return "https://image.tmdb.org/t/p/original/" . $poster . ".jpg";
}

function get_year($date) {
    return substr($date, 0, 4);
}

function get_genres($genres) {
    function get_genre($genre) { return "<a href=\"genres/$genre->id\" aria-label=\"$genre->name\">$genre->name</a>"; }
    return implode(", ", array_map("get_genre", $genres));
}

function get_duration($duration) {
    $hours = floor($duration / 60);
    $minutes = $duration % 60;
    if ($hours > 0 && $minutes > 0) return $hours . "h " . $minutes . "min";
    else if ($hours > 0) return $hours . "h";
    else return $minutes . "min";
}

function get_seasons($seasons) {
    if ($seasons == 1) return $seasons . " saison";
    return $seasons . " saisons";
}
 
function get_date($date) {
    return date("d/m/Y", strtotime($date));
}

$db = new Database();
if (!$db->is_connected() && isset($_COOKIE["token"])) $db->connect(htmlspecialchars($_COOKIE["token"]));
if ($db->is_connected()) $user = $db->get_connected_user();
